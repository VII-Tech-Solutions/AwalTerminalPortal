<?php

namespace App\Filament\Resources;

use App\Constants\Attributes;
use App\Filament\Resources\GeneralAviationServicesResource\Pages;
use App\Models\Airport;
use App\Models\Country;
use App\Models\GeneralAviationServices;
use Filament\Forms;
use Filament\Forms\Components\BelongsToManyCheckboxList;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class GeneralAviationServicesResource extends Resource
{
    protected static ?string $model = GeneralAviationServices::class;

    protected static ?string $navigationIcon = 'ri-plane-fill';

    protected static ?string $navigationGroup = 'Submissions';

    protected static ?string $navigationLabel = 'General Aviation';

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
                Fieldset::make('Flight Information')->schema([
                    Forms\Components\TextInput::make(Attributes::AIRCRAFT_TYPE)->required(),
                    Forms\Components\TextInput::make(Attributes::REGISTRATION_NUMBER)->numeric(true)->required(),
                    Forms\Components\TextInput::make(Attributes::MTOW)->numeric(true)->required(),
                    Forms\Components\TextInput::make(Attributes::LEAD_PASSENGER_NAME)->required(),
                    Forms\Components\TextInput::make(Attributes::LANDING_PURPOSE)->numeric(true)->required(),
                ]),
                Fieldset::make('Arrival Information')->schema([
                    Forms\Components\TextInput::make(Attributes::ARRIVAL_CALL_SIGN)->required(),
                    Select::make(Attributes::ARRIVING_FROM_AIRPORT)
                        ->label('From Airport')
                        ->options(Airport::all()->pluck('name', 'id'))
                        ->searchable(),
                    Forms\Components\TimePicker::make(Attributes::ESTIMATED_TIME_OF_ARRIVAL)->required(),
                    Forms\Components\DatePicker::make(Attributes::ARRIVAL_DATE)->required(),
                    Forms\Components\TextInput::make(Attributes::ARRIVAL_PASSENGER_COUNT)->numeric(true)->required(),
                    Forms\Components\Textarea::make(Attributes::ARRIVAL_FLIGHT_NATURE)->required(),
                ]),
                Fieldset::make('Departure Information')->schema([
                    Forms\Components\TextInput::make(Attributes::DEPARTURE_CALL_SIGN)->required(),
                    Select::make(Attributes::DEPARTURE_TO_AIRPORT)
                        ->label('To Airport')
                        ->options(Airport::all()->pluck('name', 'id'))
                        ->searchable(),
                    Forms\Components\TimePicker::make(Attributes::ESTIMATED_TIME_OF_DEPARTURE)->required(),
                    Forms\Components\DatePicker::make(Attributes::DEPARTURE_DATE)->required(),
                    Forms\Components\TextInput::make(Attributes::DEPARTURE_PASSENGER_COUNT)->numeric(true)->required(),
                    Forms\Components\Textarea::make(Attributes::DEPARTURE_FLIGHT_NATURE)->required(),
                ]),
                Fieldset::make('Operator Information')->schema([
                    Forms\Components\TextInput::make(Attributes::OPERATOR_FULL_NAME)->required(),
                    Select::make(Attributes::OPERATOR_COUNTRY)
                        ->label('Country')
                        ->options(Country::all()->pluck('name', 'id'))
                        ->searchable(),
                    Forms\Components\TextInput::make(Attributes::OPERATOR_TEL_NUMBER)->required(),
                    Forms\Components\TextInput::make(Attributes::OPERATOR_EMAIL)->email(true)->required(),
                    Forms\Components\Textarea::make(Attributes::OPERATOR_ADDRESS)->required(),
                    Forms\Components\Textarea::make(Attributes::OPERATOR_BILLING_ADDRESS)->required(),
                ]),
                Fieldset::make('Agent Information')->schema([
                    Forms\Components\TextInput::make(Attributes::AGENT_FULLNAME)->required(),
                    Select::make(Attributes::AGENT_COUNTRY)
                        ->label('Country')
                        ->options(Country::all()->pluck('name', 'id'))
                        ->searchable(),
                    Forms\Components\TextInput::make(Attributes::AGENT_PHONENUMBER)->required(),
                    Forms\Components\TextInput::make(Attributes::AGENT_EMAIL)->email(true)->required(),
                    Forms\Components\Textarea::make(Attributes::AGENT_ADDRESS)->required(),
                    Forms\Components\Textarea::make(Attributes::AGENT_BILLING_ADDRESS)->required(),

                ]),
                Fieldset::make('Required Services')->schema([
                    Forms\Components\BelongsToManyCheckboxList::make('services')->relationship('services', 'name'),
                ]),
                Fieldset::make('Documents & Remarks')->schema([
                    FileUpload::make('Document'),
                    FileUpload::make('Aircraft Certifications Checklist'),
                    FileUpload::make('Arrival Gendec'),
                    FileUpload::make('Departure Gendec'),
                    Forms\Components\Textarea::make(Attributes::REMARKS)->columns(1),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make(Attributes::ID),
                Tables\Columns\TextColumn::make(Attributes::REGISTRATION_NUMBER),
                Tables\Columns\TextColumn::make(Attributes::CREATED_AT),
                Tables\Columns\TextColumn::make(Attributes::ESTIMATED_TIME_OF_ARRIVAL),
                Tables\Columns\TextColumn::make(Attributes::LEAD_PASSENGER_NAME)

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
            'index' => Pages\ListGeneralAviationServices::route('/'),
            'create' => Pages\CreateGeneralAviationServices::route('/create'),
            'edit' => Pages\EditGeneralAviationServices::route('/{record}/edit'),
        ];
    }
}
