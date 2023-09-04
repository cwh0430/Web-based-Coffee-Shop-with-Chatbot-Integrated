<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use \Illuminate\Auth\Events\Attempting;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class PrepareProductCartTransfer
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
        $guestIdentifier = session()->getId() . "-products";
        $guestProductCart = Cart::session($guestIdentifier)->getContent();

        if (\Auth::guest()) {
            session()->flash('guest_product_cart', [
                'session' => $guestIdentifier,
                'data' => $guestProductCart,
            ]);

        }
    }
}