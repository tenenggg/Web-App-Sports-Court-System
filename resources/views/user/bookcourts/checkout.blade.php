@extends('layouts.usertemplate')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card">
                <div class="card-header">
                    <h3>Book {{ $venue->name }}</h3>
                </div>
                <div class="card-body">
                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('user.bookcourts.checkout', $venue->id) }}" id="bookingForm">
                        @csrf
                        <div class="form-group">
                            <label>Venue:</label>
                            <input type="text" class="form-control" value="{{ $venue->name }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Price per Hour:</label>
                            <input type="text" class="form-control" value="RM {{ number_format($venue->price_per_hour, 2) }}" readonly>
                            <input type="hidden" id="price-per-hour" value="{{ $venue->price_per_hour }}">
                        </div>

                        <div class="form-group">
                            <label for="booking_date">Booking Date:</label>
                            <input type="date" name="booking_date" id="booking_date" class="form-control" required>
                        </div>

                        <div id="timeSlots" class="mt-4" style="display: none;">
                            <h4>Available Time Slots</h4>
                            <div class="row" id="timeSlotsContainer">
                                <!-- Time slots will be inserted here -->
                            </div>
                        </div>

                        <input type="hidden" name="start_time" id="start_time">
                        <input type="hidden" name="end_time" id="end_time">
                        <input type="hidden" name="total_price" id="total-price">

                        <div class="selected-time-info mt-3" style="display: none;">
                            <div class="alert alert-info">
                                <strong>Selected Time:</strong> <span id="selectedTimeRange"></span><br>
                                <strong>Total Price:</strong> RM <span id="selectedPrice"></span>
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary" id="submitBtn" style="display: none;">
                                <i class="fas fa-check"></i> Confirm Booking
                            </button>
                            <a href="{{ route('user.bookcourts.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const today = new Date().toISOString().split('T')[0];
    const bookingDateInput = document.getElementById('booking_date');
    const timeSlotsDiv = document.getElementById('timeSlots');
    const timeSlotsContainer = document.getElementById('timeSlotsContainer');
    const pricePerHour = parseFloat(document.getElementById('price-per-hour').value);
    const venueId = {{ $venue->id }};
    const startHour = 8; // 8 AM
    const endHour = 24; // 12 AM
    let selectedSlots = []; // Array to store selected hours

    bookingDateInput.min = today;

    bookingDateInput.addEventListener('change', async function(e) {
        e.preventDefault();
        const selectedDate = this.value;
        if (!selectedDate) return;

        try {
            const response = await fetch(`${window.location.origin}/api/bookings/check-availability/${venueId}/${selectedDate}`);
            const bookedSlots = await response.json();
            
            generateTimeSlots(bookedSlots);
            timeSlotsDiv.style.display = 'block';
        } catch (error) {
            console.error('Error fetching availability:', error);
        }
    });

    function generateTimeSlots(bookedSlots) {
        timeSlotsContainer.innerHTML = '';
        
        for (let hour = startHour; hour < endHour; hour++) {
            const timeSlot = document.createElement('div');
            timeSlot.className = 'col-md-3 mb-3';
            
            const time = `${hour.toString().padStart(2, '0')}:00`;
            const isBooked = isTimeSlotBooked(time, bookedSlots);
            
            timeSlot.innerHTML = `
                <div class="card ${isBooked ? 'bg-secondary' : 'bg-light'}" 
                     style="cursor: ${isBooked ? 'not-allowed' : 'pointer'}"
                     data-hour="${hour}">
                    <div class="card-body text-center">
                        <h5 class="card-title">${formatTime(hour)}</h5>
                        <p class="card-text">${isBooked ? 'Booked' : 'Available'}</p>
                    </div>
                </div>
            `;

            if (!isBooked) {
                timeSlot.querySelector('.card').addEventListener('click', () => toggleTimeSlot(hour));
            }

            timeSlotsContainer.appendChild(timeSlot);
        }
    }

    function formatTime(hour) {
        const period = hour >= 12 ? 'PM' : 'AM';
        const displayHour = hour > 12 ? hour - 12 : hour;
        return `${displayHour}:00 ${period}`;
    }

    function isTimeSlotBooked(time, bookedSlots) {
        // Get the current hour as a number (e.g., "08:00" -> 8)
        const currentHour = parseInt(time.split(':')[0]);
        
        return bookedSlots.some(slot => {
            // Get start and end hours as numbers
            const startHour = parseInt(slot.start_time.split(':')[0]);
            const endHour = parseInt(slot.end_time.split(':')[0]);
            
            // Check if the current hour falls within a booking
            // A booking from 10:00 to 12:00 should only block 10 and 11
            return currentHour >= startHour && currentHour < endHour;
        });
    }

    function toggleTimeSlot(hour) {
        const index = selectedSlots.indexOf(hour);
        const card = timeSlotsContainer.querySelector(`[data-hour="${hour}"]`);
        
        if (index === -1) {
            // Check if this slot can be added (must be continuous)
            if (canAddSlot(hour)) {
                selectedSlots.push(hour);
                selectedSlots.sort((a, b) => a - b); // Keep array sorted
                card.classList.remove('bg-light');
                card.classList.add('bg-success');
            } else {
                alert('Please select continuous time slots');
                return;
            }
        } else {
            // Check if this slot can be removed (must not break continuity)
            if (canRemoveSlot(hour)) {
                selectedSlots.splice(index, 1);
                card.classList.remove('bg-success');
                card.classList.add('bg-light');
            } else {
                alert('Cannot remove slots from the middle of selection');
                return;
            }
        }
        
        updateBookingDetails();
    }

    function canAddSlot(hour) {
        if (selectedSlots.length === 0) return true;
        
        const min = Math.min(...selectedSlots);
        const max = Math.max(...selectedSlots);
        
        // Can only add slots adjacent to existing selection
        return hour === min - 1 || hour === max + 1;
    }

    function canRemoveSlot(hour) {
        if (selectedSlots.length <= 1) return true;
        
        const min = Math.min(...selectedSlots);
        const max = Math.max(...selectedSlots);
        
        // Can only remove slots from the ends
        return hour === min || hour === max;
    }

    function updateBookingDetails() {
        if (selectedSlots.length === 0) {
            document.querySelector('.selected-time-info').style.display = 'none';
            document.getElementById('submitBtn').style.display = 'none';
            return;
        }

        const startTime = `${Math.min(...selectedSlots).toString().padStart(2, '0')}:00`;
        const endTime = `${(Math.max(...selectedSlots) + 1).toString().padStart(2, '0')}:00`;
        const hours = selectedSlots.length;
        const totalPrice = hours * pricePerHour;

        document.getElementById('start_time').value = startTime;
        document.getElementById('end_time').value = endTime;
        document.getElementById('total-price').value = totalPrice.toFixed(2);
        
        document.getElementById('selectedTimeRange').textContent = 
            `${formatTime(Math.min(...selectedSlots))} - ${formatTime(Math.max(...selectedSlots) + 1)}`;
        document.getElementById('selectedPrice').textContent = totalPrice.toFixed(2);
        
        document.querySelector('.selected-time-info').style.display = 'block';
        document.getElementById('submitBtn').style.display = 'inline-block';
    }
});
</script>
@endpush
