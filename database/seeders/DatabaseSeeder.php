<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        User::updateOrCreate(
            ['email' => 'admin@lazismu.org'],
            [
                'name' => 'Admin Lazismu NTB',
                'password' => \Illuminate\Support\Facades\Hash::make('password123'),
                'role' => 'admin',
                'phone' => '081234567890',
                'uuid' => (string) \Illuminate\Support\Str::uuid(),
            ]
        );

        $this->call([
            ProgramSeeder::class,
            DisbursementSeeder::class,
            NewsSeeder::class,
            ReportSeeder::class,
        ]);
    }
}
