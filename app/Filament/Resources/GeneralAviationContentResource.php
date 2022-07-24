<?php

namespace App\Filament\Resources;

use App\Constants\Attributes;
use App\Constants\SectionTypes;
use App\Filament\Resources\GeneralAviationContentResource\Pages;
use App\Filament\Resources\GeneralAviationContentResource\RelationManagers;
use App\Helpers;
use App\Models\GeneralAviationContent;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GeneralAviationContentResource extends Resource
{
    protected static ?string $model = GeneralAviationContent::class;

    protected static ?string $navigationLabel = 'General Aviation';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = "Website Content";

    public static function form(Form $form): Form
    {
//        return $form
//            ->schema([
//                Select::make(Attributes::SECTION_TYPE)
//                    ->options(SectionTypes::all())
//                    ->reactive(),
//                FileUpload::make(Attributes::BACKGROUND_IMAGE)
//                    ->image()
//                    ->visible(fn (Closure $get) => $get(Attributes::SECTION_TYPE) == SectionTypes::HEADER
//                        || $get(Attributes::SECTION_TYPE) == SectionTypes::FOOTER)
//                    ->required(),
//                FileUpload::make(Attributes::SQUARE_IMAGE)->image()
//                    ->visible(fn (Closure $get) => $get(Attributes::SECTION_TYPE) == SectionTypes::SECTION_1
//                        || $get(Attributes::SECTION_TYPE) == SectionTypes::SECTION_2)
//                    ->required(),
//                FileUpload::make(Attributes::SECTION_IMAGE)->image()
//                    ->visible(fn (Closure $get) => $get(Attributes::SECTION_TYPE) == SectionTypes::SECTION_3)
//                    ->required(),
//                FileUpload::make(Attributes::IMAGE)->image()
//                    ->visible(fn (Closure $get) => $get(Attributes::SECTION_TYPE) == SectionTypes::SECTION_5)
//                    ->required(),
//                FileUpload::make(Attributes::BIG_IMAGE)->image()
//                    ->visible(fn (Closure $get) => $get(Attributes::SECTION_TYPE) == SectionTypes::SECTION_1)
//                    ->required(),
//                TextInput::make(Attributes::HEADING_TOP)
//                    ->visible(fn (Closure $get) => $get(Attributes::SECTION_TYPE) == SectionTypes::HEADER
//                        || $get(Attributes::SECTION_TYPE) == SectionTypes::FOOTER)
//                    ->required(),
//                TextInput::make(Attributes::HEADING)
//                    ->visible(fn (Closure $get) => $get(Attributes::SECTION_TYPE) == SectionTypes::HEADER
//                        || $get(Attributes::SECTION_TYPE) == SectionTypes::SECTION_1
//                        || $get(Attributes::SECTION_TYPE) == SectionTypes::SECTION_2
//                        || $get(Attributes::SECTION_TYPE) == SectionTypes::SECTION_4
//                        || $get(Attributes::SECTION_TYPE) == SectionTypes::SECTION_5
//                        || $get(Attributes::SECTION_TYPE) == SectionTypes::FOOTER)
//                    ->required(),
//                TextInput::make(Attributes::SUBHEADING)
//                    ->visible(fn (Closure $get) => $get(Attributes::SECTION_TYPE) == SectionTypes::HEADER)
//                    ->required(),
//                Textarea::make(Attributes::PARAGRAPH)
//                    ->visible(fn (Closure $get) => $get(Attributes::SECTION_TYPE) == SectionTypes::SECTION_1
//                        || $get(Attributes::SECTION_TYPE) == SectionTypes::SECTION_2
//                        || $get(Attributes::SECTION_TYPE) == SectionTypes::SECTION_4
//                        || $get(Attributes::SECTION_TYPE) == SectionTypes::SECTION_5)
//                    ->required(),
//                TextInput::make(Attributes::TEXT)
//                    ->visible(fn (Closure $get) => $get(Attributes::SECTION_TYPE) == SectionTypes::SECTION_2)
//                    ->required(),
//                Repeater::make(Attributes::BULLET_POINTS)->relationship("bulletPointsContent")
//                    ->schema([
//                        TextInput::make(Attributes::TEXT)
//                            ->label(""),
//                    ])
//                    ->visible(fn (Closure $get) => $get(Attributes::SECTION_TYPE) == SectionTypes::SECTION_2)
//                    ->required(),
//                Checkbox::make(Attributes::HAS_BULLET_POINTS)
//                    ->visible(fn (Closure $get) => $get(Attributes::SECTION_TYPE) == SectionTypes::SECTION_2)
//                    ->default(true)
//                    ->hidden(),
//            ])->columns(1);

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
                        TextInput::make(Attributes::SUBHEADING_1)
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
                        Textarea::make(Attributes::PARAGRAPH_2)
                            ->required()
                            ->label(Helpers::readableText(Attributes::PARAGRAPH)),
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
                        TextInput::make(Attributes::TEXT_1)
                            ->required()
                            ->label(Helpers::readableText(Attributes::TEXT)),
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
                        Textarea::make(Attributes::PARAGRAPH_3)
                            ->required()
                            ->label(Helpers::readableText(Attributes::PARAGRAPH)),
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
                ImageColumn::make(Attributes::BACKGROUND_IMAGE_1),
                ImageColumn::make(Attributes::BACKGROUND_IMAGE_2),
                ImageColumn::make(Attributes::IMAGE_1),
                ImageColumn::make(Attributes::SECTION_IMAGE_1),
                ImageColumn::make(Attributes::SQUARE_IMAGE_1),
                ImageColumn::make(Attributes::SQUARE_IMAGE_2),
                ImageColumn::make(Attributes::BIG_IMAGE_1),
                TextColumn::make(Attributes::HEADING_TOP_1),
                TextColumn::make(Attributes::HEADING_TOP_2),
                TextColumn::make(Attributes::HEADING_1),
                TextColumn::make(Attributes::HEADING_2),
                TextColumn::make(Attributes::HEADING_3),
                TextColumn::make(Attributes::HEADING_4),
                TextColumn::make(Attributes::HEADING_5),
                TextColumn::make(Attributes::HEADING_6),
                TextColumn::make(Attributes::SUBHEADING_1),
                TextColumn::make(Attributes::PARAGRAPH_1),
                TextColumn::make(Attributes::PARAGRAPH_2),
                TextColumn::make(Attributes::PARAGRAPH_3),
                TextColumn::make(Attributes::PARAGRAPH_4),
                TextColumn::make(Attributes::TEXT_1),
                TextColumn::make(Attributes::BULLET_POINT_1),
                TextColumn::make(Attributes::BULLET_POINT_2),
                TextColumn::make(Attributes::BULLET_POINT_3),
                TextColumn::make(Attributes::BULLET_POINT_4),
                TextColumn::make(Attributes::BULLET_POINT_5),
                TextColumn::make(Attributes::BULLET_POINT_6),
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
            'index' => Pages\ListGeneralAviationContents::route('/'),
            'create' => Pages\CreateGeneralAviationContent::route('/create'),
            'edit' => Pages\EditGeneralAviationContent::route('/{record}/edit'),
        ];
    }
}
