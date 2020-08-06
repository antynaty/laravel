<?php

namespace App\Http\Controllers;

use App\PayPalPayment;
use App\ShoppingCart;
use Illuminate\Http\Request;

class ShoppingCartsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware("shoppingcart");
    }

    public function index(Request $request){
        $shopping_cart = $request->shopping_cart;           // middleware    EX manual session get
        // /*     M O V E R    A    O T R O   C O N T R O L A D O R el direccionamiento a paypal 
        // $paypal = new PayPalPayment($shopping_cart);
        // $payment = $paypal->generate();
        
        // return redirect($payment->getApprovalLink());
        // */ 

        $products = $shopping_cart->products()->get(); // obtener los productos del carro
        // obtener el monto total a pagar
        $total = $shopping_cart->total(); // $total = $shopping_cart->product()->sum('pricing'); // no! el manejo de la info debe estar en el model NUNCA en el controlador 
        
        return view('shopping_carts.index',[
            'total' => $total,
            'products' => $products,
            'shopping_cart' => $shopping_cart
        ]);
    }
    
    public function show($id){
        // 
        $shopping_cart = ShoppingCart::where('custom_id',$id)->first();
        $order = $shopping_cart->order();
        return view('shopping_carts.completed',[
            "order" => $order,
            "shopping_cart" => $shopping_cart
        ]);
    }
    public function checkout(Request $request){
        $shopping_cart = $request->shopping_cart;
        $paypal = new PayPalPayment($shopping_cart);
        $payment = $paypal->generate();

        return redirect($payment->getApprovalLink());
    }
}
