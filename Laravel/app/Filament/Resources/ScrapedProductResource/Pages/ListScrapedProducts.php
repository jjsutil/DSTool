<?php

namespace App\Filament\Resources\ScrapedProductResource\Pages;

use App\Filament\Resources\ScrapedProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListScrapedProducts extends ListRecords
{
    protected static string $resource = ScrapedProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
