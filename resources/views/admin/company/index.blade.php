@extends('layouts.main')

@section('title', '| Company')
@section('content')
    <div class="panel panel-headline">
        <div class="panel-heading">
            <h3 class="panel-title">Companies</h3>
            <a href="{{ route('companies.create') }}" class="btn btn-xs btn-success text-light">
                <i class="fa fa-plus"></i> Add
            </a>
            <a href="{{ route('companies.trash') }}" class="btn btn-xs btn-warning text-light">
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
                                            <img src="{{ asset('image/' . $company->gambar) }}" width="80px">
                                        @endif
                                    </td>
                                    <td>{{ $company->website_url }}</td>
                                    <td class="text-center">
                                        <a href="{{ url('companies/' . $company->id) }}"
                                            class="btn btn-xs btn-info text-light"><span class="lnr lnr-eye"></span></a>
                                        <a href="{{ url('companies/' . $company->id . '/edit') }}"
                                            class="btn btn-xs btn-warning text-light"><span
                                                class="lnr lnr-pencil"></span></a>
                                        <form method="POST" action="{{ url('companies/' . $company->id) }}"
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
