<?php

namespace App\Filament\Resources\News\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class NewsTable
{
    public static function configure(Table $table): Table
    {
        return $table
           ->columns([
                    TextColumn::make('title')
                        ->label('Judul')
                        ->searchable(),

                    TextColumn::make('slug')
                        ->label('Link Alamat')
                        ->searchable(),

                    ImageColumn::make('image')
                        ->label('Gambar'),

                    TextColumn::make('category')
                        ->label('Kategori')
                        ->searchable(),

                    IconColumn::make('is_published')
                        ->label('Dipublikasi')
                        ->boolean(),

                    TextColumn::make('published_at')
                        ->label('Tanggal Publikasi')
                        ->dateTime()
                        ->sortable(),

                    TextColumn::make('created_at')
                        ->label('Dibuat Pada')
                        ->dateTime()
                        ->sortable()
                        ->toggleable(isToggledHiddenByDefault: true),

                    TextColumn::make('updated_at')
                        ->label('Diperbarui Pada')
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
