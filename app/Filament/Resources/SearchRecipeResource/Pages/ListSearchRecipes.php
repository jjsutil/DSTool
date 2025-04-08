<?php

namespace App\Filament\Resources\SearchRecipeResource\Pages;

use App\Filament\Resources\SearchRecipeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSearchRecipes extends ListRecords
{
    protected static string $resource = SearchRecipeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
