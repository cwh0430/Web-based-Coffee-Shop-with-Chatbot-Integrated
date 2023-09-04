<?php

namespace App\Http\Controllers;

use App\Models\Mechanic;
use App\Models\Productable;
use App\Models\ProductCart;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\HomebrewProduct;
use Illuminate\Support\Facades\View;
use Darryldecode\Cart\Facades\CartFacade as Cart;


class ProductCartController extends Controller
{

    public function getProductCartModal()
    {
        if (!auth()->check()) {
            $guestIdentifer = session()->getId() . "-products";

            $items = Cart::session($guestIdentifer)->getContent();

            $cartItems = $items->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => ucwords($item->associatedModel->name),
                    'img' => $item->associatedModel->img,
                    'price' => $item->price,
                    'quantity' => $item->quantity
                ];
            });
            $orderSubTotal = Cart::session($guestIdentifer)->getSubTotal();

            return response()->json([
                'cartItems' => $cartItems,
                'orderSubTotal' => $orderSubTotal,
            ]);

        } else {
            $user = auth()->user();
            $productCart = $user->productCart;

            $cartItems = $productCart->related->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => ucwords($item->productable->name),
                    'img' => $item->productable->img,
                    'price' => $item->productable->price,
                    'quantity' => $item->quantity,
                ];
            });

            $orderSubTotal = $productCart->related->sum(function ($item) {
                return $item->productable->price * $item->quantity;
            });
            return response()->json([
                'cartItems' => $cartItems,
                'orderSubTotal' => $orderSubTotal
            ]);
        }
    }
    public function addProductCart(Request $req)
    {
        $quantity = $req->quantity;
        $modelType = $req->modelType;



        if (!auth()->check()) {
            $guestIdentifer = session()->getId() . "-products";


            if ($modelType === "HomebrewProduct") {
                $id = $req->homebrewProduct_id;
                $productItem = HomebrewProduct::find($id);

            } elseif ($modelType === "Mechanic") {
                $id = $req->mechanic_id;
                $productItem = Mechanic::find($id);


            } else {
                return redirect()->back()->with('msg', 'error code given');
            }

            if ($productItem) {
                Cart::session($guestIdentifer)->add([
                    'id' => $id . "-" . $modelType,
                    'name' => $productItem->name,
                    'price' => $productItem->price,
                    'quantity' => $quantity,
                    'associatedModel' => $productItem,
                    'attributes' => array(
                        'modelType' => $modelType
                    ),
                ]);


                return redirect()->back()->with('msg', 'Product is added into product cart');
            } else {
                return redirect()->back()->with('msg', 'Product Not Found');
            }
        } else {
            $user = auth()->user();
            $productCart = $user->productCart;

            //1. check whether the user have product cart(if yes, use existing cart, if no, create new cart)
            //2. check whether the product exist in its own model(if yes, proceed, if no, return not found)
            //3. check the product type(if homebrew, use homebrew model, if mechanic, use mechanic model, else return error code)
            //4. check whether the product exist in the product cart model (if exist, update quantity only, if no, add into the cart)

            if ($modelType === "HomebrewProduct") {
                $id = $req->homebrewProduct_id;
                $productItem = HomebrewProduct::find($id);
                $productType = "App\Models\HomebrewProduct";


            } elseif ($modelType === "Mechanic") {
                $id = $req->mechanic_id;
                $productItem = Mechanic::find($id);
                $productType = "App\Models\Mechanic";

            } else {
                return redirect()->back()->with('err', 'Code error');
            }

            if ($productItem) {
                $exist = $productCart->related->where('productable_id', $productItem->id)->where('productable_type', $productType)->first();
                //$productCart->related->where('productable_id',$homebrew_id)->where('productable_type', $productType)->first();
                if ($exist) {
                    $initialQuantity = $exist->quantity;
                    $newQuantity = $initialQuantity + $quantity;
                    $exist->quantity = $newQuantity;

                    $exist->quantity = $newQuantity;
                    $exist->save();

                    return redirect()->back()->with('msg', 'Product has been added to cart');
                } else {
                    $productable = $productCart->related()->make();
                    $productable->productable()->associate($productItem);
                    $productable->quantity = $quantity;
                    $productable->save();

                    return redirect()->back()->with('msg', 'Product has been added to cart');
                }


            } else {
                return redirect()->back()->with('msg', 'Product Not Found');
            }
        }
    }

    public function getProductCart()
    {
        if (!auth()->check()) {

            $guestIdentifer = session()->getId() . "-products";


            $productCart = Cart::session($guestIdentifer)->getContent();
            $subTotal = Cart::session($guestIdentifer)->getSubTotal();

            return view('productCart.index', ['productCart' => $productCart, 'subTotal' => $subTotal]);
        } else {
            $user = auth()->user();
            $productCart = $user->productCart;
            $productable = $productCart->related;

            $orderSubTotal = $productable->sum(function ($item) {
                return $item->productable->price * $item->quantity;
            });

            $itemSubTotal = $productable->mapWithKeys(function ($item) {
                return [$item->id => $item->productable->price * $item->quantity];
            });

            return view('productCart.index', ['productable' => $productable, 'orderSubTotal' => $orderSubTotal, 'itemSubTotal' => $itemSubTotal]);
        }
    }

    public function updateProductCart(Request $req)
    {
        $quantity = $req->quantity;

        if (!auth()->check()) {
            $id = $req->id;
            $guestIdentifer = session()->getId() . "-products";
            Cart::session($guestIdentifer)->update($id, [
                'quantity' => $quantity,
            ]);

            $price = Cart::session($guestIdentifer)->get($id)->getPriceSum();
            $subTotal = Cart::session($guestIdentifer)->getSubTotal();

            return response()->json([
                'price' => $price,
                'subTotal' => $subTotal,
            ]);
        } else {
            $user = auth()->user();
            $productCart = $user->productCart;

            $id = $req->id;

            $updateProduct = $productCart->related->find($id);
            if ($updateProduct) {
                $updateProduct->quantity = $quantity;
                $updateProduct->save();

                $itemSubTotal = $updateProduct->productable->price * $quantity;
                $updatedProductCart = $user->fresh()->productCart;
                $productable = $updatedProductCart->related;

                $orderSubTotal = $productable->sum(function ($item) {
                    return $item->productable->price * $item->quantity;
                });

                return response()->json([
                    'itemSubTotal' => $itemSubTotal,
                    'subTotal' => $orderSubTotal,
                ]);

            } else {
                return redirect()->back()->with('msg', 'Product Not Found');
            }

        }
    }

    public function deleteProductCart($id)
    {

        if (!auth()->check()) {
            $guestIdentifier = session()->getId() . "-products";

            Cart::session($guestIdentifier)->remove($id);

            return redirect()->back()->with('msg', 'Successfully Removed from Product Cart');
        } else {
            $user = auth()->user();
            $productCart = $user->productCart;
            $deleteProduct = $productCart->related->find($id);

            if ($deleteProduct) {
                $deleteProduct->delete();

                return redirect()->back()->with('msg', 'Successfully deleted from Product Cart');
            } else {
                return redirect()->back()->with('msg', 'Product Not Found');
            }
        }
    }


}