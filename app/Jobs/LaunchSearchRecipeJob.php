<?php

namespace App\Jobs;

use App\Models\SearchRecipe;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class LaunchSearchRecipeJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public readonly SearchRecipe $searchRecipe
    ) {
        Log::info('LaunchSearchRecipeJob dispatched.', [
            'id'   => $this->searchRecipe->id,
            'name' => $this->searchRecipe->name,
        ]);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // TODO: Validate SearchRecipe input before processing
        // TODO: Map to SearchRecipeDTO
        // TODO: Dispatch to external search service
        // TODO: Save search result snapshots (optional)
    }
}
