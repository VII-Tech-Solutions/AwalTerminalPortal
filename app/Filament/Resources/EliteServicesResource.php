<?php

namespace App\Filament\Resources;

use App\Constants\AdminUserType;
use App\Constants\Attributes;
use App\Filament\Resources\EliteServicesResource\Pages;
use App\Filament\Resources\EliteServicesResource\RelationManagers;
use App\Helpers;
use App\Models\Airport;
use App\Models\Country;
use App\Models\EliteServices;
use App\Models\EliteServiceTypes;
use App\Models\SubmissionStatus;
use App\Models\User;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Filters\Layout;
use Filament\Tables\Filters\SelectFilter;


class EliteServicesResource extends Resource
{
    protected static ?string $model = EliteServices::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';

    protected static ?string $navigationGroup = 'Submissions';

    protected static function getNavigationBadge(): ?string
    {
        if (env("FILAMENT_ENABLE_BADGE", false)) {
            return EliteServices::all()->where(Attributes::SUBMISSION_STATUS_ID, 1)->count();
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
        $user = auth()->user();
        $rejected_id = SubmissionStatus::where(Attributes::NAME, 'Rejected')->first()->id;
//        dd($rejected_id);
        return $form
            ->schema([
                //

                Fieldset::make('Payment Information')->schema([

                    TextInput::make(Attributes::TOTAL)
                        ->numeric()
                        ->suffix('BHD')
                        ->label(Helpers::readableText(Attributes::TOTAL_PRICE))->disabled(!$user->canAccess(AdminUserType::SUPER_ADMIN)),

                    Select::make(Attributes::OFFLINE_PAYMENT_METHOD)
                        ->label('Offline Payment Method')
                        ->options(['Cash' => 'Cash',
                            'Card' => 'Card',
                            'Cheque' => 'Cheque',
                            'Bank transfer' => 'Bank transfer'])->visible(),
                    Forms\Components\Textarea::make(Attributes::PAYMENT_NOTES)->columns(1),
                ]),
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
                                        ->searchable()
                                        ->reactive(),
                                    Forms\Components\Textarea::make(Attributes::REJECTION_REASON)->columns(1)
                                    ->visible(fn (Closure $get) => $get(Attributes::SUBMISSION_STATUS_ID) == $rejected_id),
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
                                Forms\Components\Repeater::make('passengers')->relationship('passengers')->schema([
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
                                Forms\Components\Repeater::make('booker')->relationship('booker')->schema([
                                    Forms\Components\TextInput::make(Attributes::FIRST_NAME)->required(),
                                    Forms\Components\TextInput::make(Attributes::LAST_NAME)->required(),
                                    Forms\Components\TextInput::make(Attributes::EMAIL)->required(),
                                    Forms\Components\TextInput::make(Attributes::MOBILE_NUMBER)->required(),
                                ])->maxItems(1)->columns(1)
                            ]),
                    ]),

                    Forms\Components\Repeater::make('transactions')->relationship('transactions')
                        ->schema([
                            Forms\Components\TextInput::make(Attributes::ORDER_ID)->disabled(),
                            Forms\Components\TextInput::make(Attributes::AMOUNT)->disabled(),
                            Forms\Components\TextInput::make(Attributes::PAYMENT_PROVIDER)->disabled(),
                        ])
                        ->columns(3)
                        ->label('Transaction Details')->disabled(),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make(Attributes::ID)->label("ID"),
                Tables\Columns\TextColumn::make(Attributes::CREATED_AT)->label('Submitted at')->sortable(),
                Tables\Columns\TextColumn::make(Attributes::TIME)->label('Flight time'),
                Tables\Columns\TextColumn::make(Attributes::DATE)->label('Flight date'),
                Tables\Columns\BadgeColumn::make('service.name')->colors(['secondary', 'primary']),
                Tables\Columns\BadgeColumn::make('status.name')->colors([
                    'danger' => fn($state): bool => $state === 'Rejected',
                    'warning' => fn($state): bool => $state === 'Pending review',
                    'success' => fn($state): bool => $state === 'Approved',
                    'success' => fn($state): bool => $state === 'Paid',
                ])->sortable()
            ])
            ->defaultSort(Attributes::CREATED_AT, 'desc')
            ->filters([
                //
                SelectFilter::make('status')->relationship('status', 'name'),
            ], layout: Layout::AboveContent);
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
