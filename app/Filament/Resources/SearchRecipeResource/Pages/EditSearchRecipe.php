<?php

namespace App\Filament\Resources\SearchRecipeResource\Pages;

use App\Filament\Resources\SearchRecipeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSearchRecipe extends EditRecord
{
    protected static string $resource = SearchRecipeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
