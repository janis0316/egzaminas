<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')
        ->get()
        ->map(function($dish) {
            $dish->dishes = json_decode($dish->order_json);
            return $dish;
        });

        return view('back.orders.index', ['orders' => $orders]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $order->status = 1;
        $order->save();
        return redirect()->back()->with('ok', 'Užsakymas patvirtintas');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        // if ($order->status == 0) {
        //     return redirect()->back()->with('bad', 'Negalima ištrinti ne užbaigto užsakymo');
        // }
        $order->delete();
        return redirect()->back()->with('ok', 'Užsakymas atšauktas');
    }
}
