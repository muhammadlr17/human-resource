@extends('layouts.main')

@section('title', '| Detail Departement')
@section('content')
<!-- PANEL HEADLINE -->
<div class="panel panel-headline">
    <div class="panel-heading">
        <a href="{{ route('departements.index') }}" class=" badge"><i class="lnr lnr-arrow-left"></i> Back</a>
        <h3 class="panel-title">Departement : <b>{{ $departement->name }}</b></h3>
    </div>
    <div class="panel-body">
        <h4>Description :</h4>
        <p>{{ $departement->description }}</p>
    </div>
</div>
<!-- END PANEL HEADLINE -->
@endsection
