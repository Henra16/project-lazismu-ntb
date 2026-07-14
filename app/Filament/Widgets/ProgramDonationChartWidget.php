<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

use App\Models\Donation;

class ProgramDonationChartWidget extends ChartWidget
{
    protected ?string $heading = 'Donasi Berdasarkan Program';
    
    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 1;

    protected function getData(): array
    {
        // 5 program inti (sesuai yang Anda mau tampilkan)
       $kategoriInti = [
                    'Zakat',
                    'Infaq',
                    'Shadaqah',
                    'Kemanusiaan',
                    'Qurban',
                ];

                $records = Donation::query()
                    ->join('programs', 'donations.program_id', '=', 'programs.id')
                    ->where('donations.status', 'paid')
                    ->whereIn('programs.category', $kategoriInti)
                    ->selectRaw('programs.category, SUM(donations.amount) as total')
                    ->groupBy('programs.category')
                    ->pluck('total', 'programs.category')
                    ->toArray();

        $labels = [];
        $values = [];

       foreach ($kategoriInti as $kategori) {
            $labels[] = $kategori;
            $values[] = (float) ($records[$kategori] ?? 0);
        }

        // Jika belum ada data, tampilkan contoh agar chart tidak kosong
        if (array_sum($values) === 0) {
            $labels = ['Zakat', 'Infaq', 'Shadaqah', 'Kemanusiaan', 'Qurban'];
            $values = [0, 0, 0, 0, 0];
        }

        return [
            'datasets' => [
                [
                    'label' => 'Proporsi Donasi (%)',
                    'data' => $values,
                    'backgroundColor' => [
                        '#F7941D', // Orange
                        '#10B981', // Emerald
                        '#EF4444', // Rose Red
                        '#3B82F6', // Sky Blue
                        '#8B5CF6', // Violet
                    ],
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
