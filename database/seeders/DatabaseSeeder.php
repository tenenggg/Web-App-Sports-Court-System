<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersSeeder::class);
        $this->call(VenueSeeder::class);
        $this->call(BookingSeeder::class);
        $this->call(PaymentSeeder::class);
        $this->call(FeedbackSeeder::class);
       
    }
}
