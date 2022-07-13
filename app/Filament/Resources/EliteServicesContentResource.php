<?php

namespace App\Filament\Resources;

use App\Constants\Attributes;
use App\Constants\SectionTypes;
use App\Filament\Resources\EliteServicesContentResource\Pages;
use App\Filament\Resources\EliteServicesContentResource\RelationManagers;
use App\Models\EliteServicesContent;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EliteServicesContentResource extends Resource
{
    protected static ?string $model = EliteServicesContent::class;

    protected static ?string $navigationLabel = 'Elite Services';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = "Website Content";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make(Attributes::SECTION_TYPE)
                    ->options(SectionTypes::all())
                    ->reactive(),
                FileUpload::make(Attributes::BACKGROUND_IMAGE)
                    ->image()
                    ->visible(fn (Closure $get) => $get(Attributes::SECTION_TYPE) == SectionTypes::HEADER
                        || $get(Attributes::SECTION_TYPE) == SectionTypes::SECTION_2
                        || $get(Attributes::SECTION_TYPE) == SectionTypes::FOOTER)
                    ->required(),
                FileUpload::make(Attributes::SQUARE_IMAGE)->image()
                    ->visible(fn (Closure $get) => $get(Attributes::SECTION_TYPE) == SectionTypes::SECTION_3
                        || $get(Attributes::SECTION_TYPE) == SectionTypes::SECTION_4)
                    ->required(),
                FileUpload::make(Attributes::BIG_IMAGE)->image()
                    ->visible(fn (Closure $get) => $get(Attributes::SECTION_TYPE) == SectionTypes::SECTION_4)
                    ->required(),
                TextInput::make(Attributes::HEADING_TOP)
                    ->visible(fn (Closure $get) => $get(Attributes::SECTION_TYPE) == SectionTypes::HEADER
                        || $get(Attributes::SECTION_TYPE) == SectionTypes::FOOTER)
                    ->required(),
                TextInput::make(Attributes::HEADING)
                    ->visible(fn (Closure $get) => $get(Attributes::SECTION_TYPE) == SectionTypes::HEADER
                        || $get(Attributes::SECTION_TYPE) == SectionTypes::SECTION_1
                        || $get(Attributes::SECTION_TYPE) == SectionTypes::SECTION_2
                        || $get(Attributes::SECTION_TYPE) == SectionTypes::SECTION_3
                        || $get(Attributes::SECTION_TYPE) == SectionTypes::SECTION_4
                        || $get(Attributes::SECTION_TYPE) == SectionTypes::FOOTER)
                    ->required(),
                TextInput::make(Attributes::SUBHEADING)
                    ->visible(fn (Closure $get) => $get(Attributes::SECTION_TYPE) == SectionTypes::HEADER)
                    ->required(),
                Textarea::make(Attributes::PARAGRAPH)
                    ->visible(fn (Closure $get) => $get(Attributes::SECTION_TYPE) == SectionTypes::SECTION_1
                        || $get(Attributes::SECTION_TYPE) == SectionTypes::SECTION_2
                        || $get(Attributes::SECTION_TYPE) == SectionTypes::SECTION_3
                        || $get(Attributes::SECTION_TYPE) == SectionTypes::SECTION_4)
                    ->required(),
                TextInput::make(Attributes::TEXT)
                    ->visible(fn (Closure $get) => $get(Attributes::SECTION_TYPE) == SectionTypes::SECTION_3)
                    ->required(),
                Repeater::make(Attributes::BULLET_POINTS)->relationship("bulletPointsContent")
                    ->schema([
                        TextInput::make(Attributes::TEXT)
                            ->label(""),
                    ])
                    ->visible(fn (Closure $get) => $get(Attributes::SECTION_TYPE) == SectionTypes::SECTION_3)
                    ->required(),
                Checkbox::make(Attributes::HAS_BULLET_POINTS)
                    ->visible(fn (Closure $get) => $get(Attributes::SECTION_TYPE) == SectionTypes::SECTION_3)
                    ->default(true)
                    ->hidden(),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make(Attributes::SECTION_TYPE),
                ImageColumn::make(Attributes::BACKGROUND_IMAGE),
                ImageColumn::make(Attributes::IMAGE),
                ImageColumn::make(Attributes::SECTION_IMAGE),
                ImageColumn::make(Attributes::SQUARE_IMAGE),
                ImageColumn::make(Attributes::BIG_IMAGE),
                TextColumn::make(Attributes::HEADING_TOP),
                TextColumn::make(Attributes::HEADING),
                TextColumn::make(Attributes::SUBHEADING),
                TextColumn::make(Attributes::PARAGRAPH),
                TextColumn::make(Attributes::TEXT),
                ImageColumn::make(Attributes::HAS_BULLET_POINTS),
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
            'index' => Pages\ListEliteServicesContents::route('/'),
            'create' => Pages\CreateEliteServicesContent::route('/create'),
            'edit' => Pages\EditEliteServicesContent::route('/{record}/edit'),
        ];
    }
}
