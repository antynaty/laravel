<?php

namespace App\Http\Controllers;

use App\ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\PaymentController;

class ShoppingCartsController extends Controller
{
    //
    public function index(){
        // 
        $shopping_cart_id = Session::get('shopping_cart_id');
        $shopping_cart = ShoppingCart::findOrCreateBySessionID($shopping_cart_id);

        // $paypal = new PaymentController($shopping_cart);
        // return '';

        // obtener los productos del carro
            $products = $shopping_cart->products()->get();
        // obtener el monto total a pagar
            $total = $shopping_cart->total(); // $total = $shopping_cart->product()->sum('pricing'); // no! el manejo de la info debe estar en el model NUNCA en el controlador 
        
        return view('shopping_carts.index',[
            'total' => $total,
            'products' => $products,
            'shopping_cart' => $shopping_cart
        ]);
    }
    
    public function show(){
        // crear futuro 
        
    }
}
