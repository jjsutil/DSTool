<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Enums\ResourceNavigationGroups;
use App\Filament\Resources\SearchRecipeResource\Pages;
use App\Jobs\LaunchSearchRecipeJob;
use App\Models\SearchRecipe;
use Exception;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;

// TODO: Add backend validation (e.g., price bounds, required fields, array validation)
// TODO: Replace static category/sort_by options with dynamic enum or API-based source
// TODO: Implement a proper Money value object if currency handling gets complex

class SearchRecipeResource extends Resource
{
    protected static ?string $model = SearchRecipe::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->rules(['required', 'string', 'max:255']),


                // TextInput for 'category' field (Currently commented due to enum endpoint not available)
                /*
                Forms\Components\Select::make('category')
                    ->label('Category')
                    ->options(function () {
                        // Ideally, fetch this dynamically (e.g., from an endpoint)
                        return [
                            'category1' => 'Category 1',
                            'category2' => 'Category 2',
                            'category3' => 'Category 3',
                        ];
                    })
                    ->required(),
                */

                // TextInput for 'sort_by' field (Currently commented due to enum endpoint not available)
                /*
                Forms\Components\Select::make('sort_by')
                    ->label('Sort By')
                    ->options(function () {
                        // Ideally, fetch this dynamically (e.g., from an endpoint)
                        return [
                            'asc' => 'Ascending',
                            'desc' => 'Descending',
                        ];
                    })
                    ->required(),
                */

                TextInput::make('min_price')
                    ->required()
                    ->numeric()
                ->rules(['required', 'numeric', 'min:0']),

                TextInput::make('max_price')
                    ->required()
                    ->numeric()
                    ->rules(['required', 'numeric', 'min:0']), // TODO fix somehow not working! , 'gte:min_price'

                TagsInput::make('keywords')
                    ->label('Keywords (Tags)')
                    ->placeholder('Enter keywords')
                    ->separator()
                    ->nullable(),
            ]);
    }

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Recipe Name')->sortable(),
                TextColumn::make('min_price')->label('Min Price')->sortable(),
                TextColumn::make('max_price')->label('Max Price')->sortable(),
                TextColumn::make('keywords')
                    ->label('Keywords (Tags)')
                    ->formatStateUsing(fn ($state) => self::formatKeywordsAsTags($state))
                    ->html(),
            ])
            ->filters([
                Filter::make('min_price')
                    ->form([
                        TextInput::make('min_price')
                            ->numeric(),
                    ])
                    ->query(function ($query, array $data) {
                        return $query->when($data['min_price'], fn ($q) => $q->where('min_price', '>=', $data['min_price']));
                    }),

                Filter::make('max_price')
                    ->form([
                        TextInput::make('max_price')
                            ->numeric(),
                    ])
                    ->query(function ($query, array $data) {
                        return $query->when($data['max_price'], fn ($q) => $q->where('max_price', '<=', $data['max_price']));
                    }),

                Filter::make('name')
                    ->form([
                        TextInput::make('name'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query->when($data['name'], fn ($q) => $q->where('name', 'like', '%' . $data['name'] . '%'));
                    }),
            ])

            ->actions([
                Tables\Actions\EditAction::make(),

                Action::make('launch_search')
                    ->label('Launch Search')
                    ->icon('heroicon-o-play')
                    ->color('primary')
                    ->requiresConfirmation()
                    ->action(function (SearchRecipe $record): void {
                        LaunchSearchRecipeJob::dispatch($record);
                        Notification::make()
                            ->title(' 🔍Search launched!')
                            ->body('Products will begin appearing shortly.')
                            ->success()
                            ->send();
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListSearchRecipes::route('/'),
            'create' => Pages\CreateSearchRecipe::route('/create'),
            'edit'   => Pages\EditSearchRecipe::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return ResourceNavigationGroups::BUSINESS->label();
    }

    protected static function formatKeywordsAsTags(?string $keywords): string
    {
        if (empty($keywords)) {
            return '';
        }

        $tags      = explode(',', $keywords);
        $tags      = array_map('trim', $tags);
        $tagChunks = array_chunk($tags, 5);

        return collect($tagChunks)
            ->map(function ($chunk) {
                return implode(' ', array_map(function ($tag, $index) {
                    $background = $index % 2 === 0
                        ? 'rgba(255, 250, 205, 0.7)' // light lemon chiffon
                        : 'rgba(245, 222, 179, 0.7)'; // very light wheat brown

                    return "<span style='
                                display: inline-block;
                                padding: 4px 10px;
                                margin: 2px;
                                background-color: $background;
                                color: #333;
                                font-size: 0.875rem;
                                border-radius: 9999px;
                                font-weight: 500;
                            '>$tag</span>";
                }, $chunk, array_keys($chunk))) . '<br>';
            })
            ->implode('');
    }
}
