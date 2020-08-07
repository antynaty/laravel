<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Product;

class MainController extends Controller{
  public function home(){
    $products = Product::all();
    // la funcionalida de shoppin_cart_id x session es agregado al provider de Shopping Cart
    return view('main.home',["products" => $products]);  
  }
}
  