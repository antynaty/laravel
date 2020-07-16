<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{   
    //
    protected $fillable = ["status"];
    
    public function product_shoping_carts(){
        return $this->hasMany('App\ProductShoppingCarts');
    }
    public function products(){
        return $this->belongsToMany('App\Product','product_shopping_carts');
    }
    public function productSize(){
        return $this->products()->count();
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
