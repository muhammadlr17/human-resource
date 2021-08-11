<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Artisan;
use App\Models\Company;
use App\Models\Departement;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $companies = Company::count();
        $departements = Departement::count();
        $employees = User::count();
        return view('admin.home', compact(
            'user', 'companies', 'departements','employees'
        ));
    }

    public function cleaner()
    {
        return view('admin.cleaner');
    }

    public function cleanerProcess()
    {
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');

        return response()
            ->json(array(
                'success' => true
            ));
    }

}
