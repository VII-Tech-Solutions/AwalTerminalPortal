<?php

namespace App\Filament\Resources;

use App\Constants\AdminUserType;
use App\Constants\Attributes;
use App\Filament\Resources\GeneralAviationServicesResource\Pages;
use App\Forms\Components\CustomFileUpload;
use App\Models\Airport;
use App\Models\Country;
use App\Models\GeneralAviationServices;
use App\Models\SubmissionStatus;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Filters\Layout;
use Filament\Tables\Filters\SelectFilter;

class GeneralAviationServicesResource extends Resource
{

    protected static ?string $model = GeneralAviationServices::class;

    protected static ?string $navigationIcon = 'ri-plane-fill';

    protected static ?string $navigationGroup = 'Submissions';

    protected static ?string $navigationLabel = 'General Aviation';

    protected static function getNavigationBadge(): ?string
    {
        if (env("FILAMENT_ENABLE_BADGE", false)) {
            return GeneralAviationServices::all()->where(Attributes::SUBMISSION_STATUS_ID, 1)->count();
        }
        return null;
    }

    protected static function shouldRegisterNavigation(): bool
    {
        /** @var User $user */
        $user = auth()->user();
        return $user->canAccess(AdminUserType::GA);
    }

    public static function canViewAny(): bool
    {
        /** @var User $user */
        $user = auth()->user();
        return $user->canAccess(AdminUserType::GA);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Tabs::make('Heading')
                    ->tabs([
                        Tabs\Tab::make('Information')
                            ->schema([
                                Select::make(Attributes::SUBMISSION_STATUS_ID)
                                    ->label('Form Status')
                                    ->options(SubmissionStatus::all()->whereNotIn('id', [2, 4])->pluck('name', 'id')),
                                Forms\Components\Textarea::make(Attributes::REJECTION_REASON),
                                Forms\Components\TextInput::make(Attributes::AIRCRAFT_TYPE)->required(),
                                Forms\Components\TextInput::make(Attributes::REGISTRATION_NUMBER)->numeric(true)->required(),
                                Forms\Components\TextInput::make(Attributes::MTOW)->numeric(true)->required(),
                                Forms\Components\TextInput::make(Attributes::LEAD_PASSENGER_NAME)->required(),
                                Forms\Components\Textarea::make(Attributes::LANDING_PURPOSE)->required(),
                            ]),
                        Tabs\Tab::make('Flight Information')
                            ->schema([
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
                            ]),
                        Tabs\Tab::make('Passengers')
                            ->schema([
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
                            ]),
                        Tabs\Tab::make('Services')
                            ->schema([
                                Fieldset::make('Required Services')->schema([
                                    Forms\Components\CheckboxList::make('services')->relationship('services', 'name'),
                                    Forms\Components\TextInput::make(Attributes::TRANSPORT_HOTEL_NAME),
                                    Forms\Components\TimePicker::make(Attributes::TRANSPORT_TIME),
                                ]),
                                Fieldset::make('Documents & Remarks')->schema([

                                    CustomFileUpload::make("attachments")->options(Country::all()->pluck('name', 'id')),

                                    Forms\Components\Repeater::make('newAttachments')->relationship('newAttachments')->schema([
                                        Forms\Components\TextInput::make(Attributes::FILE_LABEL),
                                        FileUpload::make(Attributes::PATH)
                                            ->disablePreview(false)
                                            ->maxFiles(1)
                                            ->maxSize(2000)
                                            ->preserveFilenames(false)
                                            ->enableDownload(true)
                                            ->label('Attachment')
                                            ->name(Attributes::FILE_LABEL)->removeUploadedFileButtonPosition('right')
                                            ->disableLabel()
                                    ]),

                                    Forms\Components\Textarea::make(Attributes::REMARKS),
                                ])->columns(1),
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
                Tables\Columns\TextColumn::make(Attributes::CREATED_AT)->label('Submitted at')->sortable(),
                Tables\Columns\TextColumn::make(Attributes::REGISTRATION_NUMBER),
                Tables\Columns\TextColumn::make(Attributes::ESTIMATED_TIME_OF_ARRIVAL),
                Tables\Columns\TextColumn::make(Attributes::LEAD_PASSENGER_NAME),
                Tables\Columns\TagsColumn::make('services.name')->label('Required Services'),
                Tables\Columns\BadgeColumn::make('status.name')->colors([
                    'warning' => fn($state): bool => $state === 'Pending review',
                    'success' => fn($state): bool => $state === 'Approved',
                ])->sortable()
            ])
            ->defaultSort(Attributes::CREATED_AT, 'desc')
            ->filters([
                //
                SelectFilter::make('status')->relationship('status', 'name')->options(SubmissionStatus::all()->whereNotIn('id', [2, 4])->pluck('name', 'id')),
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
            'index' => Pages\ListGeneralAviationServices::route('/'),
            'create' => Pages\CreateGeneralAviationServices::route('/create'),
            'edit' => Pages\EditGeneralAviationServices::route('/{record}/edit'),
        ];
    }
}
