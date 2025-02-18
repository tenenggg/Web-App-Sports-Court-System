@section('content')

<style>
    .venues-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 2rem;
        padding: 1rem;
    }

    .venue-card {
        display: flex;
        flex-direction: column;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        overflow: hidden;
        background: white;
        transition: transform 0.2s ease;
    }

    .venue-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .venue-image-container {
        position: relative;
        width: 100%;
        padding-top: 66.67%; /* 3:2 Aspect Ratio */
        overflow: hidden;
    }

    .venue-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100% !important;
        height: 100% !important;
        object-fit: cover;
        object-position: center;
    }

    .venue-content {
        padding: 1.5rem;
        flex-grow: 1;
    }
</style>

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Book Your Court</h2>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<div class="venues-grid">
    @foreach($venues as $venue)
        <div class="venue-card">
            <div class="venue-image-container">
                <img src="{{ asset('storage/' . $venue->image) }}" 
                     alt="{{ $venue->name }}"
                     class="venue-image">
            </div>
            <div class="venue-content">
                <h4 class="font-weight-bold mb-2">{{ $venue->name }} @ {{ $venue->location }}</h4>
                <p class="text-muted mb-2">
                    <i class="fas fa-info-circle mr-2"></i>
                    {{ $venue->description }}
                </p>
                <p class="text-primary mb-3">
                    <i class="fas fa-dollar-sign mr-2"></i>
                    RM {{ number_format($venue->price_per_hour, 2) }} per hour
                </p>
                <div class="d-flex justify-content-end mt-2">
                    <a href="{{ route('user.bookcourts.checkout', $venue->id) }}" 
                       class="btn btn-primary">
                        <i class="fas fa-calendar-plus mr-1"></i> Book Now
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection
