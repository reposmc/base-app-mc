<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\MunicipalityController;

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
    return view('auth/login');
});

Auth::routes(['verify' => true]);

Route::group(['middleware'=> ['auth', 'verified']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::resource('/api/department', DepartmentController::class);
    Route::resource('/api/municipality', MunicipalityController::class);

    Route::get('/departamentos', function () {
        return view('department.index');
    });

    Route::get('/municipios', function () {
        return view('municipality.index');
    });
});
