<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

/*
|--------------------------------------------------------------------------
| Routes Admin
|--------------------------------------------------------------------------
|
*/
Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => ['auth', 'isAdmin']
], function () {
    // dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // users
    Route::get('/users', [UserController::class, 'index'])->name('user.index');
});

/*
|--------------------------------------------------------------------------
| Routes Frontend
|--------------------------------------------------------------------------
|
*/

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');