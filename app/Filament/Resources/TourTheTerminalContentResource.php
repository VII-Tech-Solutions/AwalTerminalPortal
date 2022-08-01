<?php

namespace App\Filament\Resources;

use App\Constants\Attributes;
use App\Filament\Resources\TourTheTerminalContentResource\Pages;
use App\Filament\Resources\TourTheTerminalContentResource\RelationManagers;
use App\Helpers;
use App\Models\TourTheTerminalContent;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;

class TourTheTerminalContentResource extends Resource
{
    protected static ?string $model = TourTheTerminalContent::class;

    protected static ?string $navigationLabel = '';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = "Website Content";

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $modelLabel = "Tour page content";

    protected static ?string $pluralModelLabel = "";

    protected static ?string $breadcrumb = '';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Tabs::make('Heading')
                ->tabs([
                    Tab::make("Information")
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
                                FileUpload::make(Attributes::IMAGE_1)
                                    ->image()
                                    ->required()
                                    ->label(Helpers::readableText(Attributes::IMAGE)),
                            ])->columns(1),
                            Fieldset::make(Helpers::readableText(Attributes::SECTION_2))->schema([
                                TextInput::make(Attributes::HEADING_2)
                                    ->required()
                                    ->label(Helpers::readableText(Attributes::HEADING)),
                                Textarea::make(Attributes::PARAGRAPH_1)
                                    ->required()
                                    ->label(Helpers::readableText(Attributes::PARAGRAPH)),
                                Repeater::make(Attributes::OUR_PHOTO_GALLERY)
                                    ->relationship("OurPhotoGallery")
                                    ->schema([
                                        FileUpload::make(Attributes::IMAGE)->image(),
                                        TextInput::make(Attributes::CAPTION)
                                    ])->label(Helpers::readableText(Attributes::IMAGE_GALLERY))
                            ])->columns(1),
                            Fieldset::make(Helpers::readableText(Attributes::SECTION_3))->schema([
                                Forms\Components\Toggle::make(Attributes::VISIBLE_1)->label("Visible"),
                                TextInput::make(Attributes::HEADING_3)
                                    ->required()
                                    ->label(Helpers::readableText(Attributes::HEADING)),
                                Textarea::make(Attributes::PARAGRAPH_2)
                                    ->required()
                                    ->label(Helpers::readableText(Attributes::PARAGRAPH)),

                                Textarea::make(Attributes::VIDEO_1)
                            ])->columns(1),
                            Fieldset::make(Helpers::readableText(Attributes::SECTION_4))->schema([
                                TextInput::make(Attributes::HEADING_4)
                                    ->required()
                                    ->label(Helpers::readableText(Attributes::HEADING)),
                                Textarea::make(Attributes::PARAGRAPH_3)
                                    ->required()
                                    ->label(Helpers::readableText(Attributes::PARAGRAPH)),
                                Repeater::make(Attributes::PRIVATE_AND_PERSONAL_GALLERY)
                                    ->relationship("PrivateAndPersonalGallery")
                                    ->schema([
                                        FileUpload::make(Attributes::IMAGE)->image(),
                                        TextInput::make(Attributes::CAPTION)
                                    ])->label(Helpers::readableText(Attributes::IMAGE_GALLERY))
                            ])->columns(1),
                            Fieldset::make(Helpers::readableText(Attributes::FOOTER))->schema([
                                FileUpload::make(Attributes::BACKGROUND_IMAGE_2)
                                    ->image()
                                    ->required()
                                    ->label(Helpers::readableText(Attributes::BACKGROUND_IMAGE)),
                                TextInput::make(Attributes::HEADING_TOP_2)
                                    ->required()
                                    ->label(Helpers::readableText(Attributes::HEADING_TOP)),
                                TextInput::make(Attributes::HEADING_5)
                                    ->required()
                                    ->label(Helpers::readableText(Attributes::HEADING)),
                            ])->columns(1)
                        ])->columns(1)
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
            'index' => Pages\ListTourTheTerminalContents::route('/'),
//            'create' => Pages\CreateTourTheTerminalContent::route('/create'),
            'edit' => Pages\EditTourTheTerminalContent::route('/{record}/edit'),
        ];
    }
}
