<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Payment;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $payment_seed = [
            ];

           foreach ($payment_seed as $payment_seed)
        {
            Payment::firstOrCreate($payment_seed);
        }
    }
}
