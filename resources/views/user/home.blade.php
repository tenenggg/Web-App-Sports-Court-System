@extends('layouts.usertemplate')

@section('content')
<div class="command-center">
    <!-- Header -->
    <h1 class="command-title">Your Court Hub Dashboard</h1>

    <!-- Venue Images Grid -->
    <div class="venue-preview-grid">
        @php
            $venueImages = [
                'venues/badminton.jpg',
                'venues/basketball.jpg',
                'venues/futsal.jpg',
                'venues/petanque.jpg',
                'venues/takraw.jpg',
                'venues/volleyball.jpg'
            ];
        @endphp

        @foreach($venueImages as $image)
            <div class="venue-preview-card">
                <img src="{{ asset('storage/' . $image) }}" 
                     alt="Venue Preview" 
                     class="venue-preview-image"
                     onerror="this.src='{{ asset('storage/venues/default.jpg') }}'">
            </div>
        @endforeach
    </div>

    <!-- Navigation Cards -->
    <div class="command-cards">
        <!-- Book a Court -->
        <a href="{{ route('user.bookcourts.index') }}" class="command-card">
            <div class="card-icon">
                <i class="fas fa-calendar-plus"></i>
            </div>
            <h3 class="card-title">Book a Court</h3>
            <br>
            <br>
            <p class="card-description">Reserve your spot now</p>
        </a>

        <!-- Booking History -->
        <a href="{{ route('user.bookinghistory.index') }}" class="command-card">
            <div class="card-icon">
                <i class="fas fa-history"></i>
            </div>
            <h3 class="card-title">Booking History</h3>
            <br>
            <br>
            <p class="card-description">View your bookings</p>
        </a>

        <!-- Profile Settings -->
        <a href="{{ route('user.profile.edit') }}" class="command-card">
            <div class="card-icon">
                <i class="fas fa-user-edit"></i>
            </div>
            <h3 class="card-title">Profile Settings</h3>
            <br>
            <br>
            <p class="card-description">Update your information</p>
        </a>

        <!-- Send Feedback -->
        <a href="{{ route('user.feedbacks.index') }}" class="command-card">
            <div class="card-icon">
                <i class="fas fa-comment"></i>
            </div>
            <h3 class="card-title">Send Feedback</h3>
            <br>
            <br>
            <p class="card-description">Share your experience</p>
        </a>
    </div>
</div>

<style>
.command-center {
    padding: 20px;
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.command-title {
    font-size: 30px;
    font-weight: bold;
    margin-bottom: 30px;
    color: #000000;
    text-align: center;
}

/* Venue preview grid styles */
.venue-preview-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    grid-template-rows: repeat(2, 1fr);
    gap: 1rem;
    margin: 2rem 0;
    width: 100%;
    max-width: 1000px;
}

.venue-preview-card {
    position: relative;
    width: 100%;
    padding-top: 66.67%; /* 3:2 Aspect Ratio */
    overflow: hidden;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.venue-preview-image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.venue-preview-card:hover .venue-preview-image {
    transform: scale(1.05);
}

/* Command cards styles */
.command-cards {
    display: flex;
    justify-content: center;
    gap: 20px;
    padding-bottom: 20px;
    width: 100%;
    max-width: 1000px;
}

.command-card {
    background: white;
    border: 2px solid #0066FF;
    border-radius: 8px;
    padding: 20px;
    width: 220px;
    text-decoration: none;
    transition: all 0.3s ease;
    text-align: center;
}

.command-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.card-icon {
    color: #0066FF;
    font-size: 24px;
    margin-bottom: 15px;
}

.card-title {
    color: #0066FF;
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 10px;
}

.card-description {
    color: #4b5563;
    font-size: 14px;
    line-height: 1.4;
}

/* Hide scrollbar but keep functionality */
.command-cards {
    -ms-overflow-style: none;
    scrollbar-width: none;
}

.command-cards::-webkit-scrollbar {
    display: none;
}
</style>
@endsection 