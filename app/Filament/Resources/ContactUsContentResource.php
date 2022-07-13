<?php

namespace App\Filament\Resources;

use App\Constants\Attributes;
use App\Constants\SectionTypes;
use App\Filament\Resources\ContactUsContentResource\Pages;
use App\Filament\Resources\ContactUsContentResource\RelationManagers;
use App\Models\ContactUsContent;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactUsContentResource extends Resource
{
    protected static ?string $model = ContactUsContent::class;

    protected static ?string $navigationLabel = 'Contact Us';

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
                    ->visible(fn (Closure $get) => $get(Attributes::SECTION_TYPE) == SectionTypes::HEADER)
                    ->required(),
                TextInput::make(Attributes::HEADING_TOP)
                    ->visible(fn (Closure $get) => $get(Attributes::SECTION_TYPE) == SectionTypes::HEADER)
                    ->required(),
                TextInput::make(Attributes::HEADING)
                    ->visible(fn (Closure $get) => $get(Attributes::SECTION_TYPE) == SectionTypes::HEADER
                        || $get(Attributes::SECTION_TYPE) == SectionTypes::SECTION_1)
                    ->required(),
                TextInput::make(Attributes::SUBHEADING)
                    ->visible(fn (Closure $get) => $get(Attributes::SECTION_TYPE) == SectionTypes::HEADER)
                    ->required(),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make(Attributes::SECTION_TYPE),
                TextColumn::make(Attributes::BACKGROUND_IMAGE),
                TextColumn::make(Attributes::HEADING_TOP),
                TextColumn::make(Attributes::HEADING),
                TextColumn::make(Attributes::SUBHEADING),
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
            'index' => Pages\ListContactUsContents::route('/'),
            'create' => Pages\CreateContactUsContent::route('/create'),
            'edit' => Pages\EditContactUsContent::route('/{record}/edit'),
        ];
    }
}
