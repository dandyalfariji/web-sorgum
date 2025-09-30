<?php

namespace App\Filament\Resources\Footers\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\FileUpload;

class FooterForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Brand Information')
                    ->schema([
                        FileUpload::make('logo_path')
                            ->label('Logo')
                            ->image()
                            ->disk('public')
                            ->directory('site-logos')
                            ->required(),
                        TextInput::make('brand_name')
                            ->default('Sorgummi')
                            ->required(),
                        Textarea::make('description')
                            ->label('Deskripsi Singkat')
                            ->rows(3)
                            ->required(),
                    ])->columns(2),

                Section::make('Link Columns')
                    ->schema([
                        Repeater::make('link_columns')
                            ->label('Kolom Link')
                            ->schema([
                                TextInput::make('column_title')
                                    ->label('Judul Kolom')
                                    ->required(),
                                Repeater::make('links')
                                    ->label('Daftar Link')
                                    ->schema([
                                        TextInput::make('link_text')->label('Teks Link')->required(),
                                        TextInput::make('link_url')->label('URL Link')->required(),
                                    ])->columns(2),
                            ])
                            ->collapsible()
                            ->cloneable()
                            ->reorderableWithDragAndDrop()
                            ->defaultItems(3), // Default 3 kolom
                    ]),

                Section::make('Social Media Links')
                    ->schema([
                        TextInput::make('whatsapp_url')->label('URL WhatsApp')->url()->placeholder('https://wa.me/62...'),
                        TextInput::make('instagram_url')->label('URL Instagram')->url()->placeholder('https://instagram.com/...'),
                        TextInput::make('tiktok_url')->label('URL TikTok')->url()->placeholder('https://tiktok.com/@...'),
                        TextInput::make('shopee_url')->label('URL Shopee')->url()->placeholder('https://shopee.co.id/...'),
                    ])->columns(2),

                Section::make('Copyright')
                    ->schema([
                        TextInput::make('copyright_text')
                            ->label('Teks Copyright')
                            ->default('All rights reserved.')
                            ->required(),
                    ]),
            ]);
    }
}
