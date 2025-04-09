<?php

namespace App\Filament\Resources;

use App\Enums\ResourceNavigationGroups;
use App\Filament\Resources\ProductConceptStatsResource\Pages;
use App\Models\ProductConceptStats;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductConceptStatsResource extends Resource
{
    protected static ?string $model          = ProductConceptStats::class;
    protected static ?string $panel          = 'DashboardPanel';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index'  => Pages\ListProductConceptStats::route('/'),
            'create' => Pages\CreateProductConceptStats::route('/create'),
            'edit'   => Pages\EditProductConceptStats::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return ResourceNavigationGroups::PRODUCTS->label();
    }
}
