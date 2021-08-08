<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
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
            return redirect()->route('companies.create')->with('failed', 'Company already exist!');
        }
        return redirect('companies')->with('success', 'Data have been succesfully saved!');
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
            return redirect()->route('companies.index')->with('failed', 'You cant edit to an existing Company!');
        }
        return redirect('companies')->with('success', 'Data have been succesfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return redirect('companies')->with('success', 'Data have been succesfully moved to trash!');
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
        if ($slug != null) {
            $companies->where('slug', $slug)->restore();
        } else {
            $companies->restore();
        }

        return redirect('companies/trash')->with('success', 'Data have been successfully restored!');
    }

    public function delete($slug = null)
    {
        $companies = Company::onlyTrashed();
        if ($slug != null) {
            $company = $companies->where('slug', $slug)->first();
            File::delete('image/logo/' . $company->logo);
            $company->forceDelete();
        } else {
            $companies->forceDelete();
        }

        return redirect('companies/trash')->with('success', 'Data have been successfully deleted!');
    }
}
