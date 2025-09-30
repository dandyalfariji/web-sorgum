<?php

namespace App\Filament\Resources\TeamMembers\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\FileUpload;

class TeamMemberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Anggota Tim')
                    ->schema([
                        FileUpload::make('photo')
                            ->label('Foto Profil')
                            ->image()
                            ->imageEditor()
                            ->avatar()
                            ->disk('public')
                            ->directory('team-photos')
                            ->required()
                            ->columnSpanFull(),
                        TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->required(),
                        TextInput::make('role')
                            ->label('Jabatan / Peran')
                            ->required(),
                    ])->columns(2),

                Section::make('Media Sosial (Opsional)')
                    ->schema([
                        TextInput::make('instagram_url')
                            ->label('URL Instagram')
                            ->url()
                            ->placeholder('https://instagram.com/username'),
                        TextInput::make('linkedin_url')
                            ->label('URL LinkedIn')
                            ->url()
                            ->placeholder('https://linkedin.com/in/username'),
                    ])->columns(2),

                Section::make('Pengaturan')
                    ->schema([
                        TextInput::make('sort_order')
                            ->label('Urutan Tampil')
                            ->numeric()
                            ->default(0),
                        Toggle::make('is_active')
                            ->label('Tampilkan di Website')
                            ->default(true),
                    ]),
            ]);
    }
}
