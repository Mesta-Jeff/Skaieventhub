<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebUserController;
use App\Http\Controllers\WebManagementController;

Route::get('/', function () {
    return view('welcome');
});



Route::get('management/dashboard', [WebManagementController::class, 'dashboard'])->name('management.dashboard');

Route::post('/user/add', [WebUserController::class, 'createUser'])->name('user.add');
Route::post('/user/update', [WebUserController::class, 'updateUser'])->name('user.update');
Route::post('/user/distroy', [WebUserController::class, 'distroyUser'])->name('user.distroy');
Route::get('/user/list', [WebUserController::class, 'usersList'])->name('user.list');

Route::post('/user/freeRoute', [WebUserController::class, 'freeRoute'])->name('user.freeRoute');


// require __DIR__.'/auth.php';
