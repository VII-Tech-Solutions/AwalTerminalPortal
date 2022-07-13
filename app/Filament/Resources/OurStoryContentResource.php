<?php

namespace App\Filament\Resources;

use App\Constants\Attributes;
use App\Constants\SectionTypes;
use App\Filament\Resources\OurStoryContentResource\Pages;
use App\Filament\Resources\OurStoryContentResource\RelationManagers;
use App\Models\OurStoryContent;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
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

class OurStoryContentResource extends Resource
{
    protected static ?string $model = OurStoryContent::class;

    protected static ?string $navigationLabel = 'Our Story';

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
                        || $get(Attributes::SECTION_TYPE) == SectionTypes::SECTION_5
                        || $get(Attributes::SECTION_TYPE) == SectionTypes::FOOTER)
                    ->required(),
                FileUpload::make(Attributes::IMAGE)->image()
                    ->visible(fn (Closure $get) => $get(Attributes::SECTION_TYPE) == SectionTypes::SECTION_1
                        || $get(Attributes::SECTION_TYPE) == SectionTypes::SECTION_4)
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
                        || $get(Attributes::SECTION_TYPE) == SectionTypes::SECTION_5
                        || $get(Attributes::SECTION_TYPE) == SectionTypes::FOOTER)
                    ->required(),
                TextInput::make(Attributes::SUBHEADING)
                    ->visible(fn (Closure $get) => $get(Attributes::SECTION_TYPE) == SectionTypes::HEADER
                        || $get(Attributes::SECTION_TYPE) == SectionTypes::SECTION_2)
                    ->required(),
                Textarea::make(Attributes::PARAGRAPH)
                    ->visible(fn (Closure $get) => $get(Attributes::SECTION_TYPE) == SectionTypes::SECTION_1
                        || $get(Attributes::SECTION_TYPE) == SectionTypes::SECTION_3
                        || $get(Attributes::SECTION_TYPE) == SectionTypes::SECTION_4
                        || $get(Attributes::SECTION_TYPE) == SectionTypes::SECTION_5)
                    ->required(),
                Textarea::make(Attributes::QUOTE)
                    ->visible(fn (Closure $get) => $get(Attributes::SECTION_TYPE) == SectionTypes::SECTION_1)
                    ->required(),
                TextInput::make(Attributes::COLUMN_1_HEADING)
                    ->visible(fn (Closure $get) => $get(Attributes::SECTION_TYPE) == SectionTypes::SECTION_5)
                    ->required(),
                Textarea::make(Attributes::COLUMN_1_PARAGRAPH)
                    ->visible(fn (Closure $get) => $get(Attributes::SECTION_TYPE) == SectionTypes::SECTION_5)
                    ->required(),
                TextInput::make(Attributes::COLUMN_2_HEADING)
                    ->visible(fn (Closure $get) => $get(Attributes::SECTION_TYPE) == SectionTypes::SECTION_5)
                    ->required(),
                Textarea::make(Attributes::COLUMN_2_PARAGRAPH)
                    ->visible(fn (Closure $get) => $get(Attributes::SECTION_TYPE) == SectionTypes::SECTION_5)
                    ->required(),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make(Attributes::SECTION_TYPE),
                ImageColumn::make(Attributes::BACKGROUND_IMAGE),
                ImageColumn::make(Attributes::IMAGE),
                TextColumn::make(Attributes::HEADING_TOP),
                TextColumn::make(Attributes::HEADING),
                TextColumn::make(Attributes::SUBHEADING),
                TextColumn::make(Attributes::PARAGRAPH),
                TextColumn::make(Attributes::QUOTE),
                TextColumn::make(Attributes::COLUMN_1_HEADING),
                TextColumn::make(Attributes::COLUMN_1_PARAGRAPH),
                TextColumn::make(Attributes::COLUMN_2_HEADING),
                TextColumn::make(Attributes::COLUMN_2_PARAGRAPH),
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
