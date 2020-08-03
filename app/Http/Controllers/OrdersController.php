<?php

namespace App\Http\Controllers;
use App\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $orders = Order::find();
        $orders = Order::latest()->get();
        $totalMonth = Order::totalMonth();
        $totalMonthCount = Order::totalMonthCount();
        echo($totalMonthCount);
        return view('orders.index',[
            'orders' => $orders,
            'total_month' => $totalMonth,
            'total_month_count' => $totalMonthCount,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $order = Order::find($id);
        $field = $request->name;
        $order->$field = $request->value;

        $order->save();
        return $order->$field;
    }

    
}
