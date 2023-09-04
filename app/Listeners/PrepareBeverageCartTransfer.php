<?php

namespace App\Listeners;

use \Illuminate\Auth\Events\Attempting;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class PrepareBeverageCartTransfer
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
    public function handle(Attempting $event): void
    {
        $guestIdentifier = session()->getId() . "-beverage";
        $guestBeverageCart = Cart::session($guestIdentifier)->getContent();

        if (\Auth::guest()) {
            session()->flash('guest_beverage_cart', [
                'session' => $guestIdentifier,
                'data' => $guestBeverageCart,
            ]);

        }
    }
}