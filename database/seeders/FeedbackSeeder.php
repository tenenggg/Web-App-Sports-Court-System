<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Feedback;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $feedback_seed = [
            ['id'=>'1','user_id'=>'5','venue_id' => '1','rating' => '5','comment' => 'Great court and facilities!'],
            ['id'=>'2','user_id'=>'6','venue_id' => '1','rating' => '5','comment' => 'Good environment but could use better lighting.'],
           ];

           foreach ($feedback_seed as $feedback_seed)
        {
            Feedback::firstOrCreate($feedback_seed);
        }
    }
}
