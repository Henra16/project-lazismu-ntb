<?php

namespace App\Filament\Resources\Programs\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use App\Models\Program;

class ProgramForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Judul')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (string $operation, $state, $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                TextInput::make('slug')
                    ->label('Link Alamat (Otomatis)')
                    ->required()
                    ->unique(Program::class, 'slug', ignoreRecord: true)
                    ->disabled()
                    ->dehydrated(),
                Textarea::make('description')
                    ->label('Deskripsi')
                    ->columnSpanFull(),
                Select::make('category')
                    ->label('Kategori')
                    ->options([
                        'Zakat' => 'Zakat',
                        'Infaq' => 'Infaq',
                        'Shadaqah' => 'Shadaqah',
                        'Kemanusiaan' => 'Kemanusiaan',
                        'Qurban' => 'Qurban',
                    ])
                    ->required(),
               FileUpload::make('image')
                    ->label('Gambar')
                    ->image()
                    ->disk('public')
                    ->directory('program')
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp']),
                TextInput::make('target_amount')
                    ->label('Target Dana')
                    ->numeric()
                    ->prefix('Rp'),
                TextInput::make('collected')
                    ->label('Terkumpul')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->prefix('Rp'),
                Toggle::make('is_active')
                    ->label('Aktif')
                    ->required()
                    ->default(true),
            ]);
    }
}
