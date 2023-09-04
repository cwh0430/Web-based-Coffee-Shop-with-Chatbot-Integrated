<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Login;
use App\Models\ProductCart;

class TransferProductCartToUser
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        $guard = $event->guard;
        $guestProductCart = session("guest_product_cart.data");

        if ($guard == 'web') {
            $user = $event->user;
            if ($user->productCart) {
                $productCart = $user->productCart;
            } else {
                $productCart = new ProductCart();
                $user->productCart()->save($productCart);
            }

            if ($guestProductCart != null) {
                if (count($guestProductCart)) {

                    foreach ($guestProductCart as $item) {
                        $productId = $item->associatedModel->id;
                        $modelType = $item->attributes->modelType;
                        $productType = "App\Models\\" . $modelType;
                        $quantity = $item->quantity;

                        $databaseItem = $productCart->related->where('productable_id', $productId)->where('productable_type', $productType)->first();
                        if ($databaseItem) {
                            $initialQuantity = $databaseItem->quantity;
                            $newQuantity = $initialQuantity + $quantity;
                            $databaseItem->quantity = $newQuantity;
                            $databaseItem->save();
                        } else {
                            $productable = $productCart->related()->make();
                            $productable->productable()->associate($item->associatedModel);
                            $productable->quantity = $quantity;
                            $productable->save();
                        }
                    }

                }

            }
        }




        return;

    }
}