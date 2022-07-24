<?php

namespace App\Filament\Resources;

use App\Constants\Attributes;
use App\Filament\Resources\OurStoryContentResource\Pages;
use App\Filament\Resources\OurStoryContentResource\RelationManagers;
use App\Helpers;
use App\Models\OurStoryContent;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

class OurStoryContentResource extends Resource
{
    protected static ?string $model = OurStoryContent::class;

    protected static ?string $navigationLabel = 'Our Story';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = "Website Content";

    public static function form(Form $form): Form
    {
        return $form->schema([
            Tabs::make('Headning')
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
                        TextInput::make(Attributes::SUBHEADING_1)
                            ->required()
                            ->label(Helpers::readableText(Attributes::SUBHEADING)),
                    ])->columns(1),
                    Fieldset::make(Helpers::readableText(Attributes::SECTION_1))->schema([
                        TextInput::make(Attributes::HEADING_2)
                            ->required()
                            ->label(Helpers::readableText(Attributes::HEADING)),
                        Textarea::make(Attributes::PARAGRAPH_1)
                            ->required()
                            ->label(Helpers::readableText(Attributes::PARAGRAPH)),
                        Textarea::make(Attributes::QUOTE_1)
                            ->required()
                            ->label(Helpers::readableText(Attributes::QUOTE)),
                        FileUpload::make(Attributes::IMAGE_1)
                            ->image()
                            ->required()
                            ->label(Helpers::readableText(Attributes::IMAGE)),
                    ])->columns(1),
                    Fieldset::make(Helpers::readableText(Attributes::SECTION_2))->schema([
                        TextInput::make(Attributes::HEADING_3)
                            ->required()
                            ->label(Helpers::readableText(Attributes::HEADING)),
                        TextInput::make(Attributes::SUBHEADING_2)
                            ->required()
                            ->label(Helpers::readableText(Attributes::SUBHEADING)),
                    ])->columns(1),
                    Fieldset::make(Helpers::readableText(Attributes::SECTION_3))->schema([
                        TextInput::make(Attributes::HEADING_4)
                            ->required()
                            ->label(Helpers::readableText(Attributes::HEADING)),
                        Textarea::make(Attributes::PARAGRAPH_2)
                            ->required()
                            ->label(Helpers::readableText(Attributes::PARAGRAPH)),
                    ])->columns(1),
                    Fieldset::make(Helpers::readableText(Attributes::SECTION_4))->schema([
                        FileUpload::make(Attributes::IMAGE_2)
                            ->required()
                            ->label(Helpers::readableText(Attributes::IMAGE)),
                        Textarea::make(Attributes::PARAGRAPH_3)
                            ->required()
                            ->label(Helpers::readableText(Attributes::PARAGRAPH)),
                    ])->columns(1),
                    Fieldset::make(Helpers::readableText(Attributes::SECTION_5))->schema([
                        FileUpload::make(Attributes::BACKGROUND_IMAGE_2)
                            ->image()
                            ->required()
                            ->label(Helpers::readableText(Attributes::BACKGROUND_IMAGE)),
                        TextInput::make(Attributes::HEADING_5)
                            ->required()
                            ->label(Helpers::readableText(Attributes::HEADING)),
                        Textarea::make(Attributes::PARAGRAPH_4)
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
                    Fieldset::make(Helpers::readableText(Attributes::FOOTER))->schema([
                        FileUpload::make(Attributes::BACKGROUND_IMAGE_3)
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
                ])->columns(1)
            ])
        ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make(Attributes::BACKGROUND_IMAGE_1),
                ImageColumn::make(Attributes::BACKGROUND_IMAGE_2),
                ImageColumn::make(Attributes::BACKGROUND_IMAGE_3),
                ImageColumn::make(Attributes::IMAGE_1),
                ImageColumn::make(Attributes::IMAGE_2),
                TextColumn::make(Attributes::HEADING_TOP_1),
                TextColumn::make(Attributes::HEADING_TOP_2),
                TextColumn::make(Attributes::HEADING_1),
                TextColumn::make(Attributes::HEADING_2),
                TextColumn::make(Attributes::HEADING_3),
                TextColumn::make(Attributes::HEADING_4),
                TextColumn::make(Attributes::HEADING_5),
                TextColumn::make(Attributes::HEADING_6),
                TextColumn::make(Attributes::SUBHEADING_1),
                TextColumn::make(Attributes::SUBHEADING_2),
                TextColumn::make(Attributes::PARAGRAPH_1),
                TextColumn::make(Attributes::PARAGRAPH_2),
                TextColumn::make(Attributes::PARAGRAPH_3),
                TextColumn::make(Attributes::PARAGRAPH_4),
                TextColumn::make(Attributes::QUOTE_1),
                TextColumn::make(Attributes::COLUMN_1_HEADING_1),
                TextColumn::make(Attributes::COLUMN_1_PARAGRAPH_1),
                TextColumn::make(Attributes::COLUMN_2_HEADING_1),
                TextColumn::make(Attributes::COLUMN_2_PARAGRAPH_1),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListOurStoryContents::route('/'),
            'create' => Pages\CreateOurStoryContent::route('/create'),
            'edit' => Pages\EditOurStoryContent::route('/{record}/edit'),
        ];
    }
}
