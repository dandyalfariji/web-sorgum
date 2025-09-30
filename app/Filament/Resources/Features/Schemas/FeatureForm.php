<?php

namespace App\Filament\Resources\Features\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;

class FeatureForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        FileUpload::make('icon')
                            ->label('Icon (PNG)')
                            ->image()
                            ->directory('feature-icons')
                            ->disk('public')
                            ->required()
                            ->columnSpanFull()
                            ->helperText('Unggah file PNG untuk ikon fitur.'),

                        TextInput::make('title')
                            ->label('Judul Fitur')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('sort_order')
                            ->label('Urutan Tampil')
                            ->numeric()
                            ->default(0)
                            ->helperText('Angka yang lebih kecil akan ditampilkan lebih dulu.'),

                        RichEditor::make('description')
                            ->label('Deskripsi')
                            ->required()
                            ->columnSpanFull()
                            ->helperText('Anda bisa menggunakan tag HTML sederhana seperti <b>...</b> untuk membuat teks tebal.'),

                        Toggle::make('is_active')
                            ->label('Aktifkan Fitur')
                            ->required()
                            ->default(true),
                    ])->columns(2),
            ]);
    }
}
