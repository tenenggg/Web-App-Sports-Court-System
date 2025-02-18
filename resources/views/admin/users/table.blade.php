@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>List of Users</h2>
        </div>
        <div class="pull-right mb-3">
            <a class="btn btn-success" href="{{ route('admin.users.create') }}"> Add New User</a>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

@if(count($users) > 0)
    <div class="row">
        @foreach ($users as $s)
            <div class="col-md-4 mb-4">
                <div class="card border-primary" style="height: 250px; width: 100%;">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title text-truncate">{{ $s->name }}</h5>
                    </div>
                    <div class="card-body d-flex flex-column justify-content-between">
                        <p class="card-text"><strong>Email:</strong> {{ $s->email }}</p>
                        <div class="d-flex justify-content-between">
                            <a class="btn btn-info btn-sm" href="{{ route('admin.users.show', $s->id) }}">Show</a>
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.users.edit', $s->id) }}">Edit</a>
                            <form action="{{ route('admin.users.destroy', $s->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <p>No users found</p>
@endif

@endsection
