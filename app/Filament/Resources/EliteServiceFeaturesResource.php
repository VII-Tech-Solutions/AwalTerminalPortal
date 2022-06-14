<?php

namespace App\Filament\Resources;

use App\Constants\Attributes;
use App\Filament\Resources\EliteServiceFeaturesResource\Pages;
use App\Filament\Resources\EliteServiceFeaturesResource\RelationManagers;
use App\Models\EliteServiceFeatures;
use App\Models\EliteServiceTypes;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class EliteServiceFeaturesResource extends Resource
{
    protected static ?string $model = EliteServiceFeatures::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Elite Services Metadata';

    protected static function getNavigationBadge(): ?string
    {
        if(env("FILAMENT_ENABLE_BADGE", false)){
            return static::getModel()::count();
        }
        return null;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Select::make(Attributes::SERVICE_ID)
                    ->label('Service')
                    ->options(EliteServiceTypes::all()->pluck('name', 'id'))
                    ->searchable(),
                Forms\Components\Textarea::make(Attributes::FEATURE_DETAILS)->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make(Attributes::ID),
                Tables\Columns\TextColumn::make(Attributes::FEATURE_DETAILS)->limit(50)->wrap(),

            ])
            ->filters([
                //
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
            'index' => Pages\ListEliteServiceFeatures::route('/'),
            'create' => Pages\CreateEliteServiceFeatures::route('/create'),
            'edit' => Pages\EditEliteServiceFeatures::route('/{record}/edit'),
        ];
    }
}
