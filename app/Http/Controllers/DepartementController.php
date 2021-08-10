<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DepartementRequest;
use App\Models\Departement;
use App\Models\User;
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
            alert()->warning('Warning','Departement already exist!');
            return redirect()->route('departements.create');
        }

        alert()->success('Success','Data have been successfully saved!');
        return redirect('departements');
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
            alert()->warning('Warning','You cant edit to an existing Departement!');
            return redirect()->route('departements.index');
        }

        alert()->success('Success','Data have been successfully updated!');
        return redirect('departements');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Departement $departement)
    {
        $user = User::where('departement_id', $departement->id)->count();
        if ($user > 0){
            return response()
                ->json(array(
                    'error'   => true,
                    'title'   => 'Denied',
                    'message' => 'You cant remove this department, because this department still has employees'
                ));
        }else{
            $departement->delete();
            return response()
                ->json(array(
                    'success' => true,
                    'title'   => 'Removed',
                    'message' => 'Your file has been moved to trash!'
                ));
        }
        /* alert()->success('Success','Data have been moved to trash');
        return redirect('departements'); */
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
        if ($departements->count() == 0) {
            alert()->success('Clear', 'Trash is empty!');
            return redirect('departements/trash');
        }

        if ($slug != null) {
            $departements->where('slug', $slug)->restore();
            alert()->success('Success','Data have been successfully restored!');
            return redirect('departements/trash');
        } else {
            $departements->restore();
            alert()->success('Success','All data have been successfully restored!');
            return redirect('departements/trash');
        }

    }

    public function delete($slug = null)
    {
        $departements = Departement::onlyTrashed();
        if($departements->count() == 0) {
            return response()
                ->json(array(
                    'success' => true,
                    'title'   => 'Clear',
                    'message' => 'Trash is empty!'
                ));
        }

        if ($slug != null) {
            $departements->where('slug', $slug)->forceDelete();
            return response()
                ->json(array(
                    'success' => true,
                    'title'   => 'Deleted',
                    'message' => 'Data have been permananetly deleted!'
                ));
        } else {
            $departements->forceDelete();
            return response()
                ->json(array(
                    'success' => true,
                    'title' => 'Deleted',
                    'message' => 'All data have been permananetly deleted!'
                ));
        }
        /* alert()->success('Success','Data have been successfully deleted!');
        return redirect('departements/trash'); */
    }
}
