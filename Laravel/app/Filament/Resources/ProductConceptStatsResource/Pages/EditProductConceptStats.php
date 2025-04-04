<?php

namespace App\Filament\Resources\ProductConceptStatsResource\Pages;

use App\Filament\Resources\ProductConceptStatsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProductConceptStats extends EditRecord
{
    protected static string $resource = ProductConceptStatsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
