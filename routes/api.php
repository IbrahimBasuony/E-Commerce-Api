<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


//----------------------Login / Register ------------------------
Route::post('register',[AuthController::class,'register']);

Route::post('login',[AuthController::class,'login']);



//------------------------Category --------------------

Route::get('category/{id}',[CategoryController::class,'category']);

Route::get('categories',[CategoryController::class,'categories']);






//------------------------Products --------------------

Route::get('product/{id}',[ProductController::class,'product']);

Route::get('products',[ProductController::class,'products']);





Route::middleware(['auth:sanctum','is-admin'])->group(function(){

         //--------------------- Category Auth & Admin ---------------------------------------
         Route::post('insertCategory',[CategoryController::class,'insertCategory']);

         Route::put('updateCategory/{id}',[CategoryController::class,'updateCategory']);
     
         Route::delete('deleteCategory/{id}',[CategoryController::class,'deleteCategory']);
        
          //--------------------- Product Auth & Admin ---------------------------------------
         Route::post('insertProduct',[ProductController::class,'insertProduct']);
     
         Route::put('updateProduct/{id}',[ProductController::class,'updateProduct']);
     
         Route::delete('deleteProduct/{id}',[ProductController::class,'deleteProduct']);


});



    //----------------------Auth -------------------------------
Route::middleware('auth:sanctum')->group(function(){

    Route::post('logout',[AuthController::class,'logout']);



   
});