<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthenticationController;


Route::get('/user', function (Request $request) {
    return $request->all();
})->middleware('auth:sanctum');




Route::prefix('v2')->group(function () {
    Route::post('/user/register', [AuthenticationController::class, 'register']);
    // Route::middleware('auth:sanctum')->get('/user/list', [AuthenticationController::class, 'getAllUsers']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user/list', [AuthenticationController::class, 'getAllUsers']);
        Route::post('/users/add', [AuthenticationController::class, 'addUser']);
    });

});
