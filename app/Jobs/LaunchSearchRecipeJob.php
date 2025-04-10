<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Models\SearchRecipe;
use App\Modules\MVP\Infrastructure\Services\Mappers\SearchRecipeMapper;
use Carbon\Exceptions\InvalidFormatException;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Throwable;

class LaunchSearchRecipeJob implements ShouldQueue
{
    use Queueable;

    public int $tries   = 3;
    public int $timeout = 60;

    public function __construct(
        public readonly SearchRecipe $searchRecipe
    ) {
        Log::info('LaunchSearchRecipeJob dispatched.', [
            'id'   => $this->searchRecipe->id,
            'name' => $this->searchRecipe->name,
        ]);
    }

    public function handle(): void
    {
        if (!$this->searchRecipe || !$this->searchRecipe->id) {
            throw new InvalidFormatException('Invalid SearchRecipe provided.');
        }

        try {
            $domainModel = SearchRecipeMapper::fromEloquentToDomain($this->searchRecipe);
            $payload     = SearchRecipeMapper::fromDomainToArray($domainModel);
            $response    = Http::post(config('services.python_api.search_recipe_crawler_url'), $payload);

            if ($response->failed()) {
                throw new CrawlerResponseException('External service failed to process SearchRecipe.');
            }

            Log::info('✅ SearchRecipe sent to external service.', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);
        } catch (CrawlerException $e) {
            Log::error('❌ Failed to process SearchRecipe with external service.', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            throw $e;
        } catch (Throwable $e) {
            Log::error('❌ Unexpected error while processing SearchRecipe.', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            throw new SearchRecipeException('An unexpected error occurred while processing SearchRecipe.');
        }
    }
}
