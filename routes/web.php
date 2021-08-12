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
    return view('auth.login');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::get('/home',                         [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('profile',                       [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
    Route::put('profile/{user}',                [App\Http\Controllers\HomeController::class, 'profileUpdate'])->name('profile.update');
    Route::get('profile/reset/{username?}',     [App\Http\Controllers\HomeController::class, 'reset'])->name('profile.reset');
    Route::put('profile/reset/{username?}',     [App\Http\Controllers\HomeController::class, 'resetPassword'])->name('profile.resetpassword');

    Route::middleware(['admin'])->group(function () {
        Route::get('admin',             [AdminController::class, 'index'])->name('admin');
        Route::get('cleaner',           [AdminController::class, 'cleaner'])->name('cleaner');
        Route::get('cleaner/process',   [AdminController::class, 'cleanerProcess'])->name('cleaner.process');

        //Company
        Route::get('companies/trash',                       [CompanyController::class,'trash'])->name('companies.trash');
        Route::get('companies/restore/{slug?}',             [CompanyController::class,'restore'])->name('companies.restore');
        Route::delete('companies/delete/{slug?}',           [CompanyController::class,'delete'])->name('companies.delete');
        Route::resource('companies',                        CompanyController::class);

        //Departement
        Route::get('departements/trash',                    [DepartementController::class,'trash'])->name('departements.trash');
        Route::get('departements/restore/{slug?}',          [DepartementController::class,'restore'])->name('departements.restore');
        Route::delete('departements/delete/{slug?}',        [DepartementController::class,'delete'])->name('departements.delete');
        Route::resource('departements',                     DepartementController::class);

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
        return redirect('/');
    });

});
