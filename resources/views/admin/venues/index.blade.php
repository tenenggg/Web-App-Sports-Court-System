@extends('layouts.template')

@section('content')
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <h2 class="mb-0">List of Venues</h2>
        <a href="{{ route('admin.venues.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle mr-1"></i> Add New Court
        </a>
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
                        <a href="{{ route('admin.venues.edit', $venue->id) }}" 
                           class="btn btn-sm btn-primary mr-2">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('admin.venues.destroy', $venue->id) }}" 
                              method="POST" 
                              onsubmit="return confirm('Are you sure you want to delete this venue?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
