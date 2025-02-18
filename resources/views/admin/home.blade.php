@extends('layouts.template')

@section('content')
<div class="command-center">
    <!-- Header -->
    <h1 class="command-title">Your Court Hub Dashboard</h1>

    <!-- Analytics Cards -->
    <div class="analytics-cards">
        <div class="analytics-card">
            <div class="analytics-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="analytics-content">
                <h3>Active Users</h3>
                <p class="analytics-number">{{ $activeUsers ?? 0 }}</p>
                <small class="text-muted">Real-time</small>
            </div>
        </div>
    </div>

    <!-- Navigation Cards -->
    <div class="command-cards">
        <!-- List of Users -->
        <a href="{{ route('admin.users.index') }}" class="command-card">
            <div class="card-icon">
                <i class="fas fa-users"></i>
            </div>
            <h3 class="card-title">List of Users</h3>
            <br>
            <br>
            <p class="card-description">Manage and view all registered users</p>
        </a>

        <!-- List of Venues -->
        <a href="{{ route('admin.venues.index') }}" class="command-card">
            <div class="card-icon">
                <i class="fas fa-map-marker-alt"></i>
            </div>
            <h3 class="card-title">List of Venues</h3>
            <br>
            <br>
            <p class="card-description">View and manage all available venues</p>
        </a>

        <!-- List of Bookings -->
        <a href="{{ route('admin.bookings.index') }}" class="command-card">
            <div class="card-icon">
                <i class="fas fa-calendar-check"></i>
            </div>
            <h3 class="card-title">List of Bookings</h3>
            <br>
            <br>
            <p class="card-description">Track all court reservations</p>
        </a>

        <!-- List of Payments -->
        <a href="{{ route('admin.payments.index') }}" class="command-card">
            <div class="card-icon">
                <i class="fas fa-credit-card"></i>
            </div>
            <h3 class="card-title">List of Payments</h3>
            <br>
            <br>
            <p class="card-description">Monitor all payment transactions</p>
        </a>

        <!-- List of Feedbacks -->
        <a href="{{ route('admin.feedbacks.index') }}" class="command-card">
            <div class="card-icon">
                <i class="fas fa-comments"></i>
            </div>
            <h3 class="card-title">List of Feedbacks</h3>
            <br>
            <br>
            <p class="card-description">View user feedback and reviews</p>
        </a>
    </div>

    <!-- Add this after the command-cards div -->
    <div class="reports-section">
        <h2 class="section-title">Generate Reports</h2>
        
        <!-- Booking Report by Date -->
        <div class="report-card">
            <h3>Venue Bookings Report</h3>
            <form action="{{ route('admin.reports.bookings') }}" method="POST" class="report-form">
                @csrf
                <div class="form-group">
                    <label for="report_date">Select Date:</label>
                    <input type="date" id="report_date" name="report_date" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-file-pdf"></i> Generate Bookings PDF
                </button>
            </form>
        </div>

</div>

<style>
.command-center {
    padding: 20px;
    max-width: 1200px;
    margin: 0 auto;
}

.command-title {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 30px;
    color: #1a56db;
}

.command-cards {
    display: flex;
    flex-direction: row;
    gap: 20px;
    overflow-x: auto;
    padding-bottom: 20px;
}

.command-card {
    background: white;
    border: 2px solid #1a56db;
    border-radius: 8px;
    padding: 20px;
    min-width: 200px;
    text-decoration: none;
    transition: all 0.3s ease;
}

.command-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.card-icon {
    color: #1a56db;
    font-size: 24px;
    margin-bottom: 15px;
}

.card-title {
    color: #1a56db;
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
    -ms-overflow-style: none;  /* IE and Edge */
    scrollbar-width: none;     /* Firefox */
}

.command-cards::-webkit-scrollbar {
    display: none;             /* Chrome, Safari and Opera */
}

/* New styles for venue preview grid */
.venue-preview-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    grid-template-rows: repeat(2, 1fr);
    gap: 1rem;
    margin: 2rem 0;
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

.analytics-cards {
    display: flex;
    gap: 20px;
    margin-bottom: 30px;
    width: 100%;
}

.analytics-card {
    background: white;
    border-radius: 8px;
    padding: 20px;
    display: flex;
    align-items: center;
    gap: 15px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    border-left: 4px solid #1a56db;
}

.analytics-icon {
    font-size: 24px;
    color: #1a56db;
}

.analytics-content h3 {
    font-size: 14px;
    color: #6b7280;
    margin: 0;
}

.analytics-number {
    font-size: 24px;
    font-weight: bold;
    color: #1a56db;
    margin: 5px 0 0 0;
}

.revenue-chart-section {
    background: white;
    border-radius: 8px;
    padding: 20px;
    margin-top: 30px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.chart-controls {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.chart-select {
    padding: 8px 16px;
    border: 1px solid #1a56db;
    border-radius: 4px;
    color: #1a56db;
    background: white;
    cursor: pointer;
}

.chart-container {
    height: 400px;
    position: relative;
}

.total-revenue {
    background: white;
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 20px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    border-left: 4px solid #1a56db;
}

.total-revenue h3 {
    margin: 0;
    color: #1a56db;
    font-size: 1.2rem;
}

/* Add this to your existing styles */
.reports-section {
    margin-top: 30px;
}

.section-title {
    color: #1a56db;
    margin-bottom: 20px;
}

.report-card {
    background: white;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.report-card h3 {
    color: #1a56db;
    margin-bottom: 15px;
}

.report-form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.report-options {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.checkbox-group {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.checkbox-group label {
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
}

.date-range {
    display: flex;
    gap: 15px;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.form-control {
    padding: 8px;
    border: 1px solid #e2e8f0;
    border-radius: 4px;
}

.btn-primary {
    background: #1a56db;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn-primary:hover {
    background: #1e40af;
}
</style>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
let revenueChart = null;

async function fetchRevenueData(period) {
    try {
        const response = await fetch(`/admin/revenue-data?period=${period}`);
        if (!response.ok) {
            console.error('Server returned:', await response.text());
            throw new Error('Network response was not ok');
        }
        const data = await response.json();
        if (data.error) {
            console.error('Server error:', data.error);
            throw new Error(data.error);
        }
        return data;
    } catch (error) {
        console.error('Error fetching revenue data:', error);
        alert('Error loading revenue data. Check console for details.');
        return null;
    }
}

async function updateChart(period) {
    const data = await fetchRevenueData(period);
    if (!data) return;

    // Update total revenue display
    document.getElementById('totalRevenue').textContent = data.totalRevenue;

    const config = {
        type: 'line',
        data: {
            labels: data.labels,
            datasets: [{
                label: 'Revenue (RM)',
                data: data.values,
                borderColor: '#1a56db',
                backgroundColor: 'rgba(26, 86, 219, 0.1)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: `Revenue ${period.charAt(0).toUpperCase() + period.slice(1)}`
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'RM ' + value.toFixed(2);
                        }
                    }
                }
            }
        }
    };

    if (revenueChart) {
        revenueChart.destroy();
    }

    revenueChart = new Chart(
        document.getElementById('revenueChart'),
        config
    );
}

document.addEventListener('DOMContentLoaded', function() {
    updateChart('daily');

    document.getElementById('chartPeriod').addEventListener('change', function(e) {
        updateChart(e.target.value);
    });
});
</script>
@endpush
@endsection