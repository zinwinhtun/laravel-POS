<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RouteController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('product/list',[RouteController::class,'products']);
Route::get('category/list',[RouteController::class,'category']);
Route::get('user/list',[RouteController::class,'user']);
Route::get('order/list',[RouteController::class,'order']);
Route::get('order_list/list',[RouteController::class,'order_list']);
Route::get('contact/list',[RouteController::class,'contact']);

//POST
Route::post('create/category',[RouteController::class,'createCategory']);
Route::post('create/contact',[RouteController::class , 'createContact']);
Route::post('delete/category',[RouteController::class , 'deleteCategory']);
Route::get('category/details/{id}',[RouteController::class , 'categoryDetails']);
Route::post('update/category',[RouteController::class , 'updateCategory']);

/**
 * 
 *
 * create contact
 * localhost:8000/api/create/contact (post)
 * key => name , email , message
 *
 * create Category
 * localhost:8000/api/create/category (post)
 * key = > category_name
 *
 * delete Category
 * localhost:8000/api/delete/category (post)
 * key = > category_id
 *
 * details Category
 * localhost:8000/api/category/details/{id} (get)
 *
 * update category
 * localhost:8000/api/update/category (post)
 * key = > for id (category_id) , for name (category_name)
 *
 *
 */
