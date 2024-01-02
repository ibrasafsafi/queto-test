<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RecipeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::name('api.')
  ->prefix('queto')
  ->group(function () {

    // Auth routes
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::group(['middleware' => 'auth:sanctum'], function () {
      Route::get('/products', [ProductController::class, 'index']);
      Route::post('/products', [ProductController::class, 'store']);
      Route::get('/recipes', [RecipeController::class, 'index']);
      Route::post('/recipes/{recipe}', [RecipeController::class, 'validateRecipe']);
    });
  });

