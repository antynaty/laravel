<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'MainController@home');
Route::get('/carrito', 'ShoppingCartsController@index');
Route::get('/paypal/pay','PaymentController@payWithPayPal');
Route::get('/paypal/status','PaymentController@payPalStatus');

Auth::routes();

Route::resource('/products','ProductsController');

// Route::get('formProduct',function(){
//   return view('products.create');
// })->name('formProduct');

/*
GET /products => index
POST /products => sotre
GET /products/create => Form para crear
GET /products/:id => mostrar product especifico
PUT /products/:id => actualizar un producto
DELETE /products/:id => eliminar un producto

*/
Route::resource('product_shopping_carts','ProductShoppingCartsController',[
  'only'=> ['store','destroy']
]);

/* 
  POST /products => store
  DELETE /products/:id  => destroy
*/
Route::get('/home', 'HomeController@index')->name('home');
