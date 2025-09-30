<?php

namespace App\Filament\Resources\HeroSections\Schemas;

use Filament\Schemas\Schema;
use Illuminate\Support\Facades\DB;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\FileUpload;

class HeroSectionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Configuration')
                ->schema([
                    TextInput::make('name')
                        ->label('Name')
                        ->maxLength(255)
                        ->required()
                        ->helperText('Nama untuk identifikasi di admin panel.'),
                    Toggle::make('is_active')
                            ->required()
                            ->helperText('Jika diaktifkan, section ini akan tampil di website.')
                            ->afterStateUpdated(function ($state, $record) {
                                if ($state) {
                                    DB::table('hero_sections')->where('id', '!=', $record?->id)->update(['is_active' => false]);
                                }
                            }),
                ])->columns(2),

                Section::make('Main Hero Section (Top)')
                    ->description('Bagian paling atas dari halaman utama.')
                    ->schema([
                        TextInput::make('headline')->required(),
                        Textarea::make('description')->required()->rows(3),
                        TextInput::make('primary_button_text')->required()->label('Primary Button Text'),
                        TextInput::make('primary_button_url')->required()->label('Primary Button URL'),
                        TextInput::make('secondary_button_text')->required()->label('Secondary Button Text'),
                        TextInput::make('secondary_button_url')->required()->label('Secondary Button URL'),
                        FileUpload::make('hero_image_path')
                            ->label('Hero Image')
                            ->image()
                            ->disk('public')
                            ->directory('hero-images')
                            ->required(),
                    ])->columns(2),

                Section::make('Mid Section (Benefits)')
                    ->description('Bagian tengah yang menjelaskan manfaat produk.')
                    ->schema([
                        TextInput::make('mid_section_headline')->required(),
                        Textarea::make('mid_section_description')->required()->rows(3),
                        FileUpload::make('mid_section_image_path')
                            ->label('Mid Section Image (e.g., Logo)')
                            ->image()
                            ->disk('public')
                            ->directory('hero-images')
                            ->required(),
                    ])->columns(2),

                Section::make('Call to Action Section (Bottom)')
                    ->description('Bagian ajakan untuk mengunjungi marketplace di bawah.')
                    ->schema([
                        TextInput::make('cta_headline')->required(),
                        Textarea::make('cta_description')->required()->rows(3),
                        TextInput::make('cta_button_text')->required(),
                        TextInput::make('cta_button_url')->required(),
                    ])->columns(2),
            ]);
    }
}
