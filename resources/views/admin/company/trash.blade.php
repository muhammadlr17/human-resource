@extends('layouts.main')

@section('title', '| Trash Companies')
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
        <a href="{{ route('companies.index') }}" class=" badge"><i class="lnr lnr-arrow-left"></i> Back</a>
        <a href="{{ route('companies.restore') }}" class="btn btn-xs btn-success text-light">
            <i class="fa fa-undo"></i> Restore All
        </a>
        <form method="POST" action="{{ route('companies.delete') }}" style="display: inline"
            onsubmit="return confirm('Data akan dihapus permanen. Yakin?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-xs btn-danger text-light"><span class="fa fa-trash"></span>
                Delete Permanently All</button>
        </form>
    </div>
    <div class="panel panel-headline">
        <div class="panel-heading">
            <h3 class="panel-title">Trash Employees</h3>
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
                        @if ($companies->count() > 0)
                            @foreach ($companies as $company)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $company->name }}</td>
                                    <td>{{ $company->email }}</td>
                                    <td class="text-center">
                                        @if (strlen($company->logo) > 0)
                                            <img src="{{ asset('image/logo/' . $company->logo) }}" width="40px"
                                                class="img-circle">
                                        @endif
                                    </td>
                                    <td>{{ $company->website_url }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('companies.restore', $company->slug) }}"
                                            class="btn btn-xs btn-success text-light"><span class="lnr lnr-undo"></span></a>
                                        <form method="POST" action="{{ route('companies.delete', $company->slug) }}"
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
