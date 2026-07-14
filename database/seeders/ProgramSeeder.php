<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Program;

class ProgramSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing data to avoid duplicates
        Program::query()->delete();

        $programs = [
            // Zakat
            [
                'title' => 'Zakat Maal',
                'description' => 'Bantu sesama dengan menunaikan Zakat Maal Anda melalui Lazismu NTB.',
                'category' => 'Zakat',
                'image' => 'https://images.unsplash.com/photo-1579621970563-ebec7560ff3e?w=800&q=80',
                'target_amount' => 50000000,
                'collected' => 15000000,
                'is_active' => true,
            ],
            [
                'title' => 'Zakat Fitrah',
                'description' => 'Sempurnakan ibadah Ramadhan Anda dengan Zakat Fitrah.',
                'category' => 'Zakat',
                'image' => 'https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?w=800&q=80',
                'target_amount' => 200000000,
                'collected' => 10000000,
                'is_active' => true,
            ],
            [
                'title' => 'Zakat Profesi',
                'description' => 'Tunaikan Zakat Profesi Anda untuk membersihkan harta dan jiwa.',
                'category' => 'Zakat',
                'image' => 'https://images.unsplash.com/photo-1450101499163-c8848c66ca85?w=800&q=80',
                'target_amount' => 50000000,
                'collected' => 10000000,
                'is_active' => true,
            ],
            // Infaq
            [
                'title' => 'Infaq Pendidikan',
                'description' => 'Bantu pendidikan anak-anak NTB yang kurang mampu.',
                'category' => 'Infaq',
                'image' => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=800&q=80',
                'target_amount' => 100000000,
                'collected' => 20000000,
                'is_active' => true,
            ],
            [
                'title' => 'Infaq Masjid',
                'description' => 'Salurkan infaq terbaik Anda untuk pembangunan masjid.',
                'category' => 'Infaq',
                'image' => 'https://images.unsplash.com/photo-1560067174-c5a3a8f37060?w=800&q=80',
                'target_amount' => 150000000,
                'collected' => 50000000,
                'is_active' => true,
            ],
            // Shadaqah
            [
                'title' => 'Sedekah Jumat',
                'description' => 'Raih keberkahan di hari Jumat dengan bersedekah.',
                'category' => 'Shadaqah',
                'image' => 'https://images.unsplash.com/photo-1532629345422-7515f3d16bb6?w=800&q=80',
                'target_amount' => 10000000,
                'collected' => 2500000,
                'is_active' => true,
            ],
            // Kemanusiaan
            [
                'title' => 'Bantuan Bencana Alam',
                'description' => 'Bantu saudara kita yang tertimpa musibah.',
                'category' => 'Kemanusiaan',
                'image' => 'https://images.unsplash.com/photo-1559027615-cd4628902d4a?w=800&q=80',
                'target_amount' => 500000000,
                'collected' => 150000000,
                'is_active' => true,
            ],
            // Qurban
            [
                'title' => 'Qurban Pedesaan',
                'description' => 'Salurkan qurban Anda untuk masyarakat di pelosok NTB.',
                'category' => 'Qurban',
                'image' => 'https://images.unsplash.com/photo-1511226955099-0e8cb14ff73a?w=800&q=80',
                'target_amount' => 300000000,
                'collected' => 0,
                'is_active' => true,
            ],
        ];

        foreach ($programs as $data) {
            if (empty($data['slug'])) {
                $data['slug'] = \Illuminate\Support\Str::slug($data['title']);
            }
            Program::create($data);
        }
    }
}
