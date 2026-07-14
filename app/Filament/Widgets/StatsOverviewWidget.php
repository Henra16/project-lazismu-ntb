<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseStatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

use App\Models\Donation;
use App\Models\Program;

class StatsOverviewWidget extends BaseStatsOverviewWidget
{
    protected function getStats(): array
    {
        $totalDonasi = Donation::where('status', 'paid')
            ->get()
            ->sum(fn (Donation $donation) => $donation->total_amount);

        // Transaksi dianggap "sukses" jika status donasi paid
        $totalTransaksi = Donation::where('status', 'paid')->count();

        // Total donatur dihitung hanya dari transaksi yang sukses (paid)
        $totalDonatur = Donation::where('status', 'paid')
            ->distinct()
            ->count('donor_email');

        $totalProgram = Program::count();

        return [
            Stat::make('Total Donasi', 'Rp ' . number_format($totalDonasi, 0, ',', '.'))
                ->description('12% dari minggu lalu')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Total Transaksi', $totalTransaksi)
                ->description('8% dari minggu lalu')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Total Donatur', $totalDonatur)
                ->description('5% dari minggu lalu')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Total Program', $totalProgram)
                ->description('Sama dengan minggu lalu')
                ->descriptionIcon('heroicon-m-minus')
                ->color('gray'),
        ];
    }
}
