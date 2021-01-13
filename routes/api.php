<?php

use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['api']], function(){
    Route::any('/status', function(){
        return response()->json([
            'status' => 'alive',
        ], 200);
    })->name('health');

    Route::post('/register', [UserController::class, 'store'])->name('register.user');

    Route::post('/login', [UserController::class, 'login'])->name('login.user');

    Route::post('/register-apartment', [ApartmentController::class, 'store'])->name('register.apartment');

});


