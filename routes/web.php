<?php

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

Route::middleware(['auth'])->group(function(){
    Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //ROUTE TO USERS
    Route::prefix('users')->name('users.')->group(function(){
        Route::get('/', [\App\Http\Controllers\UserController::class, 'index'])->name('index');
        Route::get('/edit/{id}', [\App\Http\Controllers\UserController::class, 'edit'])->name('edit');
    });

    //ROUTE TO ROLES
    Route::prefix('roles')->name('roles.')->group(function(){
        Route::get('/', [\App\Http\Controllers\Permission\RoleController::class, 'index'])->name('index');
    });

    //ROUTE TO PERMISSIONS
    Route::prefix('permissions')->name('permissions.')->group(function(){
        Route::get('/', [\App\Http\Controllers\Permission\PermissionController::class, 'index'])->name('index');
    });
});
