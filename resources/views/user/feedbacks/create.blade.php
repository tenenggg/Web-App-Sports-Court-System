@extends('layouts.usertemplate')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Submit Feedback</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('user.feedbacks.index') }}">
                <i class="fas fa-arrow-left"></i> Back
            </a>
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

<div class="card mt-3">
    <div class="card-body">
        <form action="{{ route('user.feedbacks.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="venue_id">Venue:</label>
                <select name="venue_id" class="form-control" required>
                    <option value="">Select Venue</option>
                    @foreach($venues as $venue)
                        <option value="{{ $venue->id }}">{{ $venue->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="rating">Rating:</label>
                <div class="rating">
                    @for($i = 5; $i >= 1; $i--)
                        <input type="radio" name="rating" value="{{ $i }}" id="star{{ $i }}" required>
                        <label for="star{{ $i }}"><i class="fas fa-star"></i></label>
                    @endfor
                </div>
            </div>

            <div class="form-group">
                <label for="comment">Comment:</label>
                <textarea class="form-control" name="comment" rows="4" placeholder="Enter your feedback" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-paper-plane"></i> Submit Feedback
            </button>
        </form>
    </div>
</div>

<style>
.rating {
    display: inline-block;
    direction: rtl;
}

.rating input {
    display: none;
}

.rating label {
    cursor: pointer;
    font-size: 25px;
    color: #ccc;
    padding: 5px;
}

.rating input:checked ~ label,
.rating label:hover,
.rating label:hover ~ label {
    color: #ffc107;
}
</style>
@endsection 