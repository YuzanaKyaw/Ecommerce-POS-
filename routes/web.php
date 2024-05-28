<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;


// login , register
Route::middleware('admin_auth')->group(function(){
    Route::redirect('/', 'loginPage');
Route::get('loginPage',[AuthController::class,'loginPage'])->name('auth#loginPage');
Route::get('registerPage',[AuthController::class,'registerPage'])->name('auth#registerPage');
});


//'auth:sanctum',config('jetstream.auth_session'),'verified'
Route::middleware(['auth'])->group(function () {
    //dashboard
    Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');

    //admin
    // Route::group(['middleware'=>'admin_auth'],function(){

    // })or

    Route::middleware(['admin_auth'])->group(function(){
        //category
        Route::group(['prefix'=>'category'],function () {
            Route::get('list',[CategoryController::class,'list'])->name('category#list');
            Route::get('create/page',[CategoryController::class,'createPage'])->name('category#cretePage');
            Route::post('create',[CategoryController::class,'createCategory'])->name('category#create');
            Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category#delete');
            Route::get('edit/{id}',[CategoryController::class,'edit'])->name('category#edit');
            Route::post('update',[CategoryController::class,'update'])->name('category#update');
        });

        //admin account
        Route::prefix('admin')->group(function(){
            //password
            Route::get('password/changePage',[AdminController::class,'changePasswordPage'])->name('admin#changePasswordPage');
            Route::post('change/password',[AdminController::class,'changePassword'])->name('admin#changePassword');

            //account
            Route::get('account/details',[AdminController::class,'accountDeatail'])->name('admin#details');
            Route::get('account/edit',[AdminController::class,'accountEdit'])->name('admin#edit');
            Route::post('account/update/{id}',[AdminController::class,'accountUpdate'])->name('admin#update');
            Route::get('admin/list',[AdminController::class,'adminList'])->name('admin#list');
            Route::get('admin/delete/{id}',[AdminController::class,'adminDelete'])->name('admin#delete');
            Route::get('changeRole/{id}',[AdminController::class,'changeRole'])->name('admin#changeRole');
            Route::post('change/role/{id}',[AdminController::class,'change'])->name('admin#change');
            Route::get('change/role',[AjaxController::class,'changeRole'])->name('admin#ajaxChangeRole');

        });

        //products
        Route::prefix('products')->group(function(){
            Route::get('list',[ProductController::class,'productList'])->name('product#list');
            Route::get('cretePage',[ProductController::class,'createPage'])->name('product#createPage');
            Route::post('create',[ProductController::class,'createProduct'])->name('product#create');
            Route::get('delete/{id}',[ProductController::class,'delete'])->name('product#delete');
            Route::get('detail/{id}',[ProductController::class,'detail'])->name('product#detail');
            Route::get('edit/{id}',[ProductController::class,'edit'])->name('product#edit');
            Route::post('update',[ProductController::class,'update'])->name('product#update');

        });

        //user
        Route::prefix('user')->group(function(){
            Route::get('list',[UserController::class,'userList'])->name('admin#userList');
            Route::get('change/role',[UserController::class,'changeUserRole'])->name('admin#changeUserRole');
            Route::get('contact/list',[ContactController::class,'contactList'])->name('admin#contactList');
            Route::get('contact/delete/{contactId}',[ContactController::class,'contactDelete'])->name('admin#contactDelete');
            Route::get('delete/{userId}',[UserController::class,'userDelete'])->name('admin#userDelete');

        });

        //order
        Route::prefix('order')->group(function(){
            Route::get('list',[OrderController::class,'orderList'])->name('admin#orderList');
            Route::get('change/status',[OrderController::class,'orderChangeStatus'])->name('admin#changeOrderStatus');
            Route::get('ajax/change/status',[OrderController::class,'ajaxChangeStatus'])->name('admin#ajaxChangeStatus');
            Route::get('listInfo/{orderCode}',[OrderController::class,'listInfo'])->name('admin#listInfo');
        });

        //reply
        Route::prefix('reply')->group(function(){
            Route::get('page/{contactId}',[ReplyController::class,'replyPage'])->name('admin#replyPage');
            Route::post('send',[ReplyController::class,'sendReply'])->name('admin#sendReply');
        });

    });






    //user
    Route::group(['prefix' => 'user','middleware'=>'user_auth'],function(){
        // Route::get('home',function(){
        //     return view('user.userHome');
        // })->name('user#home');

        Route::get('home',[UserController::class,'home'])->name('user#home');
        Route::get('filter/{id}',[UserController::class,'filter'])->name('user#filter');

        Route::prefix('account')->group(function(){
            Route::get('password/changePage',[UserController::class,'changePasswordPage'])->name('user#changePasswordPage');
            Route::post('password/change',[UserController::class,'changePassword'])->name('user#changePassword');
            Route::get('profile/changePage',[UserController::class,'accountChange'])->name('user#profileChangePage');
            Route::post('update/{id}',[UserController::class,'accountUpdate'])->name('user#accountUpadate');

        });

        Route::prefix('pizza')->group(function(){
            Route::get('details/{id}',[UserController::class,'pizzaDetails'])->name('user#pizzaDetails');


        });

        Route::prefix('cart')->group(function(){
            Route::get('list',[UserController::class,'cartList'])->name('user#cartList');
            Route::get('history',[UserController::class,'cartHistory'])->name('user#history');
        });


        Route::group(['prefix' => 'ajax'],function(){
            Route::get('pizza/list',[AjaxController::class,'pizzaList'])->name('ajax#pizzaList');
            Route::get('add/cart',[AjaxController::class,'addToCart'])->name('ajax#addToCart');
            Route::get('order',[AjaxController::class,'order'])->name('ajax#order');
            Route::get('clear/current/product',[AjaxController::class,'clearCurrentProduct'])->name('ajax#clearCurrentProduct');
            Route::get('clear/cart',[AjaxController::class,'clearCart'])->name('ajax#clearCart');
            Route::get('increase/veiwCount',[AjaxController::class,'increaseViewCount'])->name('ajax#increaseViewCount');
        });

        Route::group(['prefix' => 'contact'],function(){
            Route::get('page',[ContactController::class,'contactPage'])->name('user#contactPage');
            Route::post('send/message',[ContactController::class,'sendMessage'])->name('user#sendMessage');
            Route::get('reply/page',[ReplyController::class,'userReplyPage'])->name('user#replyPage');

        });

    });



});









//user


/*
    php artisan config:clear
    php artisan cache:clear
    php artisan config:cache

    setting > history > clear history
    Application > clear
*/
