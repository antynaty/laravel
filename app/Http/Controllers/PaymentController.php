<?php

namespace App\Http\Controllers;

use App\Order;
use App\PayPalPayment;
use Illuminate\Support\Facades\Session;
use App\ShoppingCart;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware("shoppingcart");
    }
    public function store(Request $request){
        //
        // $shopping_cart_id = Session::get('shopping_cart_id');
        // $shopping_cart = ShoppingCart::findOrCreateBySessionID($shopping_cart_id);
        $shopping_cart = $request->shopping_cart;
        
        $paypal = new PayPalPayment($shopping_cart);
        // realizar la comprobacion del resultado aqui
        $result = $paypal->execute($request->paymentId,$request->PayerID);

        if ($result->state === 'approved') {
            // Session::remove("shopping_cart_id");
            $order = Order::createFromPayPalResault($result, $shopping_cart);
            // $status = 'Gracias! El pago a través de PayPal se ha ralizado correctamente.';
            // return redirect('/products')->with(compact('status'));
            $shopping_cart->approved();
            $order->sendMail();
        }

        return view('shopping_carts.completed',[
            "shopping_cart" => $shopping_cart,
            "order" => $order
        ]);
        // dd($order);
        // $status = 'Lo sentimos! El pago a través de PayPal no se pudo realizar.';
        // return redirect('/products')->with(compact('status'));
    }
}
