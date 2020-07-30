<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{   
    //
    protected $fillable = ["status"];
    
    public function shoppingCartId(){
        return $this->id;
    }
    public function productShopingCarts(){
        return $this->hasMany('App\ProductShoppingCarts');
    }
    public function products(){
        // select count sobre la cantidad de productos que trae esta relacion via tabla pivote
        return $this->belongsToMany('App\Product','product_shopping_carts');
    }
    public function productSize(){
        return $this->products()->count();
    }
    public function total(){
        return $this->products()->sum('pricing');
    }
    public function totalUSD(){
        return $this->total()/850;
    }
    public function approved(){
        $this->updateCustomID();
    }
    public function generateCustomID(){
            //  md5(5 + 1020304050:4342)
        return md5("$this->id $this->updated_at");
    }
    public function updateCustomID(){
        // update shopping cart status and update custom id 
        $this->status="approved";
        $this->custom_id = $this->generateCustomID();
        $this->save();
    }
    public function order(){
        return $this->hasOne("App\Order")->first();
    }
    public static function findOrCreateBySessionID($shopping_cart_id){
        if($shopping_cart_id)
            //buscar el carrito
            return ShoppingCart::findBySession($shopping_cart_id);
        else
            //crear el carrito
            return ShoppingCart::createWithoutSession();
    
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
