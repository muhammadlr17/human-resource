@extends('layouts.main')

@section('title', '| Departement')
@section('content')
    <div class="panel panel-headline">
        <div class="panel-heading">
            <h3 class="panel-title">Departements</h3>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table id="myTable" class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($departements->count() > 0)
                            @foreach ($departements as $departement)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $departement->name }}</td>
                                    <td>{{ $departement->description }}</td>
                                    <td class="text-center">
                                        <a href="{{ url('departements/' . $departement->id) }}"
                                            class="btn btn-xs btn-info text-light"><span class="lnr lnr-eye"></span></a>
                                        <a href="{{ url('departements/' . $departement->id . '/edit') }}"
                                            class="btn btn-xs btn-warning text-light"><span
                                                class="lnr lnr-pencil"></span></a>
                                        <form method="POST" action="{{ url('departements/' . $departement->id) }}"
                                            style="display: inline" onsubmit="return confirm('Yakin hapus data?')">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-xs btn-danger"><span
                                                    class="lnr lnr-trash"></span></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    @endsection
