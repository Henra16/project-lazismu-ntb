<?php

namespace App\Filament\Resources\PaymentTransactions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PaymentTransactionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('donation_id')
                    ->label('ID Donasi')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('gateway_name')
                    ->label('Nama Gateway')
                    ->searchable(),
                TextColumn::make('transaction_id')
                    ->label('ID Transaksi')
                    ->searchable(),
                TextColumn::make('order_id')
                    ->label('ID Pesanan')
                    ->searchable(),
                TextColumn::make('gross_amount')
                    ->label('Jumlah Bruto')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('payment_type')
                    ->label('Tipe Pembayaran')
                    ->searchable(),
                TextColumn::make('transaction_status')
                    ->label('Status Transaksi')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Tanggal Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Tanggal Diperbarui')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
