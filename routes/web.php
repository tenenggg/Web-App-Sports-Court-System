<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use Telegram\Bot\Laravel\Facades\Telegram;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\GoogleCalendarController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Admin\ReportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/home', function () {
        return view('admin.home');
    })->name('home');

    Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::get('/users/create',[App\Http\Controllers\UserController::class, 'create'])->name('users.create');
    Route::post('/users', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}', [App\Http\Controllers\UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/venues', [App\Http\Controllers\VenueController::class, 'index'])->name('venues.index');
    Route::get('/venues/create',[App\Http\Controllers\VenueController::class, 'create'])->name('venues.create');
    Route::post('/venues', [App\Http\Controllers\VenueController::class, 'store'])->name('venues.store');
    Route::get('/venues/{venue}', [App\Http\Controllers\VenueController::class, 'show'])->name('venues.show');
    Route::get('/venues/{venue}/edit', [App\Http\Controllers\VenueController::class, 'edit'])->name('venues.edit');
    Route::put('/venues/{venue}', [App\Http\Controllers\VenueController::class, 'update'])->name('venues.update');
    Route::delete('/venues/{venue}', [App\Http\Controllers\VenueController::class, 'destroy'])->name('venues.destroy');

    Route::get('/bookings', [App\Http\Controllers\BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/create',[App\Http\Controllers\BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [App\Http\Controllers\BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/{booking}', [App\Http\Controllers\BookingController::class, 'show'])->name('bookings.show');
    Route::get('/bookings/{booking}/edit', [App\Http\Controllers\BookingController::class, 'edit'])->name('bookings.edit');
    Route::put('/bookings/{booking}', [App\Http\Controllers\BookingController::class, 'update'])->name('bookings.update');
    Route::delete('/bookings/{booking}', [App\Http\Controllers\BookingController::class, 'destroy'])->name('bookings.destroy');
    Route::patch('/bookings/{booking}/status', [App\Http\Controllers\BookingController::class, 'updateStatus'])->name('bookings.updateStatus');

    Route::get('/payments', [App\Http\Controllers\PaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments/create',[App\Http\Controllers\PaymentController::class, 'create'])->name('payments.create');
    Route::post('/payments', [App\Http\Controllers\PaymentController::class, 'store'])->name('payments.store');
    Route::get('/payments/{payment}', [App\Http\Controllers\PaymentController::class, 'show'])->name('payments.show');
    Route::get('/payments/{payment}/edit', [App\Http\Controllers\PaymentController::class, 'edit'])->name('payments.edit');
    Route::put('/payments/{payment}', [App\Http\Controllers\PaymentController::class, 'update'])->name('payments.update');
    Route::delete('/payments/{payment}', [App\Http\Controllers\PaymentController::class, 'destroy'])->name('payments.destroy');

    Route::get('/payments/{id}/send-email', [PaymentController::class, 'sendEmail'])->name('payments.sendEmail');

    Route::get('/feedbacks', [App\Http\Controllers\FeedbackController::class, 'index'])->name('feedbacks.index');
    Route::get('/feedbacks/create',[App\Http\Controllers\FeedbackController::class, 'create'])->name('feedbacks.create');
    Route::post('/feedbacks', [App\Http\Controllers\FeedbackController::class, 'store'])->name('feedbacks.store');
    Route::get('/feedbacks/{feedback}', [App\Http\Controllers\FeedbackController::class, 'show'])->name('feedbacks.show');
    Route::get('/feedbacks/{feedback}/edit', [App\Http\Controllers\FeedbackController::class, 'edit'])->name('feedbacks.edit');
    Route::put('/feedbacks/{feedback}', [App\Http\Controllers\FeedbackController::class, 'update'])->name('feedbacks.update');
    Route::delete('/feedbacks/{feedback}', [App\Http\Controllers\FeedbackController::class, 'destroy'])->name('feedbacks.destroy');

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/admin/reports', [App\Http\Controllers\Admin\ReportController::class, 'index'])->name('admin.reports.index');
    });

    Route::get('/revenue-data', [App\Http\Controllers\Admin\AdminController::class, 'getRevenueData'])
        ->name('revenue-data');

    Route::get('/debug-payments', [App\Http\Controllers\Admin\AdminController::class, 'debugPayments'])
        ->name('debug-payments');

    Route::get('/admin/debug-revenue', function() {
        $results = DB::select("
            SELECT 
                DATE(created_at) as date,
                amount/100 as amount_rm
            FROM payments 
            ORDER BY created_at DESC
        ");
        
        dd([
            'total_payments' => count($results),
            'total_revenue' => array_sum(array_column($results, 'amount_rm')),
            'payments' => $results
        ]);
    })->middleware(['auth', 'admin']);

    Route::post('/reports/bookings', [ReportController::class, 'bookings'])->name('reports.bookings');
    Route::post('/reports/full', [ReportController::class, 'full'])->name('reports.full');
});

Route::prefix('user')->name('user.')->middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        return view('user.home');
    })->name('home');

    Route::get('/bookcourts', [App\Http\Controllers\BookcourtController::class, 'index'])->name('bookcourts.index');
    Route::match(['get', 'post'],'/bookcourts/checkout/{id}', [App\Http\Controllers\BookcourtController::class, 'checkout'])->name('bookcourts.checkout');
    
    Route::get('/bookinghistory', [App\Http\Controllers\BookingHistoryController::class, 'index'])->name('bookinghistory.index');
    Route::get('/bookinghistory/{booking}', [App\Http\Controllers\BookingHistoryController::class, 'show'])->name('bookinghistory.show');

    Route::get('/profile', [App\Http\Controllers\UserProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [App\Http\Controllers\UserProfileController::class, 'update'])->name('profile.update');

    Route::get('/feedbacks', [App\Http\Controllers\UserFeedbackController::class, 'index'])->name('feedbacks.index');
    Route::get('/feedbacks/create', [App\Http\Controllers\UserFeedbackController::class, 'create'])->name('feedbacks.create');
    Route::post('/feedbacks', [App\Http\Controllers\UserFeedbackController::class, 'store'])->name('feedbacks.store');
    Route::get('/feedbacks/{feedback}', [App\Http\Controllers\UserFeedbackController::class, 'show'])->name('feedbacks.show');

    // Stripe payment routes
    Route::get('/payment/checkout/{id}', [StripePaymentController::class, 'checkout'])
        ->name('payment.checkout');
    Route::post('/payment/stripe/{id}', [StripePaymentController::class, 'stripePayment'])
        ->name('payment.stripe');
    Route::get('/payment/success', [StripePaymentController::class, 'success'])
        ->name('payment.success');
    Route::get('/payment/cancel', [StripePaymentController::class, 'cancel'])
        ->name('payment.cancel');

    Route::get('/calendar/add/{booking}', [GoogleCalendarController::class, 'addToCalendar'])
        ->name('calendar.add');
    Route::get('/calendar/callback', [GoogleCalendarController::class, 'callback'])
        ->name('calendar.callback');
});

Route::post('/payment/process/{booking}', [PaymentController::class, 'process'])->name('payment.process');
