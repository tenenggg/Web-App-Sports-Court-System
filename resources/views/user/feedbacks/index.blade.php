@extends('layouts.usertemplate')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>My Feedbacks</h2>
        </div>
        <div class="pull-right mb-2">
            <a class="btn btn-success" href="{{ route('user.feedbacks.create') }}">
                <i class="fas fa-plus"></i> Submit New Feedback
            </a>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Venue</th>
                        <th>Rating</th>
                        <th>Date Submitted</th>
                        <th width="280px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($feedbacks as $feedback)
                    <tr>
                        <td>{{ $feedback->venue ? $feedback->venue->name : 'N/A' }}</td>
                        <td>
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i <= $feedback->rating ? 'text-warning' : 'text-secondary' }}"></i>
                            @endfor
                        </td>
                        <td>{{ $feedback->created_at->format('Y-m-d') }}</td>
                        <td>
                            <a class="btn btn-info btn-sm" href="{{ route('user.feedbacks.show', $feedback->id) }}">
                                <i class="fas fa-eye"></i> View
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection 