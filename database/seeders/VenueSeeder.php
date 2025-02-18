<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Venue;

class VenueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $venue_seed = [
            ['id'=>'1','name'=>'Basketball Court','location' => 'Presint 8','description' => 'KUROKO NO BASKET','image' => 'venues/basketball.jpg','price_per_hour' => 8.00],
            ['id'=>'2','name'=>'Badminton Court ','location' => 'Presint 8','description' => 'SMASHHH THAT RACKET','image' => 'venues/badminton.jpg','price_per_hour' => 10.00],
            ['id'=>'3','name'=>'Futsal Court ','location' => 'Presint 8','description' => 'BECOME AN EGOISTT','image' => 'venues/futsal.jpg','price_per_hour' => 12.00],
            ['id'=>'4','name'=>'Petanque Court ','location' => 'Presint 8','description' => 'BOOOORRINNGGGG','image' => 'venues/petanque.jpg','price_per_hour' => 9.00],
            ['id'=>'5','name'=>'VolleyballCourt ','location' => 'Presint 8','description' => 'FIRSTT BALLLL','image' => 'venues/volleyball.jpg','price_per_hour' => 11.00],
            ['id'=>'6','name'=>'Takraw Court ','location' => 'Presint 8','description' => 'BUAT LIPAT ARH','image' => 'venues/takraw.jpg','price_per_hour' => 7.00],
            ['id'=>'7','name'=>'Basketball Court','location' => 'Presint 9','description' => 'KUROKO NO BASKET','image' => 'venues/basketball.jpg','price_per_hour' => 8.00],
            ['id'=>'8','name'=>'Badminton Court ','location' => 'Presint 9','description' => 'SMASHHH THAT RACKET','image' => 'venues/badminton.jpg','price_per_hour' => 10.00],
            ['id'=>'9','name'=>'Futsal Court ','location' => 'Presint 9','description' => 'BECOME AN EGOISTT','image' => 'venues/futsal.jpg','price_per_hour' => 12.00],
            ['id'=>'10','name'=>'Petanque Court ','location' => 'Presint 9','description' => 'BOOOORRINNGGGG','image' => 'venues/petanque.jpg','price_per_hour' => 9.00],
            ['id'=>'11','name'=>'VolleyballCourt ','location' => 'Presint 9','description' => 'FIRSTT BALLLL','image' => 'venues/volleyball.jpg','price_per_hour' => 11.00],
            ['id'=>'12','name'=>'Takraw Court ','location' => 'Presint 9','description' => 'BUAT LIPAT ARH','image' => 'venues/takraw.jpg','price_per_hour' => 7.00],
            
            ];
        foreach ($venue_seed as $venue_seed)
        {
            Venue::firstOrCreate($venue_seed);
        }
    }
}
