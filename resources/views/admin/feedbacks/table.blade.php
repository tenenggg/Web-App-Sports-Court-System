@extends('layouts.template')

@section('content')
<div class="row mb-3">
    <div class="col-lg-12 d-flex justify-content-between align-items-center">
        <h2>Feedback Management</h2>
        <a class="btn btn-success" href="{{ route('admin.feedbacks.create') }}">Add New Feedback</a>
    </div>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

@if(count($feedbacks) > 0)
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>User</th>
                            <th>Rating</th>
                            <th width="280px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($feedbacks as $index => $feedback)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $feedback->user ? $feedback->user->name : 'N/A' }}</td>
                            <td>
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $feedback->rating ? 'text-warning' : 'text-secondary' }}"></i>
                                @endfor
                            </td>
                            <td>
                                <form action="{{ route('admin.feedbacks.destroy', $feedback->id) }}" method="POST">
                                    <a class="btn btn-info btn-sm" href="{{ route('admin.feedbacks.show', $feedback->id) }}">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this feedback?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@else
    <p class="text-center mt-4">No feedback found</p>
@endif
@endsection
