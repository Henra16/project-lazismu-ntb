<?php

namespace App\Filament\Resources\Donations\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class DonationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('uuid')
                    ->label('UUID')
                    ->disabled()
                    ->hiddenOn('create'),
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable(),
                Select::make('program_id')
                    ->relationship('program', 'title')
                    ->required()
                    ->searchable(),
                TextInput::make('donor_name')
                    ->label('Nama Donatur')
                    ->required(),
                TextInput::make('donor_email')
                    ->label('Email Donatur')
                    ->email()
                    ->required(),
                TextInput::make('donor_phone')
                    ->label('No. HP Donatur')
                    ->tel()
                    ->placeholder('Contoh: 08123456789'),
                TextInput::make('amount')
                    ->label('Jumlah Donasi')
                    ->required()
                    ->numeric(),
                TextInput::make('admin_fee')
                    ->label('Biaya Admin')
                    ->numeric()
                    ->default(0),
                TextInput::make('payment_method')
                    ->label('Metode Pembayaran')
                    ->required(),
                Select::make('status')
                    ->options(['pending' => 'Pending', 'paid' => 'Paid', 'failed' => 'Failed', 'expired' => 'Expired'])
                     ->label('Status Donasi')
                    ->default('pending')
                    ->required(),
                DateTimePicker::make('paid_at')
                    ->label('Tanggal Pembayaran')
                    ->hidden(fn ($get) => $get('status') !== 'paid'),
                TextInput::make('ip_address')
                    ->label('Alamat IP')
                    ->columnSpanFull(),
                Textarea::make('user_agent')
                    ->label('User Agent')
                    ->columnSpanFull()
                    ->required(),
            ]);
    }
}
