@extends('layouts.template')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Feedback</h2>
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

    <form action="{{ route('admin.feedbacks.update', $feedback->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <!-- User ID -->
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>User:</strong>
                    <select name="user_id" class="form-control" required>
                        <option value="">Select User</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ $user->id == $feedback->user_id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Venue ID -->
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Venue:</strong>
                    <select name="venue_id" class="form-control" required>
                        <option value="">Select Venue</option>
                        @foreach ($venues as $venue)
                            <option value="{{ $venue->id }}" {{ $venue->id == $feedback->venue_id ? 'selected' : '' }}>
                                {{ $venue->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Rating -->
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Rating:</strong>
                    <select name="rating" class="form-control" required>
                        <option value="">Select Rating</option>
                        <option value="1" {{ $feedback->rating == 1 ? 'selected' : '' }}>1</option>
                        <option value="2" {{ $feedback->rating == 2 ? 'selected' : '' }}>2</option>
                        <option value="3" {{ $feedback->rating == 3 ? 'selected' : '' }}>3</option>
                        <option value="4" {{ $feedback->rating == 4 ? 'selected' : '' }}>4</option>
                        <option value="5" {{ $feedback->rating == 5 ? 'selected' : '' }}>5</option>
                    </select>
                </div>
            </div>

            <!-- Feedback (Comment) -->
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Feedback:</strong>
                    <textarea name="comment" class="form-control" placeholder="Write your feedback" rows="4" required>{{ $feedback->comment }}</textarea>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Update</button>
                <a class="btn btn-secondary" href="{{ route('admin.feedbacks.index') }}">Back</a>
            </div>
        </div>
    </form>
@endsection
