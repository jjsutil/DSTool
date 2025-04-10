<?php

declare(strict_types=1);

namespace App\Filament\Resources\SearchRecipeResource\Pages;

use App\Filament\Resources\SearchRecipeResource;
use App\Jobs\LaunchSearchRecipeJob;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateSearchRecipe extends CreateRecord
{
    protected static string $resource = SearchRecipeResource::class;

    /**
     * This method is executed after a record has been successfully created.
     */
    protected function afterCreate(): void
    {
        $searchRecipe = $this->record;
        LaunchSearchRecipeJob::dispatch($searchRecipe);
        Notification::make()
            ->title('🔍 Search launched!')
            ->body('The search process for this recipe has been initiated.')
            ->success()
            ->send();
    }
}
