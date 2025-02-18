<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users_seed = [
            [
                'id' => 1,
                'name' => 'Muiz Admin',
                'email' => 'muizAdmin@gmail.com',
                'isAdmin' => 1,
                'email_verified_at' => now(),
                'password' => Hash::make('admin123'),
            ],
            [
                'id' => 2,
                'name' => 'Imam Admin',
                'email' => 'imamAdmin@gmail.com',
                'isAdmin' => 1,
                'email_verified_at' => now(),
                'password' => Hash::make('admin123'),
            ],
            [
                'id' => 3,
                'name' => 'Adlina Admin',
                'email' => 'adlinaAdmin@gmail.com',
                'isAdmin' => 1,
                'email_verified_at' => now(),
                'password' => Hash::make('admin123'),
            ],
            [
                'id' => 4,
                'name' => 'Azri Admin',
                'email' => 'azriAdmin0304@gmail.com',
                'isAdmin' => 1,
                'email_verified_at' => now(),
                'password' => Hash::make('admin123'),
            ],
            [
                'id' => 5,
                'name' => 'User Muiz',
                'email' => 'muizfakhrul2003@gmail.com',
                'isAdmin' => 0,
                'email_verified_at' => now(),
                'password' => Hash::make('user1234'),
            ],
            [
                'id' => 6,
                'name' => 'User Imam',
                'email' => 'muhamadimamuddinbinyunos@gmail.com',
                'isAdmin' => 0,
                'email_verified_at' => now(),
                'password' => Hash::make('user1234'),
            ],
            [
                'id' => 7, // Fixed id
                'name' => 'User Adlina',
                'email' => 'adlinazamzuri@gmail.com',
                'isAdmin' => 0,
                'email_verified_at' => now(),
                'password' => Hash::make('user1234'),
            ],
            [
                'id' => 8, // Fixed id
                'name' => 'User Azri',
                'email' => 'azriaziz0304@gmail.com', // Fixed email to lowercase
                'isAdmin' => 0,
                'email_verified_at' => now(),
                'password' => Hash::make('user1234'),
            ],
        ];

        foreach ($users_seed as $user) {
            User::firstOrCreate(['email' => $user['email']], $user);
        }
    }
}
