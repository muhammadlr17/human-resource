<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\EmployeeController;

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

Route::middleware(['auth'])->group(function () {
 
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('profile', [App\Http\Controllers\HomeController::class, 'profile']);
 
    Route::middleware(['admin'])->group(function () {
        Route::get('admin', [AdminController::class, 'index']);
        //Route::get('admin/profile', [AdminController::class, 'profile']);
        Route::resource('companies', CompanyController::class);
        Route::resource('departements', DepartementController::class);
        Route::get('employees/company/{id?}', [EmployeeController::class,'employeesByCompany']);
        Route::get('employees/departement/{id?}', [EmployeeController::class,'employeesByDepartement']);
        Route::resource('employees', EmployeeController::class);
    });
 
    Route::middleware(['user'])->group(function () {
        Route::get('user', [UserController::class, 'index']);
        //Route::get('user/profile', [UserController::class, 'profile']);
    });
 
    Route::get('/logout', function() {
        Auth::logout();
        redirect('/');
    });
 
});
