<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Models\SearchRecipe;
use App\Modules\MVP\Infrastructure\Services\Mappers\SearchRecipeMapper;
use Carbon\Exceptions\InvalidFormatException;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Throwable;
use App\Exceptions\SearchRecipeException;
use App\Exceptions\ProductRankerResponseException;
use App\Exceptions\ProductRankerException;

class LaunchSearchRecipeJob implements ShouldQueue
{
    use Queueable;

    public int $tries   = 3;
    public int $timeout = 60;

    public function __construct(
        public readonly SearchRecipe $searchRecipe
    ) {
        $this->logJobDispatch();
    }

    /**
     * @throws ProductRankerException
     * @throws SearchRecipeException
     */
    public function handle(): void
    {
        $this->handleInvalidRecipe();

        try {
            $domainModel = SearchRecipeMapper::fromEloquentToDomain($this->searchRecipe);
            $payload     = SearchRecipeMapper::fromDomainToArray($domainModel);

            $baseUrl = config('services.python_api.product_ranker_url');

            $this->handleBaseUrl($baseUrl);
            $url = $baseUrl . 'search-recipe/';



            Log::info('trying to get from Payload...', $payload);
            $response = Http::get($url, $payload);

            Log::info('GET query result from url ' .  $url . ' with response ' . $response);

            // TODO connect response with mappers -> eloquent -> database
            //            $this->handleResponseCases($response);
            $this->handleFailedResponse($response);
            $this->logSuccessfulRecipeSent($response);
            //            $this->parseResponseToEloquent(&$response); Mappers?
            //            LaunchRankedProductsUpsertJob::dispatch($response);

        } catch (ProductRankerException $e) {
            $this->logRankerException($e);

            throw $e;
        } catch (Throwable $e) {
            $this->logUnexpected($e);

            throw new SearchRecipeException('An unexpected error occurred while processing SearchRecipe.');
        }
    }

    /**
     * @throws ProductRankerResponseException
     */
    private function handleFailedResponse(Response $response): void
    {
        if ($response->failed()) {
            throw new ProductRankerResponseException('External service failed to process SearchRecipe.');
        }
    }

    private function handleInvalidRecipe(): void
    {
        Log::info('recipe', [$this->searchRecipe]);
        if (!$this->searchRecipe || !$this->searchRecipe->id) {
            Log::info('failed!');
            throw new InvalidFormatException('Invalid SearchRecipe provided.');
        }
    }

    private function logUnexpected(Throwable|Exception $e): void
    {
        Log::error('❌ Unexpected error while processing SearchRecipe.', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);
    }

    private function logRankerException(ProductRankerException|Exception $e): void
    {
        Log::error('❌ Failed to process SearchRecipe with external service.', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);
    }

    private function logSuccessfulRecipeSent(Response $response): void
    {
        Log::info('✅ SearchRecipe sent to external service.', [
            'status' => $response->status(),
            'body'   => $response->body(),
        ]);
    }

    private function logJobDispatch(): void
    {
        Log::info('LaunchSearchRecipeJob dispatched.', [
            'id'   => $this->searchRecipe->id,
            'name' => $this->searchRecipe->name,]);
    }

    /**
     * @throws ProductRankerException
     */
    private function handleBaseUrl(string $baseUrl): void
    {
        if (empty($baseUrl)) {
            throw new ProductRankerException('Product ranker URL is not configured.');
        }
    }
}
