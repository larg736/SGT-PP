<?php

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
    return view('auth/login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/home', function () { return view('home');})->name('home');
});

Route::group(['middleware' => 'auth'], function () {
    
    Route::get('/users/pdf', '\App\Http\Controllers\UsersController@pdf');

    Route::resource('home', \App\Http\Controllers\HomeController::class);

    Route::resource('demands', \App\Http\Controllers\DemandController::class);

    Route::get('/demands/{id}/atender', '\App\Http\Controllers\DemandController@take');

    Route::get('/demands/{id}/resuelto', '\App\Http\Controllers\DemandController@solve');

    Route::get('/demands/{id}/abrir', '\App\Http\Controllers\DemandController@open');

    Route::get('/demands/{id}/otro', '\App\Http\Controllers\DemandController@nextLevel');
    
    Route::get('/seleccionar/Departments/{id}', '\App\Http\Controllers\HomeController@selectDepartment');

    Route::resource('users', \App\Http\Controllers\UsersController::class);

    Route::resource('departments', \App\Http\Controllers\DepartmentsController::class);

    Route::get('/departments/{id}/restaurar', '\App\Http\Controllers\DepartmentsController@restore');

    Route::resource('categories', \App\Http\Controllers\CategoryController::class);

    Route::resource('levels', \App\Http\Controllers\LevelController::class);

    Route::resource('departments_user', \App\Http\Controllers\DepartmentUserController::class);

    Route::resource('messages', \App\Http\Controllers\MessageController::class);

});
