@extends('layouts.template')

@section('content')
    @include('admin.users.table')  <!-- This will include resources/views/venues/table.blade.php -->
@endsection
