<?php

namespace App\Filament\Resources;

use App\Constants\Attributes;
use App\Filament\Resources\ContactUsContentResource\Pages;
use App\Filament\Resources\ContactUsContentResource\RelationManagers;
use App\Helpers;
use App\Models\ContactUsContent;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;

class ContactUsContentResource extends Resource
{
    protected static ?string $model = ContactUsContent::class;

    protected static ?string $navigationLabel = '';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = "Website Content";

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $modelLabel = "Contact us page content";

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
                                TextInput::make(Attributes::HEADING_2)
                                    ->required()
                                    ->label(Helpers::readableText(Attributes::HEADING)),
                            ])->columns(1),

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
            'index' => Pages\ListContactUsContents::route('/'),
            'create' => Pages\CreateContactUsContent::route('/create'),
            'edit' => Pages\EditContactUsContent::route('/{record}/edit'),
        ];
    }
}
