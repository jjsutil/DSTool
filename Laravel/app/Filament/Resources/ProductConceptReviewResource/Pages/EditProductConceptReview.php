<?php

namespace App\Filament\Resources\ProductConceptReviewResource\Pages;

use App\Filament\Resources\ProductConceptReviewResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProductConceptReview extends EditRecord
{
    protected static string $resource = ProductConceptReviewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
