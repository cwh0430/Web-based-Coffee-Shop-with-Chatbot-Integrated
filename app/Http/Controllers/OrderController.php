<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $id = auth()->user()->id;

        $orders = Order::where(['created_by' => $id])->get();


        return view('orderlist.order', ['orders' => $orders]);
    }
}