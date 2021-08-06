<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Request\DepartementRequest;
use App\Models\Departement;

class DepartementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departements = Departement::all();
        return view('admin.departement.index', compact(
            'departements'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $departements = Departement::onlyTrashed()->get();
        return view('admin.departement.trash', compact(
            'departements'
        ));
    }

    public function restore($slug = null)
    {
        $departements = Departement::onlyTrashed();
        if ($slug != null) {
            $departements->where('slug', $slug)->restore();
        } else {
            $departements->restore();
        }

        return redirect('departements/trash')->with('success', 'Data have been successfully restored!');
    }

    public function delete($slug = null)
    {
        $departements = Departement::onlyTrashed();
        if ($slug != null) {
            $departements->where('slug', $slug)->forceDelete();
        } else {
            $departements->forceDelete();
        }

        return redirect('departements/trash')->with('success', 'Data have been successfully deleted!');
    }
}
