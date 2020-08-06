<?php

namespace App\Http\Controllers;
use App\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function __construct(){
        $this->middleware("auth");
    }
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
        $field = $request->name;        // name como {stauts o guide_number}
        $order->$field = $request->value;  // usar la variable $field como el nombre del atributo a modificar - lo permite PHP - y asignarle lo que venga en el campo value

        $order->save(); 
        // $order->sendUpdatedMail();
        return $order->$field;
    }    
}
