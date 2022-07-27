<?php

namespace App\Filament\Resources;

use App\Constants\Attributes;
use App\Filament\Resources\ServicesContentResource\Pages;
use App\Filament\Resources\ServicesContentResource\RelationManagers;
use App\Helpers;
use App\Models\ServicesContent;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;

class ServicesContentResource extends Resource
{
    protected static ?string $model = ServicesContent::class;

    protected static ?string $navigationLabel = '';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = "Website Content";

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $modelLabel = "Services page content";

    protected static ?string $pluralModelLabel = "";

    protected static ?string $breadcrumb = '';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Tabs::make('Heading')
                ->tabs([
                    Tab::make('Information')
                        ->schema([
                            Fieldset::make(Helpers::readableText(Attributes::HEADER))->schema([
                                FileUpload::make(Attributes::BACKGROUND_IMAGE_1)
                                    ->image()
                                    ->required()
                                    ->label(Helpers::readableText(Attributes::BACKGROUND_IMAGE)),
                                TextInput::make(Attributes::HEADING_TOP_1)
                                    ->required()
                                    ->label(Helpers::readableText(Attributes::HEADING_TOP)),
                                TextInput::make(Attributes::HEADING_1)
                                    ->required()
                                    ->label(Helpers::readableText(Attributes::HEADING)),
                                Textarea::make(Attributes::SUBHEADING_1)
                                    ->required()
                                    ->label(Helpers::readableText(Attributes::SUBHEADING)),
                            ])->columns(1),
                            Fieldset::make(Helpers::readableText(Attributes::SECTION_1))->schema([
                                FileUpload::make(Attributes::BACKGROUND_IMAGE_2)
                                    ->image()
                                    ->required()
                                    ->label(Helpers::readableText(Attributes::BACKGROUND_IMAGE)),
                                TextInput::make(Attributes::HEADING_2)
                                    ->required()
                                    ->label(Helpers::readableText(Attributes::HEADING)),
                                Textarea::make(Attributes::PARAGRAPH_1)
                                    ->required()
                                    ->label(Helpers::readableText(Attributes::PARAGRAPH)),
                                TextInput::make(Attributes::COLUMN_1_HEADING_1)
                                    ->required()
                                    ->label(Helpers::readableText(Attributes::COLUMN_1_HEADING)),
                                Textarea::make(Attributes::COLUMN_1_PARAGRAPH_1)
                                    ->required()
                                    ->label(Helpers::readableText(Attributes::COLUMN_1_PARAGRAPH)),
                                TextInput::make(Attributes::COLUMN_2_HEADING_1)
                                    ->required()
                                    ->label(Helpers::readableText(Attributes::COLUMN_2_HEADING)),
                                Textarea::make(Attributes::COLUMN_2_PARAGRAPH_1)
                                    ->required()
                                    ->label(Helpers::readableText(Attributes::COLUMN_2_PARAGRAPH)),
                            ])->columns(1),
                            Fieldset::make(Helpers::readableText(Attributes::SECTION_2))->schema([
                                TextInput::make(Attributes::HEADING_3)
                                    ->required()
                                    ->label(Helpers::readableText(Attributes::HEADING)),
                                TextInput::make(Attributes::BULLET_POINT_1)
                                    ->required()
                                    ->label(Helpers::readableText(Attributes::BULLET_POINT_1)),
                                TextInput::make(Attributes::BULLET_POINT_2)
                                    ->required()
                                    ->label(Helpers::readableText(Attributes::BULLET_POINT_2)),
                                TextInput::make(Attributes::BULLET_POINT_3)
                                    ->required()
                                    ->label(Helpers::readableText(Attributes::BULLET_POINT_3)),
                                TextInput::make(Attributes::BULLET_POINT_4)
                                    ->required()
                                    ->label(Helpers::readableText(Attributes::BULLET_POINT_4)),
                                TextInput::make(Attributes::BULLET_POINT_5)
                                    ->required()
                                    ->label(Helpers::readableText(Attributes::BULLET_POINT_5)),
                                TextInput::make(Attributes::BULLET_POINT_6)
                                    ->required()
                                    ->label(Helpers::readableText(Attributes::BULLET_POINT_6)),
                                TextInput::make(Attributes::BULLET_POINT_7)
                                    ->required()
                                    ->label(Helpers::readableText(Attributes::BULLET_POINT_7)),
                                TextInput::make(Attributes::BULLET_POINT_8)
                                    ->required()
                                    ->label(Helpers::readableText(Attributes::BULLET_POINT_8)),
                            ])->columns(1),
                            Fieldset::make(Helpers::readableText(Attributes::FOOTER))->schema([
                                FileUpload::make(Attributes::BACKGROUND_IMAGE_3)
                                    ->image()
                                    ->required()
                                    ->label(Helpers::readableText(Attributes::BACKGROUND_IMAGE)),
                                TextInput::make(Attributes::HEADING_TOP_2)
                                    ->required()
                                    ->label(Helpers::readableText(Attributes::HEADING_TOP)),
                                TextInput::make(Attributes::HEADING_4)
                                    ->required()
                                    ->label(Helpers::readableText(Attributes::HEADING)),
                            ])->columns(1)
                        ])->columns(1),
                ])
        ])->columns(1);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            ])
            ->filters([
                //
            ])
            ->actions([
            ])
            ->bulkActions([
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
            'index' => Pages\ListServicesContents::route('/'),
            'edit' => Pages\EditServicesContent::route('/{record}/edit'),
        ];
    }
}
