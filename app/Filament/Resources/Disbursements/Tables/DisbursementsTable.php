<?php

namespace App\Filament\Resources\Disbursements\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DisbursementsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('program.title')
                    ->label('Program')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('amount')
                    ->label('Jumlah Dana')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('recipient')
                    ->label('Penerima')
                    ->searchable(),
                TextColumn::make('purpose')
                    ->label('Keperluan')
                    ->searchable(),
                TextColumn::make('disbursed_at')
                    ->label('Tanggal Pencairan')
                    ->date()
                    ->sortable(),
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
