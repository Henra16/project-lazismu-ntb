<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Report;

class ReportSeeder extends Seeder
{
    public function run(): void
    {
        Report::truncate();

        $reports = [
            [
                'title' => 'Laporan Keuangan Tahunan 2025',
                'year' => 2025,
                'file_path' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
                'description' => 'Laporan audit keuangan lengkap dan transparansi penyaluran dana Lazismu NTB sepanjang tahun 2025.',
            ],
            [
                'title' => 'Laporan Keuangan Tahunan 2024',
                'year' => 2024,
                'file_path' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
                'description' => 'Aktivitas penyaluran, infaq, shadaqah, dan zakat secara transparan yang diaudit oleh akuntan publik tahun 2024.',
            ],
            [
                'title' => 'Laporan Keuangan Tahunan 2023',
                'year' => 2023,
                'file_path' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
                'description' => 'Catatan penyaluran program kemanusiaan, pendidikan, dan kesehatan Lazismu NTB untuk tahun buku 2023.',
            ],
            [
                'title' => 'Laporan Audit Keuangan Q3 2025',
                'year' => 2025,
                'file_path' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
                'description' => 'Laporan ringkas pengelolaan dana masuk dan penyaluran mustahik kuartal ketiga tahun 2025.',
            ],
        ];

        foreach ($reports as $data) {
            Report::create($data);
        }
    }
}
