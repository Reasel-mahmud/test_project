<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OneController;
use App\Http\Controllers\PoneUserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/', [AdminController::class,'index'])->name('home');
    Route::get('/add/phone/',[OneController::class,'addPhone'])->name('add.phone');
    Route::get('/add/user/',[PoneUserController::class,'adduser'])->name('add.user');
    Route::post('/new/phone/',[OneController::class,'savePhone'])->name('new.phone');
    Route::post('phone/delete',[OneController::class,'phoneDelete'])->name('phone.delete');

    Route::post('/update/phone',[OneController::class,'updatePhone'])->name('update.phone');

    Route::get('edit-phone/{id}',[OneController::class,'phoneEdit']);

});
