<?php

namespace App\Filament\Resources;

use App\Enums\ResourceNavigationGroups;
use App\Filament\Resources\ProviderResource\Pages;
use App\Models\Provider;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProviderResource extends Resource
{
    protected static ?string $model          = Provider::class;
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
            'index'  => Pages\ListProviders::route('/'),
            'create' => Pages\CreateProvider::route('/create'),
            'edit'   => Pages\EditProvider::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return ResourceNavigationGroups::PROVIDERS->label();
    }
}
