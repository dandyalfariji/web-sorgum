<?php

namespace App\Filament\Resources\Headers\Schemas;

use Filament\Schemas\Schema;
use Illuminate\Support\Facades\DB;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Utilities\Get;

class HeaderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Header Configuration')
                    ->description('Atur detail utama header. Pastikan hanya satu header yang aktif.')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->helperText('Nama untuk identifikasi di admin panel.'),
                        FileUpload::make('logo_path')
                            ->label('Logo')
                            ->image()
                            ->directory('logo')
                            ->visibility('public')
                            ->disk('public')
                            ->required(),
                        Toggle::make('is_active')
                            ->required()
                            ->helperText('Jika diaktifkan, header ini akan tampil di website.')
                            ->afterStateUpdated(function ($state, callable $set, $record) {
                                // Jika toggle ini diaktifkan, nonaktifkan semua header lain
                                if ($state) {
                                    DB::table('headers')->where('id', '!=', $record?->id)->update(['is_active' => false]);
                                }
                            }),
                    ])->columns(2),

                Section::make('Menu Items')
                    ->description('Atur link navigasi yang akan tampil di header. Urutkan dengan drag-and-drop.')
                    ->schema([
                        Repeater::make('menuItems')
                            ->relationship()
                            ->schema([
                                TextInput::make('label')
                                    ->required()->maxLength(255),
                                TextInput::make('url')
                                    ->required()->maxLength(255),
                                TextInput::make('wire_click_key')
                                    ->required()
                                    ->maxLength(255)
                                    ->helperText('Key untuk state Livewire. Cth: home, features'),
                                Toggle::make('is_visible')
                                    ->label('Visible')
                                    ->default(true),
                                Hidden::make('order')
                                    ->default(function (Get $get) {
                                        // Set order ke jumlah item yang sudah ada + 1
                                        return count($get('../../menuItems'));
                                    }),
                            ])
                            ->reorderableWithDragAndDrop('order')
                            ->columns(2)
                            ->grid(2)
                            ->defaultItems(1)
                            ->required(),
                            ]),
            ]);
    }
}
