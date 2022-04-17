<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\MunicipalityController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ExcelController;

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

Auth::routes(['verify' => true, 'remember_me'=>false]);

Route::group(['middleware'=> ['auth', 'verified', 'log', 'throttle:web']], function () {
    Route::group(['middleware'=>['has.role:Administrador']], function () {
        // Apis
        Route::resource('/api/web/department', DepartmentController::class);
        Route::resource('/api/web/municipality', MunicipalityController::class);
        Route::resource('/api/web/user', UserController::class);
        Route::resource('/api/web/role', RoleController::class);

        // Views
        Route::get('/departments', function () {
            return view('department.index');
        });

        Route::get('/municipalities', function () {
            return view('municipality.index');
        });

        Route::get('/users', function () {
            return view('user.index');
        });
    });

    //Reports
    Route::get('generate-pdf', [PDFController::class, 'generatePDF']);

    //Excel
    Route::get('export', [ExcelController::class, 'export']);

    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

Route::post('import', [ExcelController::class, 'import']);
