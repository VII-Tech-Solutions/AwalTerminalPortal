<?php

namespace App\Filament\Resources;

use App\Constants\AdminUserType;
use App\Constants\Attributes;
use App\Filament\Resources\EliteServicesResource\Pages;
use App\Filament\Resources\EliteServicesResource\RelationManagers;
use App\Models\Airport;
use App\Models\Country;
use App\Models\EliteServices;
use App\Models\EliteServiceTypes;
use App\Models\SubmissionStatus;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;


class EliteServicesResource extends Resource
{
    protected static ?string $model = EliteServices::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';

    protected static ?string $navigationGroup = 'Submissions';


    protected static function getNavigationBadge(): ?string
    {
        if (env("FILAMENT_ENABLE_BADGE", false)) {
            return static::getModel()::count();
        }
        return null;
    }

    protected static function shouldRegisterNavigation(): bool
    {
        /** @var User $user */
        $user = auth()->user();
        return $user->canAccess(AdminUserType::ELITE_ONLY);
    }

    public static function canViewAny(): bool
    {
        /** @var User $user */
        $user = auth()->user();
        return $user->canAccess(AdminUserType::ELITE_ONLY);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make(Attributes::TOTAL)->numeric(true)->columns(2)->suffix('BHD'),

                Tabs::make('Heading')
                    ->tabs([
                        Tabs\Tab::make('Information')
                            ->schema([

                                Fieldset::make('General Information')->schema([
                                    Forms\Components\TextInput::make(Attributes::UUID)->columns(1)->disabled(true),
                                    Select::make(Attributes::SERVICE_ID)
                                        ->label('Selected Service')
                                        ->options(EliteServiceTypes::all()->pluck('name', 'id'))
                                        ->searchable(),
                                    Select::make(Attributes::SUBMISSION_STATUS_ID)
                                        ->label('Form Status')
                                        ->options(SubmissionStatus::all()->pluck('name', 'id'))
                                        ->searchable(),
                                    Forms\Components\Textarea::make(Attributes::REJECTION_REASON)->columns(1),
                                ])->columns(1),
                                Fieldset::make('Flight Details')->schema([
                                    Forms\Components\Radio::make(Attributes::IS_ARRIVAL_FLIGHT)->options([
                                        1 => 'Arrival',
                                        0 => 'Departure',
                                    ])->label('Flight type:'),
                                    Select::make(Attributes::AIRPORT_ID)
                                        ->label('Airport:')
                                        ->options(Airport::all()->pluck('name', 'id'))
                                        ->searchable(),
                                    Forms\Components\DatePicker::make(Attributes::DATE),
                                    Forms\Components\TimePicker::make(Attributes::TIME),
                                    Forms\Components\TextInput::make(Attributes::FLIGHT_NUMBER),
                                    Forms\Components\TextInput::make(Attributes::NUMBER_OF_ADULTS)->numeric(true)->required(),
                                    Forms\Components\TextInput::make(Attributes::NUMBER_OF_CHILDREN)->numeric(true)->required(),
                                    Forms\Components\TextInput::make(Attributes::NUMBER_OF_INFANTS)->numeric(true)->required(),
                                ]),
                            ]),
                        Tabs\Tab::make('Passenger Details')
                            ->schema([
                                Forms\Components\HasManyRepeater::make('passengers')->relationship('passengers')->schema([
                                    Select::make(Attributes::TITLE)
                                        ->label('Title')
                                        ->options(['Mr' => 'Mr',
                                            'Ms' => 'Ms',
                                            'Miss' => 'Miss',
                                            'Mrs' => 'Mrs']),
                                    Forms\Components\TextInput::make(Attributes::FIRST_NAME)->required(),
                                    Forms\Components\TextInput::make(Attributes::LAST_NAME)->required(),
                                    Select::make(Attributes::NATIONALITY_ID)
                                        ->label('Nationality')
                                        ->options(Country::all()->pluck('name', 'id'))
                                        ->searchable(),
                                    Forms\Components\TextInput::make(Attributes::FLIGHT_CLASS)->required(),
                                    Forms\Components\DatePicker::make(Attributes::BIRTH_DATE)->label('Date of birth')
                                ])->label('Passengers'),
                            ])->columns(2),
                        Tabs\Tab::make('Booker Details')
                            ->schema([
                                Forms\Components\HasManyRepeater::make('booker')->relationship('booker')->schema([
                                    Forms\Components\TextInput::make(Attributes::FIRST_NAME)->required(),
                                    Forms\Components\TextInput::make(Attributes::LAST_NAME)->required(),
                                    Forms\Components\TextInput::make(Attributes::EMAIL)->required(),
                                    Forms\Components\TextInput::make(Attributes::MOBILE_NUMBER)->required(),
                                ])->columns(1)
                            ])
                    ])
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make(Attributes::ID)->label("ID"),
                Tables\Columns\TextColumn::make(Attributes::CREATED_AT)->label('Submitted at'),
                Tables\Columns\TextColumn::make(Attributes::TIME)->label('Flight time'),
                Tables\Columns\TextColumn::make(Attributes::DATE)->label('Flight date'),
                Tables\Columns\BadgeColumn::make('service.name')->colors(['secondary', 'primary']),
                Tables\Columns\BadgeColumn::make('status.name')->colors([
                    'danger' => fn($state): bool => $state === 'Rejected',
                    'warning' => fn($state): bool => $state === 'Pending review',
                    'success' => fn($state): bool => $state === 'Approved',
                    'success' => fn($state): bool => $state === 'Paid',
                ])
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
