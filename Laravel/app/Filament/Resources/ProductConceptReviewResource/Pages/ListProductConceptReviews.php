<?php

namespace App\Filament\Resources\ProductConceptReviewResource\Pages;

use App\Filament\Resources\ProductConceptReviewResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProductConceptReviews extends ListRecords
{
    protected static string $resource = ProductConceptReviewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
