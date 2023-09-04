<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\BeverageCart;
use Illuminate\Auth\Events\Login;

class TransferBeverageCartToUser
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
        $guestBeverageCart = session("guest_beverage_cart.data");

        if ($guard == 'web') {
            $user = $event->user;
            if ($user->beverageCart) {
                $beverageCart = $user->beverageCart;
            } else {
                $beverageCart = new BeverageCart();
                $user->beverageCart()->save($beverageCart);
            }

            if ($guestBeverageCart !== null && count($guestBeverageCart) > 0) {
                foreach ($guestBeverageCart as $item) {
                    $beverageId = $item->associatedModel->id;
                    $attributes = $item->attributes;
                    $quantity = $item->quantity;

                    $existingDatabaseItem = $beverageCart->beverage()
                        ->where('beverage_id', $beverageId)
                        ->whereRaw('JSON_CONTAINS(customization, ?)', [json_encode($attributes)])
                        ->first();

                    if ($existingDatabaseItem) {
                        $initialQuantity = $existingDatabaseItem->pivot->quantity;
                        $newQuantity = $initialQuantity + $quantity;

                        $beverageCart->beverage()->newPivotStatement()
                            ->where('beverage_id', $beverageId)
                            ->whereRaw('JSON_CONTAINS(customization, ?)', [json_encode($attributes)])
                            ->update(['quantity' => $newQuantity]);
                    } else {
                        $beverageCart->beverage()->attach($beverageId, [
                            'quantity' => $quantity,
                            'customization' => json_encode($attributes),
                            'sub_price' => $item->price,
                        ]);
                    }
                }
            }
        }



    }

}