@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-4">
        <h2 class="text-center mb-4">Available Courts</h2>
    </div>

    <div class="venues-grid">
        @foreach($venues as $venue)
            <div class="venue-card">
                <div class="venue-image-container">
                    <img src="{{ asset('storage/' . $venue->image) }}" 
                         alt="{{ $venue->name }}"
                         class="venue-image">
                </div>
                <div class="venue-content">
                    <h4 class="font-weight-bold mb-2">{{ $venue->name }}</h4>
                    <p class="text-muted mb-2">
                        <i class="fas fa-map-marker-alt mr-2"></i>
                        {{ $venue->location }}
                    </p>
                    <p class="text-muted mb-2">
                        <i class="fas fa-info-circle mr-2"></i>
                        {{ $venue->description }}
                    </p>
                    <p class="text-primary mb-3">
                        <i class="fas fa-dollar-sign mr-2"></i>
                        RM {{ number_format($venue->price_per_hour, 2) }} per hour
                    </p>
                    <div class="d-flex justify-content-end mt-2">
                        <a href="{{ route('user.bookings.create', ['venue_id' => $venue->id]) }}" 
                           class="btn btn-primary">
                            <i class="fas fa-calendar-plus mr-1"></i> Book Now
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection 