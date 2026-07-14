<?php

namespace App\Filament\Widgets;

use Filament\Actions\BulkActionGroup;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

use App\Models\PaymentTransaction;
use Filament\Tables\Columns\TextColumn;

class RecentTransactionsWidget extends TableWidget
{
    protected static ?string $heading = 'Transaksi Terbaru';

    protected static ?int $sort = 5;

    protected int | string | array $columnSpan = 1;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                PaymentTransaction::query()->latest()->limit(5)
            )
            ->columns([
                TextColumn::make('order_id')
                    ->label('No. Transaksi')
                    ->searchable(),
                TextColumn::make('payment_type')
                    ->label('Metode')
                    ->formatStateUsing(fn (?string $state): string => strtoupper($state ?? 'Midtrans')),
                TextColumn::make('gross_amount')
                    ->label('Nominal')
                    ->money('IDR', locale: 'id'),
                TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y, H:i'),
                TextColumn::make('transaction_status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'settlement', 'capture', 'success' => 'success',
                        'pending' => 'warning',
                        'deny', 'expire', 'cancel', 'failed' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'settlement', 'capture', 'success' => 'Sukses',
                        'pending' => 'Menunggu',
                        'deny' => 'Ditolak',
                        'expire' => 'Kedaluwarsa',
                        'cancel' => 'Dibatalkan',
                        'failed' => 'Gagal',
                        default => ucfirst($state),
                    }),
            ])
            ->paginated(false);
    }
}
