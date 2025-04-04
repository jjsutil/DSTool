<?php

namespace App\Filament\Resources\ProductConceptResource\Pages;

use App\Filament\Resources\ProductConceptResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProductConcepts extends ListRecords
{
    protected static string $resource = ProductConceptResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
