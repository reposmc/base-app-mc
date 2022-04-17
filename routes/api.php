<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\MunicipalityController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(
    [
        'middleware' => ['api', 'throttle:api'],
        'prefix' => 'auth'
    ],
    function ($router) {
        Route::post('login', [AuthController::class, 'login']);
    }
);

Route::group(
    [
        'middleware' => ['api', 'throttle:api', 'auth:api', 'log'],
        'prefix' => 'auth'
    ],
    function ($router) {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::post('me', [AuthController::class, 'me']);
    }
);

Route::group(
    [
        'middleware' => ['api', 'throttle:api', 'auth:api', 'log', 'has.role:Administrador'],
    ],
    function ($router) {
        // Apis
        Route::resource('/department', DepartmentController::class);
        Route::resource('/municipality', MunicipalityController::class);
        Route::resource('/user', UserController::class);
        Route::resource('/role', RoleController::class);
    }
);
