@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>List of Venues</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('admin.venues.create') }}"> Add New Venue</a>
            <br>
            <br>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

@if(count($venues) > 0)
    <div class="row">
        @foreach ($venues as $venue)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                @if($venue->image)
                    <img src="{{ asset('storage/'.$venue->image) }}" class="card-img-top" alt="Venue Image">
                @else
                    <img src="admin/dist/img/badmintoncourt.jpg" class="card-img-top" alt="Default Venue Image">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $venue->name }}</h5>
                    <p class="card-text"><strong>Location:</strong> {{ $venue->location }}</p>
                    <p class="card-text"><strong>Description:</strong> {{ $venue->description }}</p>
                    <p class="card-text"><strong>Price per Hour:</strong> {{ $venue->price_per_hour }}</p>
                </div>
                <div class="card-footer text-center">
                    <a class="btn btn-info" href="{{ route('admin.venues.show', $venue->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('admin.venues.edit', $venue->id) }}">Edit</a>
                    <form action="{{ route('admin.venues.destroy', $venue->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@else
    <p>No venues found</p>
@endif

@endsection
