<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Campaign;
use App\Models\News;
use Illuminate\Support\Str;

class SampleDataSeeder extends Seeder
{
    public function run(): void
    {
        // Sample Campaigns
        $campaigns = [
            [
                'title' => 'Zakat Maal',
                'description' => 'Bantu sesama dengan menunaikan Zakat Maal Anda melalui Lazismu NTB.',
                'target_amount' => 50000000,
                'status' => 'active',
                'category' => 'Zakat',
                'image' => 'https://images.unsplash.com/photo-1579621970563-ebec7560ff3e?w=800&q=80',
            ],
            [
                'title' => 'Zakat Fitrah',
                'description' => 'Sempurnakan ibadah Ramadhan Anda dengan Zakat Fitrah.',
                'target_amount' => 200000000,
                'status' => 'active',
                'category' => 'Zakat',
                'image' => 'https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?w=800&q=80',
            ],
            [
                'title' => 'Infaq Kemanusiaan Palestina',
                'description' => 'Mari bantu saudara-saudara kita di Palestina yang sedang membutuhkan bantuan.',
                'target_amount' => 1000000000,
                'status' => 'active',
                'category' => 'Kemanusiaan',
                'image' => 'https://images.unsplash.com/photo-1559027615-cd4628902d4a?w=800&q=80',
            ],
        ];

        foreach ($campaigns as $data) {
            Campaign::create($data);
        }

        // Sample News
        $news = [
            [
                'title' => 'Lazismu NTB Salurkan Beasiswa ke Daerah 3T',
                'excerpt' => 'Sebanyak 50 siswa berprestasi dari daerah Terdepan, Terluar, dan Tertinggal (3T) di NTB menerima beasiswa.',
                'content' => 'Lazismu NTB kembali menunjukkan kepeduliannya terhadap dunia pendidikan...',
                'image' => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=800&q=80',
                'category' => 'Pendidikan',
                'is_published' => true,
                'published_at' => now(),
            ],
            [
                'title' => 'BPKH RI dan Lazismu Salurkan Bingkisan Ramadhan',
                'excerpt' => 'BPKH RI bersama Lazismu NTB menyalurkan bingkisan sembako dan Mushaf Al-Qur\'an.',
                'content' => 'Dalam rangka menyambut bulan suci Ramadhan 1447 H...',
                'image' => 'https://images.unsplash.com/photo-1544027993-37dbfe43562a?w=800&q=80',
                'category' => 'Sosial',
                'is_published' => true,
                'published_at' => now(),
            ],
        ];

        foreach ($news as $data) {
            News::create($data);
        }
    }
}
