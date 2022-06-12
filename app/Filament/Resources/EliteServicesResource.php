<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EliteServicesResource\Pages;
use App\Filament\Resources\EliteServicesResource\RelationManagers;
use App\Models\EliteServices;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class EliteServicesResource extends Resource
{
    protected static ?string $model = EliteServices::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

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
            'index' => Pages\ListEliteServices::route('/'),
            'create' => Pages\CreateEliteServices::route('/create'),
            'edit' => Pages\EditEliteServices::route('/{record}/edit'),
        ];
    }
}
