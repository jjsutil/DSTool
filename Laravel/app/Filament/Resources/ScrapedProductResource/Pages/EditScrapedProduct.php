<?php

namespace App\Filament\Resources\ScrapedProductResource\Pages;

use App\Filament\Resources\ScrapedProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditScrapedProduct extends EditRecord
{
    protected static string $resource = ScrapedProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
