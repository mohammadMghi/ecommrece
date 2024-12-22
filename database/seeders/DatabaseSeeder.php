<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::insert(
            [
                'name' => 'admin',
                'email' => 'admin@example.com',
                'email_verified_at' => Carbon::now(),
                'is_admin' => true,
                'password' => Hash::make("12345")
            ]
        );
    }
}
