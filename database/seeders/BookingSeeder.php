<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Booking;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       
        $booking_seed = [
            ];
           foreach ($booking_seed as $booking_seed)
        {
            Booking::firstOrCreate($booking_seed);
        }
    }
}
