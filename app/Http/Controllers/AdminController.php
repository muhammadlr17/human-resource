<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
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

    
}
