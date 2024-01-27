<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;

// log in /register
Route::middleware(['admin_auth'])->group(function () {
    Route::redirect('/', 'loginPage');
    Route::get('loginPage', [authController::class, 'loginPage'])->name('auth#loginPage');
    Route::get('registerPage',[authController::class,'registerPage'])->name('auth#registerPage');
});

// admin / user
    Route::middleware(['auth'])->group(function () {
        //dashboard
        Route::get('dashboard',[authController::class,'dashboard'])->name('dashboard');

        //admin
    Route::middleware(['admin_auth'])->group(function () {
        // category->list
        Route::prefix('category')->group(function (){
            Route::get('/list',[CategoryController::class,'list'])->name('category#list');
            Route::get('/create/page',[CategoryController::class,'createPage'])->name('category#createPage');
            Route::post('/create',[CategoryController::class,'create'])->name('category#create');
            Route::get('/delete/{id}',[CategoryController::class,'delete'])->name('category#delete');
            Route::get('/edit/{id}',[CategoryController::class,'edit'])->name('category#edit');
            Route::post('/update/{id}',[CategoryController::class,'update'])->name('category#update');
        });

        //admin account
        Route::prefix('admin')->group(function () {
            //password
            Route::get('password/changePage',[AdminController::class,'changePasswordPage'])->name('admin#changePasswordPage');
            Route::post('change/password',[AdminController::class,'changePassword'])->name('admin#changePassword');

            //account
            Route::get('detail',[AdminController::class,'detail'])->name('admin#detail');
            Route::get('edit',[AdminController::class,'edit'])->name('admin#edit');
            Route::post('update/{id}',[AdminController::class ,'update'])->name('admin#update');

            //admin list
            Route::get('list',[AdminController::class,'list'])->name('admin#list');
            Route::get('delete/{id}',[AdminController::class,'delete'])->name('admin#delete');
            Route::get('changeRole/{id}',[AdminController::class,'changeRole'])->name('admin#changeRole');
            Route::post('change/role/{id}',[AdminController::class,'change'])->name('admin#change');

        });

        //Product
        Route::prefix('products')->group(function () {
            Route::get('list', [ProductController::class, 'list'])->name('product#list');
            Route::get('create',[ProductController::class, 'createPage'])->name('product#createPage');
            Route::post('create',[ProductController::class,'create'])->name('product#create');
            Route::get('delete/{id}',[ProductController::class,'delete'])->name('product#delete');
            Route::get('view/{id}',[ProductController::class ,'view'])->name('product#view');
            Route::get('edit/{id}',[ProductController::class,'edit'])->name('product#edit');
            Route::post('update',[ProductController::class,'update'])->name('product#update');
        });

         //Order
         Route::prefix('order')->group(function () {
            Route::get('list', [OrderController::class, 'list'])->name('admin#orderList');
            Route::get('change/status',[OrderController::class,'changeStatus'])->name('admin#changeStatus');
            Route::get('ajax/status/change',[OrderController::class,'ajaxStatusChange'])->name('admin#ajaxStatusChange');
            Route::get('ajax/change/role',[AdminController::class,'ajaxChangeRole'])->name('admin#ajaxChangeRole');
            Route::get('listInfo/{orderCode}', [OrderController::class, 'listInfo'])->name('admin#listInfo');
        });

        //User
        Route::prefix('user')->group(function () {
            Route::get('list', [UserController::class, 'userList'])->name('admin#userList');
            Route::get('change/userRole',[UserController::class,'changeUserRole'])->name('admin#ChangeUserRole');
            Route::get('delete/{id}', [UserController::class, 'delete'])->name('admin#userDelete');
            Route::get('view/{id}', [UserController::class, 'view'])->name('admin#view');
        });

        Route::prefix('contact')->group(function () {
            Route::get('list', [ContactController::class, 'contactList'])->name('admin#contactList');
        });

    });


    //user
    //user is not include middleware 
        Route::group(['prefix'=> '/user','middleware'=> 'user_auth'] , function(){
           Route::get('/homePage',[UserController::class,'home'])->name('user#home');
           Route::get('filter/{id}', [UserController::class, 'filter'])->name('user#filter');
           Route::get('history',[UserController::class,'history'])->name('user#history');

           //pizza
           Route::prefix('pizza')->group(function(){
            Route::get('detail/{id}',[UserController::class,'pizzaDetail'])->name('pizza#detail');
           });

           //cart
           Route::prefix('cart')->group(function(){
            Route::get('list',[UserController::class,'cartList'])->name('user#cartList');
           });

           //change password
           Route::prefix('password')->group(function(){
            Route::get('/change',[UserController::class,'changePasswordPage'])->name('user#changePasswordpage');
            Route::post('change',[UserController::class,'changePassword'])->name('user#changePassword');
            Route::get('profile',[UserController::class,'profile'])->name('user#profile');
            Route::post('updateProfile/{id}',[UserController::class,'updateProfile'])->name('user#updateProfile');
           });

           //ajax
           Route::prefix('ajax')->group(function(){
                Route::get('pizza/list',[AjaxController::class,'pizzaList'])->name('ajax#pizzaList');
                Route::get('cart',[AjaxController::class,'addToCart'])->name('ajax#addToCart');
                Route::get('order', [AjaxController::class, 'order'])->name('ajax#order');
                Route::get('delete/cart',[AjaxController::class,'deleteCart'])->name('ajax#deleteCart');
                Route::get('delete/order',[AjaxController::class,'deleteOrder'])->name('ajax#deleteOrder');
                Route::get('increse/viewCount',[AjaxController::class,'increaseViewCount'])->name('ajax#increaseViewCount');
           });

           //contact
           Route::prefix('contact')->group(function(){
            Route::get('contact',[ContactController::class,'contact'])->name('user#contact');
            Route::post('sentMessage',[ContactController::class,'sentMessage'])->name('user#sentMessage');
           });

        });

    });


