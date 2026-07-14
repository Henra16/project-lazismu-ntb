<?php

namespace App\Filament\Widgets;

use Filament\Actions\BulkActionGroup;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

use App\Models\Donation;
use Filament\Tables\Columns\TextColumn;

class RecentDonationsWidget extends TableWidget
{
    protected static ?string $heading = 'Donasi Terbaru';

    protected static ?int $sort = 4;

    protected int | string | array $columnSpan = 1;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Donation::query()->latest()->limit(5)
            )
            ->columns([
                TextColumn::make('donor_name')
                    ->label('Nama Donatur')
                    ->searchable(),
                TextColumn::make('program.title')
                    ->label('Program')
                    ->limit(25),
                TextColumn::make('total_amount')
                    ->label('Nominal')
                    ->state(fn (Donation $record): int => $record->total_amount)
                    ->money('IDR', locale: 'id'),
                TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y, H:i'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'paid' => 'success',
                        'pending' => 'warning',
                        'failed', 'expired' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'paid' => 'Sukses',
                        'pending' => 'Menunggu',
                        'failed' => 'Gagal',
                        'expired' => 'Kedaluwarsa',
                        default => $state,
                    }),
            ])
            ->paginated(false);
    }
}
