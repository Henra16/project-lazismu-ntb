<?php

namespace App\Filament\Resources\Disbursements\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class DisbursementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('program.title')
                    ->label('Program')
                    ->relationship('program', 'title')
                    ->required()
                    ->searchable(),
                TextInput::make('amount')
                    ->label('Jumlah Pencairan')
                    ->required()
                    ->numeric(),
                TextInput::make('recipient')
                    ->label('Penerima Dana')
                    ->required(),
                TextInput::make('purpose')
                    ->label('Keperluan Pencairan')
                    ->required(),
                DatePicker::make('disbursed_at')
                    ->label('Tanggal Pencairan')
                    ->required(),
            ]);
    }
}
