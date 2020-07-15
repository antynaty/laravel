<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{   
    //
    protected $fillable = ["status"];
    public function productSize(){
        return 10;
    }
    public static function findOrCreateBySessionID($shopping_cart_id){
        if($shopping_cart_id){
            //buscar el carrito
            return ShoppingCart::findBySession($shopping_cart_id);
        }else{
            //crear el carrito
            return ShoppingCart::createWithoutSession();
        }
    }
    public static function findBySession($shopping_cart_id){
        return ShoppingCart::find($shopping_cart_id);   
    }
    public static function createWithoutSession(){
        return ShoppingCart::create([
            "status"=>"incompleted"
        ]);
        // $shopping_cart = new ShoppingCart;

        // $shopping_cart -> status = "incompleted";
        // $shopping_cart->save();
        // return $shopping_cart;   
    }
}
