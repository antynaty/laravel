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
Route::get('/home', 'HomeController@index')->name('home');
