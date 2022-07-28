<?php

namespace App\Filament\Resources;

use App\Constants\Attributes;
use App\Filament\Resources\GeneralAviationContentResource\Pages;
use App\Filament\Resources\GeneralAviationContentResource\RelationManagers;
use App\Helpers;
use App\Models\GeneralAviationContent;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;

class GeneralAviationContentResource extends Resource
{
    protected static ?string $model = GeneralAviationContent::class;

    protected static ?string $navigationLabel = '';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = "Website Content";

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $modelLabel = "General aviation page content";

    protected static ?string $pluralModelLabel = "";

    protected static ?string $breadcrumb = '';


    public static function form(Form $form): Form
    {
        return $form->schema([
            Tabs::make("Heading")
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
                                FileUpload::make(Attributes::SQUARE_IMAGE_1)
                                    ->image()
                                    ->required()
                                    ->label(Helpers::readableText(Attributes::SQUARE_IMAGE)),
                                FileUpload::make(Attributes::BIG_IMAGE_1)
                                    ->image()
                                    ->required()
                                    ->label(Helpers::readableText(Attributes::BIG_IMAGE)),
                                TextInput::make(Attributes::HEADING_2)
                                    ->required()
                                    ->label(Helpers::readableText(Attributes::HEADING)),
                                Textarea::make(Attributes::PARAGRAPH_1)
                                    ->required()
                                    ->label(Helpers::readableText(Attributes::PARAGRAPH)),
                            ])->columns(1),
                            Fieldset::make(Helpers::readableText(Attributes::SECTION_2))->schema([
                                FileUpload::make(Attributes::SQUARE_IMAGE_2)
                                    ->image()
                                    ->required()
                                    ->label(Helpers::readableText(Attributes::SQUARE_IMAGE)),
                                TextInput::make(Attributes::HEADING_3)
                                    ->required()
                                    ->label(Helpers::readableText(Attributes::HEADING)),
                                RichEditor::make(Attributes::PARAGRAPH_2)
                                    ->required()
                                    ->label(Helpers::readableText(Attributes::PARAGRAPH))
                                    ->toolbarButtons([
                                        'bold',
                                        'edit',
                                        'italic',
                                        'link',
                                        'preview',
                                        'strike',
                                    ]),
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
                                RichEditor::make(Attributes::TEXT_1)
                                    ->required()
                                    ->label(Helpers::readableText(Attributes::TEXT))
                                    ->toolbarButtons([
                                        'bold',
                                        'edit',
                                        'italic',
                                        'link',
                                        'preview',
                                        'strike',
                                    ]),
                            ])->columns(1),
                            Fieldset::make(Helpers::readableText(Attributes::SECTION_3))->schema([
                                FileUpload::make(Attributes::SECTION_IMAGE_1)
                                    ->image()
                                    ->required()
                                    ->label(Helpers::readableText(Attributes::SECTION_IMAGE)),
                            ])->columns(1),
                            Fieldset::make(Helpers::readableText(Attributes::SECTION_4))->schema([
                                TextInput::make(Attributes::HEADING_4)
                                    ->required()
                                    ->label(Helpers::readableText(Attributes::HEADING)),
                                RichEditor::make(Attributes::PARAGRAPH_3)
                                    ->required()
                                    ->label(Helpers::readableText(Attributes::PARAGRAPH))
                                    ->toolbarButtons([
                                        'bold',
                                        'edit',
                                        'italic',
                                        'link',
                                        'preview',
                                        'strike',
                                    ]),
                            ])->columns(1),
                            Fieldset::make(Helpers::readableText(Attributes::SECTION_5))->schema([
                                FileUpload::make(Attributes::IMAGE_1)
                                    ->image()
                                    ->required()
                                    ->label(Helpers::readableText(Attributes::IMAGE)),
                                TextInput::make(Attributes::HEADING_5)
                                    ->required()
                                    ->label(Helpers::readableText(Attributes::HEADING)),
                                Textarea::make(Attributes::PARAGRAPH_4)
                                    ->required()
                                    ->label(Helpers::readableText(Attributes::PARAGRAPH)),
                            ])->columns(1),
                            Fieldset::make(Helpers::readableText(Attributes::FOOTER))->schema([
                                FileUpload::make(Attributes::BACKGROUND_IMAGE_2)
                                    ->image()
                                    ->required()
                                    ->label(Helpers::readableText(Attributes::BACKGROUND_IMAGE)),
                                TextInput::make(Attributes::HEADING_TOP_2)
                                    ->required()
                                    ->label(Helpers::readableText(Attributes::HEADING_TOP)),
                                TextInput::make(Attributes::HEADING_6)
                                    ->required()
                                    ->label(Helpers::readableText(Attributes::HEADING)),
                            ])->columns(1)
                        ])->columns(1),
                ]),
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
            'index' => Pages\ListGeneralAviationContents::route('/'),
            'edit' => Pages\EditGeneralAviationContent::route('/{record}/edit'),
        ];
    }
}
