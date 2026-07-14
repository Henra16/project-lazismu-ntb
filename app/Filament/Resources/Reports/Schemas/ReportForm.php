<?php

namespace App\Filament\Resources\Reports\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Schema;

class ReportForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
               DatePicker::make('date')
                    ->label('Tanggal Laporan')
                    ->required()
                    ->displayFormat('d M Y')
                    ->native(false),
                FileUpload::make('file_path')
                    ->label('File Laporan (PDF)')
                    ->disk('public')
                    ->directory('reports')
                    ->acceptedFileTypes(['application/pdf'])
                    ->maxSize(10240)
                    ->getUploadedFileNameForStorageUsing(
                        fn ($file) => time() . '-' . $file->getClientOriginalName()
                    )
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
            ]);
    }
}
