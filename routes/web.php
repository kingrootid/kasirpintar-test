<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::middleware('auth')->group(function () {
    Route::get('dashboard', [\App\Http\Controllers\ViewController::class, 'dashboard']);
    Route::get('request-reimbursement', [\App\Http\Controllers\ViewController::class, 'reqreimbursement']);
    Route::get('reimbursement', [\App\Http\Controllers\ViewController::class, 'reimbursement']);
    Route::get('user_namereimbursement', [\App\Http\Controllers\ViewController::class, 'reimbursement']);
    Route::get('users', [\App\Http\Controllers\ViewController::class, 'user'])->middleware('direkturroles');


    Route::group(['prefix' => 'data'], function () {
        Route::get('req-reimbursement', [\App\Http\Controllers\DataController::class, 'reqreimbursement']);
        Route::post('req-reimbursement', [\App\Http\Controllers\DataController::class, 'getreqreimbursement']);
        Route::get('reimbursement', [\App\Http\Controllers\DataController::class, 'reimbursement']);
        Route::post('reimbursement', [\App\Http\Controllers\DataController::class, 'getreqreimbursement']);
        Route::get('users', [\App\Http\Controllers\DataController::class, 'user']);
        Route::post('users', [\App\Http\Controllers\DataController::class, 'getuser']);
    });
    Route::group(['prefix' => 'ajax'], function () {
        Route::post('hapus', [\App\Http\Controllers\PostController::class, 'hapusFunc']);
        Route::post('req-reimbursement', [\App\Http\Controllers\PostController::class, 'ReqReimbursement']);
        Route::post('verifikasi', [\App\Http\Controllers\PostController::class, 'verifikasi']);
        Route::post('users', [\App\Http\Controllers\PostController::class, 'users']);
    });
});
Route::get('login', [\App\Http\Controllers\ViewController::class, 'login'])->name('login');
Route::post('login', [\App\Http\Controllers\PostController::class, 'login']);
Route::get('logout', function () {
    Auth::logout();
    return redirect('login');
});
