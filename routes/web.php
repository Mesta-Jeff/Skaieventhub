<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\web\UserController;
use App\Http\Controllers\web\ManagementController;

Route::get('/', function () {
    return view('welcome');
});



Route::get('management/dashboard', [ManagementController::class, 'dashboard'])->name('management.dashboard');

Route::post('/user/add', [UserController::class, 'createUser'])->name('user.add');
Route::post('/user/update', [UserController::class, 'updateUser'])->name('user.update');
Route::post('/user/distroy', [UserController::class, 'distroyUser'])->name('user.distroy');
Route::get('/user/list', [UserController::class, 'usersList'])->name('user.list');

Route::post('/user/freeRoute', [UserController::class, 'freeRoute'])->name('user.freeRoute');


// require __DIR__.'/auth.php';
