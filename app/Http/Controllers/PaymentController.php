<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Order;
use App\Mail\OrderMail;
use Illuminate\Http\Request;
use App\Jobs\ClearBeverageCartJob;
use Illuminate\Support\Facades\Mail;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class PaymentController extends Controller
{
  public function checkout(Request $req)
  {
    $type = $req->modelType;
    $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));
    $lineItems = [];
    $totalPrice = 0;
    $descriptions = '';


    if (!auth()->check()) {

      $guestIdentifier = $type === "beverage" ? session()->getId() . '-beverage' : session()->getId() . '-products';
      $cartItems = Cart::session($guestIdentifier)->getContent();
      $totalPrice = Cart::session($guestIdentifier)->getSubTotal();

    } else {
      $user = auth()->user();

      if ($type === "beverage") {
        $cartItems = $user->beverageCart->beverage;
        $totalPrice = $cartItems->sum(function ($beverage) {
          return $beverage->pivot->sub_price * $beverage->pivot->quantity;
        });
      } else {
        $productDatabaseCart = $user->productCart;
        $cartItems = $productDatabaseCart->related;

        $totalPrice = $cartItems->sum(function ($item) {
          return $item->productable->price * $item->quantity;
        });
      }



    }

    foreach ($cartItems as $item) {

      if ($type === "beverage") {
        $customizations = auth()->check() ? json_decode($item->pivot->customization) : $item->attributes;
        foreach ($customizations as $key => $value) {
          $descriptions .= ucwords(implode(' ', preg_split('/(?=[A-Z])/', $key))) . ": " . ucwords(implode(' ', preg_split('/(?=[A-Z])/', $value))) . " ";
        }

        $lineItems[] = [
          'price_data' => [
            'currency' => 'myr',
            'product_data' => [
              'name' => ucwords($item->name),
              'description' => $descriptions,
              'metadata' => [
                'order_item_id' => auth()->check() ? $item->id : $item->associatedModel->id,
                'modelType' => "App\Models\\Beverage",
                'customization' => auth()->check() ? $item->pivot->customization : json_encode($item->attributes),
              ],
            ],
            'unit_amount' => (auth()->check() ? $item->pivot->sub_price : $item->price) * 100,
          ],
          'quantity' => auth()->check() ? $item->pivot->quantity : $item->quantity,
        ];
      } elseif ($type === "product") {
        $lineItems[] = [
          'price_data' => [
            'currency' => 'myr',
            'product_data' => [
              'name' => auth()->check() ? ucwords($item->productable->name) : $item->name,
              'metadata' => [
                'order_item_id' => auth()->check() ? $item->productable->id : $item->associatedModel->id,
                'modelType' => auth()->check() ? $item->productable_type : "App\Models\\" . $item->attributes->modelType,
              ],
            ],
            'unit_amount' => (auth()->check() ? $item->productable->price : $item->price) * 100,
          ],
          'quantity' => $item->quantity,
        ];
      }
    }

    $checkout_session = $stripe->checkout->sessions->create([
      'line_items' => $lineItems,
      'mode' => 'payment',
      'success_url' => route('checkout.success', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
      'cancel_url' => route('checkout.cancel', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
      'customer_creation' => 'always',
    ]);

    // dd($item['price_data']['product_data']['metadata']['beverage_id']);

    $order = new Order();
    $order->total_price = $totalPrice;
    $order->status = 'unpaid';
    $order->type = $type;
    $order->session_id = $checkout_session->id;
    $order->save();

    foreach ($lineItems as $item) {
      $orderItem = $order->related()->make();
      $orderItem->itemable_id = $item['price_data']['product_data']['metadata']['order_item_id'];
      $orderItem->itemable_type = $item['price_data']['product_data']['metadata']['modelType'];
      $orderItem->quantity = $item['quantity'];
      $orderItem->customization = $item['price_data']['product_data']['metadata']['customization'] ?? null;
      $orderItem->sub_price = intval($item['price_data']['unit_amount']) / 100;
      $orderItem->save();
    }


    return redirect($checkout_session->url);

  }
  public function success(Request $req)
  {
    $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));
    $sessionId = $req->get('session_id');

    $session = $stripe->checkout->sessions->retrieve($sessionId);
    if (!$session) {
      return view('payment.failure', ['message' => 'Invalid Session ID Provided']);
    }
    $customer = $stripe->customers->retrieve($session->customer);


    $order = Order::where(['session_id' => $session->id])->whereIn('status', ['unpaid', 'paid'])->first();
    if (!$order) {
      return view('payment.failure', ['message' => 'Order does not exist']);
    }


    if ($order->status == 'unpaid') {
      $this->updateOrderSuccess($order, $customer);
    }

    $this->sendOrderConfirmationEmail($order, $customer->name);



    return view('payment.success');

  }

  public function cancel(Request $req)
  {
    $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));
    $sessionId = $req->get('session_id');

    try {
      $session = $stripe->checkout->sessions->retrieve($sessionId);

      if (!$session) {
        return view('payment.failure', ['message' => 'Invalid Session ID Provided']);
      }

      $order = Order::where(['session_id' => $session->id, 'status' => 'unpaid'])->first();


      if (!$order) {
        return view('payment.failure', ['message' => 'Order does not exist']);
      }

      $order->delete();

      return view('payment.failure', ['message' => 'Payment has been cancelled!']);


    } catch (Exception $e) {
      return view('payment.failure', ['message' => $e->getMessage()]);
    }
  }

  // public function webhook()
  // {
  //   $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));

  //   $endpoint_secret = 'whsec_d1ab7080b1d8d5ee3c2fdaf02fae3656a2a91a5cd67e8496658007c5e0020e7e';

  //   $payload = @file_get_contents('php://input');
  //   $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
  //   $event = null;

  //   try {
  //     $event = \Stripe\Webhook::constructEvent(
  //       $payload,
  //       $sig_header,
  //       $endpoint_secret
  //     );
  //   } catch (\UnexpectedValueException $e) {
  //     // Invalid payload
  //     return response('', 401);
  //   } catch (\Stripe\Exception\SignatureVerificationException $e) {
  //     // Invalid signature
  //     return response('', 402);
  //   }

  //   // Handle the event
  //   switch ($event->type) {

  //     case 'checkout.session.completed':
  //       $paymentIntent = $event['data']['object'];
  //       $sessionId = $paymentIntent['id'];

  //       $order = Order::where(['session_id' => $sessionId, 'status' => 'unpaid'])->first();

  //       $session = $stripe->checkout->sessions->retrieve($sessionId);
  //       $customer = $stripe->customers->retrieve($session->customer);

  //       if ($order) {
  //         $this->updateOrderSuccess($order, $customer);
  //       }
  //     default:
  //       echo 'Received unknown event type ' . $event->type;
  //   }

  //   return response('', 200);
  // }

  private function updateOrderSuccess($order, $customer)
  {
    if (!auth()->check()) {

      if ($order->type == "beverage") {
        $guestIdentifier = session()->getId() . "-beverage";
      } elseif ($order->type == "product") {
        $guestIdentifier = session()->getId() . "-products";
      }

      Cart::session($guestIdentifier)->clear();
      $order->status = "paid";
      $order->created_by = $customer->email;
      $order->save();


    } else {
      $user = auth()->user();

      if ($order->type == "beverage") {
        $beverageCart = $user->beverageCart;
        $beverageCart->beverage()->detach();
      } elseif ($order->type == "product") {
        $productCart = $user->productCart;
        $productCart->related()->delete();
      }

      $order->status = "paid";
      $order->created_by = $user->id;
      $order->save();


    }
  }

  private function sendOrderConfirmationEmail($order, $name)
  {

    if (!auth()->check()) {
      Mail::to($order->created_by)->send(new OrderMail($order, $name));
    } else {
      $user = auth()->user();
      $email = $user->email;
      Mail::to($email)->send(new OrderMail($order, $name));
    }
  }
}