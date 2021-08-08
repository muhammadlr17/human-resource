@extends('layouts.main')

@section('title', '| Edit Departement')
@section('content')
<div class="panel panel-headline">
    <div class="panel-heading">
        <h3 class="panel-title">Edit Departement :
            <b>{{ $departement->name }}</b>
        </h3>
    </div>
    <div class="panel-body">
        <form method="POST" action="{{ route('departements.update', $departement) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            @include('admin.departement._formEdit')
        </form>
    </div>
@endsection
