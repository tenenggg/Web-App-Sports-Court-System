@extends('layouts.template')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>View Feedback</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('admin.feedbacks.index') }}">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <div class="form-group">
                <strong>User:</strong>
                {{ $feedback->user ? $feedback->user->name : 'N/A' }}
            </div>

            <div class="form-group">
                <strong>Venue:</strong>
                {{ $feedback->venue ? $feedback->venue->name : 'N/A' }}
            </div>

            <div class="form-group">
                <strong>Rating:</strong>
                <div>
                    @for($i = 1; $i <= 5; $i++)
                        <i class="fas fa-star {{ $i <= $feedback->rating ? 'text-warning' : 'text-secondary' }}"></i>
                    @endfor
                </div>
            </div>

            <div class="form-group">
                <strong>Comment:</strong>
                <p>{{ $feedback->comment }}</p>
            </div>

            <div class="form-group">
                <strong>Submitted on:</strong>
                {{ $feedback->created_at->format('Y-m-d H:i:s') }}
            </div>
        </div>
    </div>
@endsection
