<?php

namespace App\Http\Controllers;

use App\Models\Beverage;
use App\Models\BeverageCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class BeverageCartController extends Controller
{

    public function getBeverageCartModal()
    {
        if (!auth()->check()) {
            $guestIdentifier = session()->getId() . "-beverage";
            $beverages = Cart::session($guestIdentifier)->getContent();
            $sorderSubTotal = Cart::session($guestIdentifier)->getSubTotal();

            $cartItems = $beverages->map(function ($beverage) {
                return [
                    'id' => $beverage->id,
                    'name' => ucwords($beverage->associatedModel->name),
                    'img' => $beverage->associatedModel->img,
                    'price' => $beverage->price,
                    'quantity' => $beverage->quantity,
                ];
            });

            return response()->json([
                'cartItems' => $cartItems,
                'orderSubTotal' => $sorderSubTotal
            ]);
        } else {
            $user = auth()->user();
            $cartItems = $user->beverageCart->beverage->map(function ($beverage) {
                return [
                    'id' => $beverage->pivot->id,
                    'name' => ucwords($beverage->name),
                    'img' => $beverage->img,
                    'price' => $beverage->pivot->sub_price,
                    'quantity' => $beverage->pivot->quantity
                ];
            });
            $orderSubTotal = $user->beverageCart->beverage->sum(function ($beverage) {
                return $beverage->pivot->sub_price * $beverage->pivot->quantity;
            });

            return response()->json([
                'cartItems' => $cartItems,
                'orderSubTotal' => $orderSubTotal,
            ]);
        }
    }

    public function addToBeverageCart(Request $req)
    {

        $beverageId = $req->beverage_id;
        $quantity = $req->quantity;
        $additionalPrice = 0;

        $attributes = [
            'size' => $req->size,
        ];

        if ($req->size == "Tall") {
            $additionalPrice += 2;
        }

        if ($req->milkType) {
            $attributes['milkType'] = $req->milkType;

            if ($req->milkType != "wholeMilk") {
                $additionalPrice += 2;
            }
        }

        if ($req->sweetenerType) {
            $attributes['sweetenerType'] = $req->sweetenerType;
            if ($req->sweetenerType != "Sugar") {
                $additionalPrice += 1;
            }
        }

        if ($req->flavorShot) {
            $attributes['flavorShot'] = $req->flavorShot;

            if ($req->flavorShot) {
                $additionalPrice += 2;
            }
        }

        if ($req->espressoShot) {
            $attributes['espressoShot'] = $req->espressoShot;
            if ($req->espressoShot == "2") {
                $additionalPrice += 1;
            }
            if ($req->espressoShot == "3") {
                $additionalPrice += 2;
            }
        }

        if ($req->roastLevel) {
            $attributes['roastLevel'] = $req->roastLevel;
        }

        if (!auth()->check()) {
            // Guest User
            $guestIdentifier = session()->getId() . "-beverage";
            $beverage = Beverage::find($beverageId);

            if ($beverage) {
                foreach ($attributes as $key => $value) {
                    $beverageId .= "-" . $value;
                }


                Cart::session($guestIdentifier)->add([
                    'id' => $beverageId,
                    'name' => $beverage->name,
                    'price' => $beverage->price + $additionalPrice,
                    'quantity' => $quantity,
                    'associatedModel' => $beverage,
                    'attributes' => $attributes,
                ]);


                return redirect()->back()->with('msg', 'Product has been added to the cart');
            }

            return redirect()->back()->with('err', 'Failed to Add, Product Not Found');

        } else {
            $user = auth()->user();
            $beverageCart = $user->beverageCart;
            $beverage = Beverage::find($beverageId);

            if ($beverage) {

                $existingCartItem = $beverageCart->beverage()
                    ->where('beverage_id', $beverageId)
                    ->whereRaw('JSON_CONTAINS(customization, ?)', [json_encode($attributes)])
                    ->first();

                if ($existingCartItem) {
                    // Item with the same beverage exists in the cart, update the quantity
                    $newQuantity = $existingCartItem->pivot->quantity + $quantity;

                    $beverageCart->beverage()->newPivotStatement()
                        ->where('beverage_id', $beverageId)
                        ->whereRaw('JSON_CONTAINS(customization, ?)', [json_encode($attributes)])
                        ->update(['quantity' => $newQuantity]);

                } else {
                    $subPrice = $beverage->price + $additionalPrice;

                    // Item with the same beverage does not exist, add it as a new item
                    $beverageCart->beverage()->attach($beverage->id, [
                        'quantity' => $quantity,
                        'customization' => json_encode($attributes),
                        'sub_price' => $subPrice,
                    ]);
                }

                return redirect()->back()->with('msg', 'Product has been added into the cart');
            } else {
                return redirect()->back()->with('msg', 'Product Not Found');
            }
        }
    }

    public function getBeverageCart()
    {
        if (!auth()->check()) {
            $guestIdentifier = session()->getId() . "-beverage";

            $beverageCart = Cart::session($guestIdentifier)->getContent()->sortBy('price');
            $subTotal = Cart::session($guestIdentifier)->getSubTotal();

            return view('beverageCart.index', ['beverageCart' => $beverageCart, 'subTotal' => $subTotal]);
        } else {

            $user = auth()->user();
            $beverageCart = $user->beverageCart;
            $cartItems = $user->beverageCart->beverage;

            $orderSubTotal = $cartItems->sum(function ($beverage) {
                return $beverage->pivot->sub_price * $beverage->pivot->quantity;
            });

            $itemSubTotals = $cartItems->mapWithKeys(function ($beverage) {
                return [$beverage->pivot->id => $beverage->pivot->sub_price * $beverage->pivot->quantity];
            });



            return view('beverageCart.index', ['beverageCart' => $beverageCart, 'orderSubTotal' => $orderSubTotal, 'itemSubTotals' => $itemSubTotals]);
        }
    }

    public function updateBeverageCart(Request $req)
    {

        $id = $req->id;
        $quantity = $req->quantity;

        if (!auth()->check()) {
            $guestIdentifier = session()->getId() . "-beverage";

            Cart::session($guestIdentifier)->update($id, [
                'quantity' => $quantity,
            ]);

            $price = Cart::session($guestIdentifier)->get($id)->getPriceSum();
            $subTotal = Cart::session($guestIdentifier)->getSubTotal();

            return response()->json([
                'price' => $price,
                'subTotal' => $subTotal,
            ]);

        } else {

            $user = auth()->user();
            $beverageCart = $user->beverageCart;

            $updateCartItem = $beverageCart->beverage()->newPivotStatement()->where('id', $id)->first();

            $beverageCart->beverage()->newPivotStatement()
                ->where('id', $id)
                ->update(['quantity' => $quantity]);

            $updateBeverage = Beverage::find($updateCartItem->beverage_id);


            $itemSubTotal = $updateCartItem->sub_price * $quantity;
            $newBeverageCart = $user->fresh()->beverageCart;
            $cartItems = $newBeverageCart->beverage;
            $orderSubTotal = $cartItems->sum(function ($beverage) {
                return $beverage->pivot->sub_price * $beverage->pivot->quantity;
            });

            return response()->json([
                'itemSubTotal' => $itemSubTotal,
                'subTotal' => $orderSubTotal,
            ]);

        }

    }

    public function deleteBeverageCart($id)
    {
        if (!auth()->check()) {
            $guestIdentifier = session()->getId() . "-beverage";

            Cart::session($guestIdentifier)->remove($id);
            return redirect()->back()->with('msg', 'Successfully Removed from Beverage Cart');
        } else {
            $user = auth()->user();
            $beverageCart = $user->beverageCart;
            $deleteBeverage = $beverageCart->beverage()->wherePivot('id', $id)->first();
            if ($deleteBeverage) {
                $beverageCart->beverage()->wherePivot('id', $id)->detach();
                return redirect()->back()->with('msg', 'Product has been deleted');
            } else {
                return redirect()->back()->with('msg', 'Product Not Found');
            }

        }


    }

}