<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DepartementRequest;
use App\Models\Departement;
use Illuminate\Support\Str;
use Exception;

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
        return view('admin.departement.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartementRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($data['name']);

        try {
            Departement::create($data);
        } catch (Exception $exception) {
            return redirect()->route('departements.create')->with('failed', 'Departement already exist!');
        }

        return redirect('departements')->with('success', 'Data have been successfully saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Departement $departement)
    {
        return view('admin.departement.detail', compact('departement'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Departement $departement)
    {
        return view('admin.departement.edit', compact('departement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Departement $departement)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($data['name']);
        try {
            $departement->update($data);
        } catch (Exception $exception) {
            return redirect()->route('departements.index')->with('failed', 'You cant edit to an existing Departement!');
        }

        return redirect('departements')->with('success', 'Data have been successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Departement $departement)
    {
        $departement->delete();

        return redirect('departements')->with('success', 'Data have been moved to trash');
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
