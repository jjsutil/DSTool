<?php

namespace App\Filament\Resources\ProductConceptStatsHistoryResource\Pages;

use App\Filament\Resources\ProductConceptStatsHistoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProductConceptStatsHistories extends ListRecords
{
    protected static string $resource = ProductConceptStatsHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
