<?php

namespace App\Filament\Resources;

use App\Constants\Attributes;
use App\Filament\Resources\EliteServicesResource\Pages;
use App\Filament\Resources\EliteServicesResource\RelationManagers;
use App\Models\Airport;
use App\Models\EliteServices;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class EliteServicesResource extends Resource
{
    protected static ?string $model = EliteServices::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';

    protected static ?string $navigationGroup = 'Submissions';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Fieldset::make('Flight Details')->schema([
//                    Select::make(Attributes::SERVICE_ID)
//                        ->label('Service')
//                        ->options(Airport::all()->pluck('name', 'id'))
//                        ->searchable(),

                ]),
                Select::make(Attributes::ARRIVING_FROM_AIRPORT)
                    ->label('Arriving From')
                    ->options(Airport::all()->pluck('name', 'id'))
                    ->searchable(),
                Forms\Components\DatePicker::make(Attributes::DATE)->required(),
                Forms\Components\TimePicker::make(Attributes::TIME)->required(),
                Forms\Components\TextInput::make(Attributes::FLIGHT_NUMBER)->required(),
                Forms\Components\TextInput::make(Attributes::NUMBER_OF_ADULTS)->numeric(true)->required(),
                Forms\Components\TextInput::make(Attributes::NUMBER_OF_CHILDREN)->numeric(true)->required(),
                Forms\Components\TextInput::make(Attributes::NUMBER_OF_INFANTS)->numeric(true)->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make(Attributes::ID),
                Tables\Columns\TextColumn::make(Attributes::CREATED_AT),
                Tables\Columns\TextColumn::make(Attributes::TIME),
                Tables\Columns\TextColumn::make(Attributes::DATE),

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
