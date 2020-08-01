<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use App\ShoppingCart;

class ShoppingCartProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        // View::composer("*", function($view){
        View::composer([
            'home','main.home','welcome','shopping_carts.completed','shopping_carts.index',
            'products.index','products.show','products.create','products.edit','products.edit'
        ], function($view){
            $shopping_cart_id = Session::get("shopping_cart_id");
            echo(Session::get("shopping_cart_id"));
            echo('   ');
            echo(session("shopping_cart_id"));
            $shopping_cart = ShoppingCart::findOrCreateBySessionID($shopping_cart_id);
            Session::put('shopping_cart_id', $shopping_cart->id);
            $view->with('shopping_cart',$shopping_cart);
        });
    }
}
