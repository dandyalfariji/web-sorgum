<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Models\Product;
use Illuminate\Support\Str;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Group;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Schemas\Components\Utilities\Set;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->schema([
                        Section::make('Informasi Produk')
                            ->schema([
                                TextInput::make('name')
                                    ->label('Nama Produk')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (string $operation, $state, Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),

                                TextInput::make('slug')
                                    ->required()
                                    ->unique(Product::class, 'slug', ignoreRecord: true)
                                    ->readOnly(),

                                MarkdownEditor::make('description')
                                    ->label('Deskripsi')
                                    ->columnSpanFull(),
                            ])->columns(2),

                        Section::make('Gambar')
                            ->schema([
                                FileUpload::make('image')
                                    ->label('Gambar Utama')
                                    ->image()
                                    ->directory('products')
                                    ->disk('public')
                                    ->required(),

                                FileUpload::make('images')
                                    ->label('Galeri Gambar')
                                    ->image()
                                    ->disk('public')
                                    ->multiple()
                                    ->directory('products')
                                    ->maxFiles(5),
                            ]),
                    ])->columnSpan(2),

                Group::make()
                    ->schema([
                        Section::make('Harga & Stok')
                            ->schema([
                                TextInput::make('price')
                                    ->label('Harga')
                                    ->numeric()
                                    ->required()
                                    ->prefix('Rp'),

                                TextInput::make('stock')
                                    ->label('Stok')
                                    ->numeric()
                                    ->required()
                                    ->default(0),
                            ]),
                        Section::make('Atribut')
                            ->schema([
                                TextInput::make('category')
                                    ->label('Kategori'),

                                TextInput::make('rating')
                                    ->label('Rating')
                                    ->numeric()
                                    ->minValue(1)
                                    ->maxValue(5)
                                    ->default(5.0),
                            ]),
                    ])->columnSpan(1),
            ])->columns(3);
    }
}
