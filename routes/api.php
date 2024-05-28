<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RouteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//GET
Route::get('product/list',[RouteController::class,'getProductList'])->name('api#productList');
Route::get('categoryList',[RouteController::class,'categoryList']);
Route::get('orderList',[RouteController::class,'orderList']);
Route::get('order',[RouteController::class,'order']);
Route::get('contact/list',[RouteController::class,'contactList']);
Route::get('all/data',[RouteController::class,'allData']);

//POST
Route::post('create/category',[RouteController::class,'createCategory']);
Route::post('create/product',[RouteController::class,'createProduct']);
Route::post('create/contact',[RouteController::class,'createContact']);

//delete
Route::post('delete/category',[RouteController::class,'deleteCategory']);
//if you want to use get method, you need to add the id or variable to url and your function need to use this id or variables
Route::post('delete/product',[RouteController::class,'deleteProduct']);
Route::post('delete/contact',[RouteController::class,'deleteContact']);

//details
Route::post('category/details',[RouteController::class,'categoryDetails']);

//update
Route::post('category/update',[RouteController::class,'categoryUpdate']);


/**
 * to get all data from the pizza order system
 * http://localhost/pizza_order_system/public/api/all/data
 *
 * to get category list
 * http://localhost/pizza_order_system/public/api/categoryList
 *
 * to get product list
 * http://localhost/pizza_order_system/public/api/product/list
 *
 * to get order list
 * http://localhost/pizza_order_system/public/api/orderList
 *
 * to get order data
 * http://localhost/pizza_order_system/public/api/order
 *
 * to get contact list
 * http://localhost/pizza_order_system/public/api/contact/list
 *
 * to create category
 * http://localhost/pizza_order_system/public/api/create/category
 * key value => name => $request->name
 *
 * to create product
 * http://localhost/pizza_order_system/public/api/create/product
 * key value
 * 'category_id' => $request->category_id
 * 'name' => $request->name,
 * 'description' => $request->description,
 * 'waiting_time' => $request->waiting_time,
 * 'price' => $request->price
 * 'image' => $request->image
 *
 * to create contact message
 * http://localhost/pizza_order_system/public/api/create/contact
 * key value
 * 'name' => $request->name,
 * 'email' => $request->email,
 * 'message' => $request->message,
 *
 * to delete category
 * http://localhost/pizza_order_system/public/api/delete/category
 * key value => 'id' => $request->category_id
 *
 * to delete product
 * http://localhost/pizza_order_system/public/api/delete/product
 * key value => 'id' => $request->product_id
 *
 * to delete contact
 * http://localhost/pizza_order_system/public/api/delete/contact
 * key value => 'id' => $request->contact_id
 *
 * to update category
 * http://localhost/pizza_order_system/public/api/update/category
 * key value => 'id' => category_id, 'name' => $request->category_name
 *
 *
 *
 */

