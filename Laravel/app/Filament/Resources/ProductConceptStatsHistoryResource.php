<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductConceptStatsHistoryResource\Pages;
use App\Models\ProductConceptStatsHistory;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductConceptStatsHistoryResource extends Resource
{
    protected static ?string $model          = ProductConceptStatsHistory::class;
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
            'index'  => Pages\ListProductConceptStatsHistories::route('/'),
            'create' => Pages\CreateProductConceptStatsHistory::route('/create'),
            'edit'   => Pages\EditProductConceptStatsHistory::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Products related';
    }
}
