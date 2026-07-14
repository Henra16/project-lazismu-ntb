<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Program;
use App\Models\Disbursement;
use Carbon\Carbon;

class DisbursementSeeder extends Seeder
{
    public function run(): void
    {
        // Clear table first to avoid duplicate issues
        Disbursement::truncate();

        // Find programs by slug
        $zakatMaal = Program::where('slug', 'zakat-maal')->first();
        if ($zakatMaal) {
            Disbursement::create([
                'program_id' => $zakatMaal->id,
                'amount' => 8000000,
                'recipient' => 'Dhuafa Binaan Lazismu Mataram',
                'purpose' => 'Bantuan modal usaha produktif bagi UMKM dhuafa',
                'disbursed_at' => Carbon::now()->subMonths(2)->format('Y-m-d'),
            ]);
            Disbursement::create([
                'program_id' => $zakatMaal->id,
                'amount' => 4000000,
                'recipient' => 'Mustahik Pasien BPJS Kesehatan',
                'purpose' => 'Bantuan penebusan obat dan operasional kesehatan dhuafa',
                'disbursed_at' => Carbon::now()->subMonth()->format('Y-m-d'),
            ]);
        }

        $zakatFitrah = Program::where('slug', 'zakat-fitrah')->first();
        if ($zakatFitrah) {
            Disbursement::create([
                'program_id' => $zakatFitrah->id,
                'amount' => 8000000,
                'recipient' => 'Mustahik Fakir Miskin NTB',
                'purpose' => 'Penyaluran sembako beras fitrah menjelang Idul Fitri',
                'disbursed_at' => Carbon::now()->subMonths(1)->format('Y-m-d'),
            ]);
        }

        $infaqPendidikan = Program::where('slug', 'infaq-pendidikan')->first();
        if ($infaqPendidikan) {
            Disbursement::create([
                'program_id' => $infaqPendidikan->id,
                'amount' => 12000000,
                'recipient' => 'Siswa Kurang Mampu Daerah 3T',
                'purpose' => 'Beasiswa santunan pendidikan sekolah dasar dan menengah',
                'disbursed_at' => Carbon::now()->subMonths(3)->format('Y-m-d'),
            ]);
            Disbursement::create([
                'program_id' => $infaqPendidikan->id,
                'amount' => 5000000,
                'recipient' => 'Madrasah Ibtidaiyah Dhuafa Lombok Tengah',
                'purpose' => 'Pengadaan buku pelajaran kurikulum merdeka dan alat peraga',
                'disbursed_at' => Carbon::now()->subMonths(2)->format('Y-m-d'),
            ]);
        }

        $infaqMasjid = Program::where('slug', 'infaq-masjid')->first();
        if ($infaqMasjid) {
            Disbursement::create([
                'program_id' => $infaqMasjid->id,
                'amount' => 35000000,
                'recipient' => 'Panitia Pembangunan Masjid Al-Akbar Lombok Barat',
                'purpose' => 'Pembelian semen, besi cor, dan keramik untuk renovasi masjid',
                'disbursed_at' => Carbon::now()->subMonths(4)->format('Y-m-d'),
            ]);
        }

        $sedekahJumat = Program::where('slug', 'sedekah-jumat')->first();
        if ($sedekahJumat) {
            Disbursement::create([
                'program_id' => $sedekahJumat->id,
                'amount' => 1500000,
                'recipient' => 'Jamaah Dhuafa & Tukang Parkir Sekitar Kantor Lazismu',
                'purpose' => 'Penyaluran 150 paket nasi kotak berkah jumat',
                'disbursed_at' => Carbon::now()->subWeeks(2)->format('Y-m-d'),
            ]);
            Disbursement::create([
                'program_id' => $sedekahJumat->id,
                'amount' => 800000,
                'recipient' => 'Keluarga Dhuafa Lingkar Kampus',
                'purpose' => 'Bantuan sembako mingguan jumat berkah',
                'disbursed_at' => Carbon::now()->subWeeks(1)->format('Y-m-d'),
            ]);
        }

        $bencanaAlam = Program::where('slug', 'bantuan-bencana-alam')->first();
        if ($bencanaAlam) {
            Disbursement::create([
                'program_id' => $bencanaAlam->id,
                'amount' => 90000000,
                'recipient' => 'Korban Banjir Bandang Sumbawa',
                'purpose' => 'Penyediaan 1000 paket logistik makanan siap saji, selimut, dan air bersih',
                'disbursed_at' => Carbon::now()->subMonths(2)->format('Y-m-d'),
            ]);
            Disbursement::create([
                'program_id' => $bencanaAlam->id,
                'amount' => 30000000,
                'recipient' => 'Posko Layanan Medis Lazismu NTB',
                'purpose' => 'Pengadaan posko kesehatan keliling gratis pasca banjir',
                'disbursed_at' => Carbon::now()->subMonth()->format('Y-m-d'),
            ]);
        }
    }
}
