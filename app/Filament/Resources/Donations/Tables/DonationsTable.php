<?php

namespace App\Filament\Resources\Donations\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class DonationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('uuid')
                    ->label('UUID')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('program.title')
                    ->label('Program')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('warning'),

                TextColumn::make('donor_name')
                    ->label('Nama Donatur')
                    ->searchable()
                    ->formatStateUsing(fn ($state, $record) =>
                        $record->is_anonymous ? '🙈 Hamba Allah' : $state
                    ),

                TextColumn::make('donor_email')
                    ->label('Email')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false),

                TextColumn::make('donor_phone')
                    ->label('No. HP Donatur')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Nomor HP tersalin!')
                    ->icon('heroicon-o-phone')
                    ->toggleable(isToggledHiddenByDefault: false),

                TextColumn::make('amount')
                    ->label('Jumlah')
                    ->numeric()
                    ->sortable()
                    ->money('IDR', locale: 'id'),

                TextColumn::make('admin_fee')
                    ->label('Biaya Admin')
                    ->numeric()
                    ->sortable()
                    ->money('IDR', locale: 'id')
                    ->toggleable(isToggledHiddenByDefault: false),

                TextColumn::make('payment_method')
                    ->label('Metode Bayar')
                    ->searchable()
                    ->badge()
                    ->color('info'),

                TextColumn::make('transaction.transaction_id')
                    ->label('ID Transaksi')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false),

                TextColumn::make('transaction.payment_type')
                    ->label('Tipe Pembayaran')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'paid'    => 'success',
                        'pending' => 'warning',
                        'failed'  => 'danger',
                        'expired' => 'gray',
                        default   => 'gray',
                    }),

                IconColumn::make('is_anonymous')
                    ->label('Anonim')
                    ->boolean()
                    ->trueIcon('heroicon-o-eye-slash')
                    ->falseIcon('heroicon-o-eye')
                    ->trueColor('warning')
                    ->falseColor('gray'),

                TextColumn::make('doa')
                    ->label('Doa / Pesan')
                    ->limit(60)
                    ->placeholder('—')
                    ->toggleable(isToggledHiddenByDefault: false),

                TextColumn::make('paid_at')
                    ->label('Dibayar Pada')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->placeholder('Belum dibayar'),

                TextColumn::make('ip_address')
                    ->label('IP')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'paid'    => 'Paid',
                        'failed'  => 'Failed',
                        'expired' => 'Expired',
                    ]),

                SelectFilter::make('payment_method')
                    ->label('Metode Pembayaran')
                    ->options([
                        'qris'           => 'QRIS',
                        'va_bni'         => 'VA BNI',
                        'va_bsi'         => 'VA BSI',
                        'va_bri'         => 'VA BRI',
                        'va_ntb_syariah' => 'VA NTB Syariah',
                        'transfer_manual'=> 'Transfer Manual',
                    ]),

                SelectFilter::make('is_anonymous')
                    ->label('Anonim')
                    ->options([
                        '1' => 'Hamba Allah',
                        '0' => 'Nama Asli',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->headerActions([
                \pxlrbt\FilamentExcel\Actions\Tables\ExportAction::make()
                    ->label('Export Excel')
                    ->exports([
                        \pxlrbt\FilamentExcel\Exports\ExcelExport::make('table')->fromTable(),
                    ]),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    \pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction::make()
                        ->exports([
                            \pxlrbt\FilamentExcel\Exports\ExcelExport::make('table')->fromTable(),
                        ]),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
