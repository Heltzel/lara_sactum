<?php
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::resource('products', ProductsController::class);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/products', [ProductsController::class, 'index']);
Route::get('/products/{id}', [ProductsController::class, 'show']);
Route::get('products/search/{name}', [ProductsController::class, 'search']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/products', [ProductsController::class, 'store']);
    Route::post('/products/{id}', [ProductsController::class, 'update']);
    Route::post('/products/{id}', [ProductsController::class, 'destroy']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
