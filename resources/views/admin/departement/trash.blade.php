@extends('layouts.main')

@section('title', '| Trash Departements')
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
    <div class="panel panel-body">
        <a href="{{ route('departements.index') }}" class=" badge"><i class="lnr lnr-arrow-left"></i> Back</a>
        <a href="{{ route('departements.restore') }}" class="btn btn-xs btn-success text-light">
            <i class="fa fa-undo"></i> Restore All
        </a>
        <form method="POST" action="{{ route('departements.delete') }}" style="display: inline"
            onsubmit="return confirm('Data akan dihapus permanen. Yakin?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-xs btn-danger text-light"><span class="fa fa-trash"></span>
                Delete Permanently All</button>
        </form>
    </div>
    <div class="panel panel-headline">
        <div class="panel-heading">
            <h3 class="panel-title">Trash Departements</h3>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table id="myTable" class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Logo</th>
                            <th>Website URL</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($departements->count() > 0)
                            @foreach ($departements as $departement)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $departement->name }}</td>
                                    <td>{{ $departement->email }}</td>
                                    <td class="text-center">
                                        @if (strlen($departement->logo) > 0)
                                            <img src="{{ asset('image/logo/' . $departement->logo) }}" width="40px"
                                                class="img-circle">
                                        @endif
                                    </td>
                                    <td>{{ $departement->website_url }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('departements.restore', $departement->slug) }}"
                                            class="btn btn-xs btn-success text-light"><span class="lnr lnr-undo"></span></a>
                                        <form method="POST"
                                            action="{{ route('departements.delete', $departement->slug) }}"
                                            style="display: inline" onsubmit="return confirm('Yakin hapus data?')">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-xs btn-danger"><span
                                                    class="lnr lnr-trash"></span></button>
                                        </form>
                                    </td>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
