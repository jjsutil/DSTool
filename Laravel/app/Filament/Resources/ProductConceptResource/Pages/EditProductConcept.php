<?php

namespace App\Filament\Resources\ProductConceptResource\Pages;

use App\Filament\Resources\ProductConceptResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProductConcept extends EditRecord
{
    protected static string $resource = ProductConceptResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
