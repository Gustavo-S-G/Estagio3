<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ScheduleController;


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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('user', UserController::class);

    Route::resource('permission', PermissionController::class);

    Route::resource('role', App\Http\Controllers\RoleController::class);

    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');

    Route::post('/profile', [UserController::class, 'postProfile'])->name('user.postProfile');

    Route::get('/password/change', [UserController::class, 'getPassword'])->name('user.GetPassword');

    Route::post('/password/change', [UserController::class, 'postPassword'])->name('user.PostPassword');

    // Route::resource('schedule', ScheduleController::class);
    Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule.index');

});


Auth::routes();


//////////////////////////////// axios request

Route::get('/getAllPermission', [PermissionController::class, 'getAllPermissions']);
Route::post('/postRole', [RoleController::class, 'store']);
Route::get('/getAllUsers', [UserController::class, 'getAll']);
Route::get('/getAllRoles', [RoleController::class, 'getAll']);
Route::get('/getAllPermissions', [PermissionController::class, 'getAll']);


/////////////axios create user

Route::post('/account/create', [UserController::class, 'store']);
Route::put('/account/update/{id}', [UserController::class, 'update']);
Route::delete('/account/delete/{id}', [UserController::class, 'delete']);
Route::get('/search/user', [UserController::class, 'search']);


/////////////axios create role

Route::put('/role/update/{id}', [RoleController::class, 'update']);




