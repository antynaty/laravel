<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

use function GuzzleHttp\Psr7\mimetype_from_filename;

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
Route::get('/carrito/checkout', 'ShoppingCartsController@checkout');
Route::get('carrito/paypal/store', 'PaymentController@store');
// Route::get('/paypal/status','PaymentController@payPalStatus');

Auth::routes();

Route::resource('/products', 'ProductsController');

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
Route::resource('/product_shopping_carts', 'ProductShoppingCartsController', [
  'only' => ['store', 'destroy']
]);
Route::resource('compras', 'ShoppingCartsController', [
  'only' => ['show']
]);
Route::resource('ordenes', 'OrdersController', [
  'only' => ['index', 'update']
]);
// Route::get('/compras','ShoppingCartsController@show');
/* 
  POST /products => store
  DELETE /products/:id  => destroy
*/
Route::get('/home', 'HomeController@index')->name('home');
Route::get('products/images/{filename}', function ($filename) {
  $path = storage_path("app/images/$filename");
  if(!File::exists($path)) abort(404);    // si no existe, error 404

  $file = File::get($path);       // obtener el archivo
  $type = File::mimeType($path);   // obtener el tipo de archivo

  $response = Response::make($file,200);
  $response->header('Content-Type',$type);
  return $response;
});
