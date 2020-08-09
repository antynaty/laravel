<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductShoppingCart extends Model
{
    protected $fillable = [
        "product_id", "shopping_cart_id",
    ];

    public static function productsCount($shopping_cart_id){
        // $productsCount = ProductShoppingCart::find($shopping_cart_id)->count();
        $productsCount = ProductShoppingCart::where('shopping_cart_id',$shopping_cart_id)->count();

        return $productsCount;
    }
}
