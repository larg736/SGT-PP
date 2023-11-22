<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GraphController;


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

    /* Inicio */
    Route::resource('home', \App\Http\Controllers\HomeController::class);
    /* Solicitudes o tareas */
    Route::resource('demands', \App\Http\Controllers\DemandController::class);
    Route::get('/demands/{id}/take', '\App\Http\Controllers\DemandController@take');
    Route::get('/demands/{id}/solve', '\App\Http\Controllers\DemandController@solve');
    Route::get('/demands/{id}/open', '\App\Http\Controllers\DemandController@open');
    Route::get('/demands/{id}/nextLevel', '\App\Http\Controllers\DemandController@nextLevel');
    Route::get('/demands/{id}/details', '\App\Http\Controllers\DemandController@details');
    Route::get('/demandsprint', '\App\Http\Controllers\DemandController@prnpriview')->name('demands.prnpriview');
    Route::post('/update-demands', '\App\Http\Controllers\DemandController@updateDemands')->name('update.demands');

    // Graficas
    Route::view('graphusers', 'users.graphusers');
    Route::view('graph', 'demands.graph');
    Route::controller(GraphController::class)->group(function () {
        Route::get('demands-filter', 'filter');
        Route::get('users-filter', 'graphusers');
    });

    /* Departamento */
    Route::resource('departments', \App\Http\Controllers\DepartmentsController::class);
    Route::get('/seleccionar/Departments/{id}', '\App\Http\Controllers\HomeController@selectDepartment');
    Route::get('/departments/{id}/restore', '\App\Http\Controllers\DepartmentsController@restore');
    Route::resource('departments_user', \App\Http\Controllers\DepartmentUserController::class);
    Route::get('/departments_user/{id}/editar', '\App\Http\Controllers\DepartmentUserController@edit');
    Route::get('/departments_user/{id}/restore', '\App\Http\Controllers\DepartmentUserController@restore');
    Route::get('/departmentsprint', '\App\Http\Controllers\DepartmentsController@prnpriview');

    /* Usuario */
    Route::resource('users', \App\Http\Controllers\UsersController::class);
    Route::get('/usersprint', '\App\Http\Controllers\UsersController@prnpriview');
    Route::get('/users/{id}/restore', '\App\Http\Controllers\UsersController@restore');

    /* Categoria */
    Route::resource('categories', \App\Http\Controllers\CategoryController::class);
    Route::get('/categories/{id}/restore', '\App\Http\Controllers\CategoryController@restore');
    Route::get('/categories/{id}/editar', '\App\Http\Controllers\CategoryController@edit');

    /* Nivel */
    Route::resource('levels', \App\Http\Controllers\LevelController::class);
    Route::get('/levels/{id}/restore', '\App\Http\Controllers\LevelController@restore');
    Route::get('/levels/{id}/editar', '\App\Http\Controllers\LevelController@edit');

});
