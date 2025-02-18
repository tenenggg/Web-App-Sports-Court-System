@extends('layouts.usertemplate')

@section('content')
    @include('user.bookcourts.table')  <!-- This will include resources/views/venues/table.blade.php -->
@endsection
