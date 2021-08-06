<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Str;

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
        if($request->file('logo')){
            $file = $request->file('logo');
            $nama_file = time().str_replace(" ","", $file->getClientOriginalName());
            $file->move('image/logo', $nama_file); 
            $data['logo'] = $nama_file;
        }
        $data['slug'] = Str::slug($data['name']);
        Company::create($data);
        return redirect('companies')->with('success', 'Data have been succesfully saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    public function trash()
    {
        $companies = Company::onlyTrashed()->get();
        return view('admin.company.trash', compact(
            'companies'
        ));
    }

    /* public function restore($username = null)
    {
        $companies = User::onlyTrashed();
        if ($username != null) {
            $companies->where('username', $username)->restore();
        } else {
            $companies->restore();
        }

        return redirect('companies/trash')->with('success', 'Data have been successfully restored!');
    }

    public function delete($username = null)
    {
        $companies = User::onlyTrashed();
        if ($username != null) {
            $companies->where('username', $username)->forceDelete();
        } else {
            $companies->forceDelete();
        }

        return redirect('companies/trash')->with('success', 'Data have been successfully deleted!');
    } */
}
