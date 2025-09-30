<?php

namespace App\Filament\Resources\Partners\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;

class PartnerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Mitra')
                    ->required()
                    ->maxLength(100),
                FileUpload::make('image')
                    ->label('logo mitra')
                    ->image()
                    ->disk('public')
                    ->directory('partners'),
                TextInput::make('url')
                    ->label('link mitra')
                    ->maxLength(255),
                Toggle::make('is_active')
                    ->label('mitra aktif?'),
            ]);
    }
}
