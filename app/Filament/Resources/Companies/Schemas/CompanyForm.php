<?php

namespace App\Filament\Resources\Companies\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;

class CompanyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Konten Teks')
                    ->schema([
                        TextInput::make('headline')
                            ->label('Judul Utama')
                            ->required(),
                        RichEditor::make('paragraph_1')
                            ->label('Paragraf 1')
                            ->required()
                            ->helperText('Anda bisa menggunakan tag <b>...</b> untuk teks tebal.'),
                        RichEditor::make('paragraph_2')
                            ->label('Paragraf 2')
                            ->required(),
                    ]),

                Section::make('Tombol (Buttons)')
                    ->schema([
                        TextInput::make('button_1_text')
                            ->label('Teks Tombol 1 (Utama)')
                            ->required(),
                        TextInput::make('button_1_link')
                            ->label('Link Tombol 1')
                            ->placeholder('#showcase')
                            ->required(),
                        TextInput::make('button_2_text')
                            ->label('Teks Tombol 2 (Sekunder)')
                            ->required(),
                        TextInput::make('button_2_link')
                            ->label('Link Tombol 2')
                            ->placeholder('#riset')
                            ->required(),
                    ])->columns(2),

                Section::make('Gambar')
                    ->schema([
                        FileUpload::make('image_1')
                            ->label('Gambar 1 (Kiri)')
                            ->image()
                            ->disk('public')
                            ->directory('company-images')
                            ->required(),
                        TextInput::make('image_1_alt')
                            ->label('Teks Alternatif Gambar 1')
                            ->helperText('Deskripsi singkat gambar untuk SEO & aksesibilitas.')
                            ->required(),
                        FileUpload::make('image_2')
                            ->label('Gambar 2 (Kanan)')
                            ->image()
                            ->disk('public')
                            ->directory('company-images')
                            ->required(),
                        TextInput::make('image_2_alt')
                            ->label('Teks Alternatif Gambar 2')
                            ->helperText('Deskripsi singkat gambar untuk SEO & aksesibilitas.')
                            ->required(),
                    ])->columns(2),
            ]);
    }
}
