<?php

namespace App\Http\Controllers;

use Hash;
use Illuminate\Http\Request;
use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\User;
use App\Models\Company;
use App\Models\Departement;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = User::all();
        return view('admin.employee.index', compact(
            'employees'
        ));
    }

    public function employeesByCompany(Company $company)
    {
        $employees = $company->employees;
        return view('admin.employee.employeesByCompany', compact(
            'employees', 'company'
        ));
    }
    public function employeesByDepartement(Departement $departement)
    {
        $employees = $departement->employees;
        return view('admin.employee.employeesByDepartement', compact(
            'employees', 'departement'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all();
        $departements = Departement::all();
        return view('admin.employee.create', compact(
            'companies','departements'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateEmployeeRequest $request)
    {
        User::create($request->all());
        return redirect('employees')->with('success', 'Data have been succesfully saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $employee)
    {
        return view('admin.employee.detail', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $employee)
    {
        $companies = Company::all();
        $departements = Departement::all();   
        return view('admin.employee.edit', compact(
            'employee','companies','departements'
        ));
    }
    
    public function reset($username)
    {
        $employee = User::where('username', $username)->first();
        return view('admin.employee.reset', compact(
            'employee'
        ));
    }

    public function resetPassword(ResetPasswordRequest $request, $username)
    {
        $employee = User::where('username', $username)->first();
        if ($employee) {
            if(Hash::check($request->old_password, $employee->password)) {
                $employee->password = $request->password;
                $employee->save();
                return redirect("employees/reset/$username")->with('success','Change Password Successfully!');
            } else {
                return redirect("employees/reset/$username")->with('failed','Old Password Invalid!');
            }
        } else {
            return redirect("employees")->with('failed','Employee not Found');
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeRequest $request, User $employee)
    {
        $employee->update($request->all());
        return redirect('employees')->with('success','Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
