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
    Route::get('profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
 
    Route::middleware(['admin'])->group(function () {
        Route::get('admin', [AdminController::class, 'index'])->name('admin');
        //Route::get('admin/profile', [AdminController::class, 'profile']);
        
        //Company
        Route::resource('companies', CompanyController::class);
        
        //Departement
        Route::resource('departements', DepartementController::class);
        
        //Employee
        Route::get('employees/company/{company:slug}',           [EmployeeController::class,'employeesByCompany'])->name('employees.company');
        Route::get('employees/departement/{departement:slug}',   [EmployeeController::class,'employeesByDepartement'])->name('employees.departement');
        Route::get('employees/reset/{username?}',                [EmployeeController::class,'reset'])->name('employees.reset');
        Route::put('employees/reset/{username?}',                [EmployeeController::class,'resetPassword'])->name('employees.resetpassword');
        Route::get('employees/trash',                            [EmployeeController::class,'trash'])->name('employees.trash');
        Route::get('employees/restore/{username?}',              [EmployeeController::class,'restore'])->name('employees.restore');
        Route::delete('employees/delete/{username?}',            [EmployeeController::class,'delete'])->name('employees.delete');
        Route::resource('employees',                             EmployeeController::class);
    });
 
    Route::middleware(['user'])->group(function () {
        Route::get('user', [UserController::class, 'index'])->name('user');
        //Route::get('user/profile', [UserController::class, 'profile']);
    });
 
    Route::get('/logout', function() {
        Auth::logout();
        redirect('/');
    });
 
});
