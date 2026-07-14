<?php

namespace App\Filament\Resources\PaymentTransactions\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PaymentTransactionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('donation_id')
                    ->label('ID Donasi')
                     ->required()
                     ->numeric(),
                TextInput::make('gateway_name')
                    ->label('Nama Gateway')
                    ->required()
                    ->default('midtrans'),
                TextInput::make('transaction_id')
                    ->label('ID Transaksi')
                    ->required(),
                TextInput::make('order_id')
                    ->label('ID Pesanan')
                     ->required(),
                TextInput::make('gross_amount')
                    ->label('Jumlah Bruto') 
                    ->required()
                    ->numeric(),
                TextInput::make('payment_type')
                    ->label('Tipe Pembayaran'),
                TextInput::make('transaction_status')
                    ->label('Status Transaksi')
                    ->required(),
                Textarea::make('signature_key')
                    ->label('Signature Key')
                     ->required()
                     ->columnSpanFull(),
                TextInput::make('raw_response')
                    ->label('Raw Response (JSON)')
                    ->columnSpanFull(),
            ]);
    }
}
