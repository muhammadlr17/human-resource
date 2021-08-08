@extends('layouts.main')

@section('title', '| Departement')
@section('content')
@if (Session::has('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
        <i class="fa fa-check-circle"></i> {{ Session::get('success') }}
    </div>
@endif
@if (Session::has('failed'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
        <i class="fa fa-times-circle"></i> {{ Session::get('failed') }}
    </div>
@endif
<div class="panel panel-headline">
    <div class="panel-heading">
        <h3 class="panel-title">Departements</h3>
        <a href="{{ route('departements.create') }}" class="btn btn-xs btn-success text-light">
            <i class="fa fa-plus"></i> Add
        </a>
        <a href="{{ route('departements.trash') }}" class="btn btn-xs btn-warning text-light">
            <i class="fa fa-trash"></i> Recycle Bin
        </a>
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
                                    <a href="{{ route('departements.show', $departement) }}"
                                        class="btn btn-xs btn-info text-light"><span class="lnr lnr-eye"></span></a>
                                    <a href="{{ route('departements.edit', $departement) }}"
                                        class="btn btn-xs btn-warning text-light"><span
                                            class="lnr lnr-pencil"></span></a>
                                    <form method="POST" action="{{ route('departements.destroy', $departement) }}"
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
