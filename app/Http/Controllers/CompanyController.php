<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Exception;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();
        return view('admin.company.index', compact(
            'companies'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        $data = $request->all();
        if ($request->file('logo')) {
            $file = $request->file('logo');
            $nama_file = time() . str_replace(" ", "", $file->getClientOriginalName());
            $file->move('image/logo', $nama_file);
            $data['logo'] = $nama_file;
        }
        $data['slug'] = Str::slug($data['name']);
        try {
            Company::create($data);
        } catch (Exception $exception) {
            alert()->warning('Warning','Company already exist!');
            return redirect()->route('companies.create');
        }
        alert()->success('Success','Data have been succesfully saved!');
        return redirect('companies');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return view('admin.company.detail', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('admin.company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $data = $request->all();
        if ($request->file('logo')) {
            File::delete('image/logo/' . $company->logo);
            $file = $request->file('logo');
            $nama_file = time() . str_replace(" ", "", $file->getClientOriginalName());
            $file->move('image/logo', $nama_file);
            $data['logo'] = $nama_file;
        }
        $data['slug'] = Str::slug($data['name']);
        try {
            $company->update($data);
        } catch (Exception $exception) {
            alert()->warning('Warning','You cant edit to an existing Company!');
            return redirect()->route('companies.index');
        }
        alert()->success('Success','Data have been succesfully updated!');
        return redirect('companies');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $user = User::where('company_id', $company->id)->count();
        if ($user > 0){
            return response()
                ->json(array(
                    'error'   => true,
                    'title'   => 'Denied',
                    'message' => 'You cant remove this company, because this company still has employees'
                ));
        }else{
            $company->delete();
            return response()
                ->json(array(
                    'success' => true,
                    'title'   => 'Success',
                    'message' => 'Your file has been moved to trash!'
                ));
        }

        /* $company->delete();
        alert()->success('Success','Data have been succesfully moved to trash!');
        return redirect('companies'); */
    }

    public function trash()
    {
        $companies = Company::onlyTrashed()->get();
        return view('admin.company.trash', compact(
            'companies'
        ));
    }

    public function restore($slug = null)
    {
        $companies = Company::onlyTrashed();
        if($companies->count() == 0) {
            alert()->success('Clear', 'Trash is empty!');
            return redirect('companies/trash');
        }

        if ($slug != null) {
            $companies->where('slug', $slug)->restore();
            alert()->success('Success','Data have been successfully restored!');
            return redirect('companies/trash');
        } else {
            $companies->restore();
            alert()->success('Success','All data have been successfully restored!');
            return redirect('companies/trash');
        }

    }

    public function delete($slug = null)
    {
        $companies = Company::onlyTrashed();
        if($companies->count() == 0) {
            return response()
                ->json(array(
                    'success' => true,
                    'title'   => 'Clear',
                    'message' => 'Trash is empty!'
                ));
        }

        if ($slug != null) {
            $company = $companies->where('slug', $slug)->first();
            File::delete('image/logo/' . $company->logo);
            $company->forceDelete();
            return response()
                ->json(array(
                    'success' => true,
                    'title'   => 'Deleted',
                    'message' => 'Data have been permananetly deleted!'
            ));
        } else {
            $companies->forceDelete();
            return response()
                ->json(array(
                    'success' => true,
                    'title'   => 'Deleted',
                    'message' => 'All data have been permananetly deleted!'
            ));
        }
        /* alert()->success('Success','Data have been successfully deleted!');
        return redirect('companies/trash'); */
    }
}
