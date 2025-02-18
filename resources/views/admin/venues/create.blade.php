@extends('layouts.template')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New Venue</h2>
        </div>
       
    </div>
</div>
   
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
   
<form action="{{ route('admin.venues.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
  
     <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" class="form-control" placeholder="Name">
            </div>
        </div>
        
        <div class="col-xs-6 col-sm-6 col-md-12">
            <div class="form-group">
                <strong>Location:</strong>
                <input type="text" name="location" class="form-control" placeholder="Location">
            </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                <input type="text" name="description" class="form-control" placeholder="Description">
            </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-12">
            <div class="form-group">
                <strong>Price Per Hour:</strong>
                <input type="text" name="price_per_hour" class="form-control" placeholder="Price Per Hour">
            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Venue Image:</strong>
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
        
                <a class="btn btn-primary" href="{{ route('admin.venues.index') }}"> Back</a>
        </div>
    </div>
   
</form>
@endsection
