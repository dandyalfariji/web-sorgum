<?php

namespace App\Filament\Resources\Footers\Pages;

use App\Models\Footer;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\Footers\FooterResource;

class ListFooters extends ListRecords
{
    protected static string $resource = FooterResource::class;

    // protected function getHeaderActions(): array
    // {
    //     return [
    //         CreateAction::make(),
    //     ];
    // }

    protected function getHeaderActions(): array
    {
        // Logika untuk hanya menampilkan tombol create jika belum ada data sama sekali
        if (Footer::count() === 0) {
            return [
                CreateAction::make(),
            ];
        }

        return [];
    }
}
