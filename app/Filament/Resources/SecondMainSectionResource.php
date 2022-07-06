<?php

namespace App\Filament\Resources;

use App\Constants\AdminUserType;
use App\Constants\Attributes;
use App\Filament\Resources\SecondMainSectionResource\Pages;
use App\Filament\Resources\SecondMainSectionResource\RelationManagers;
use App\Models\SecondMainSection;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SecondMainSectionResource extends Resource
{
    protected static ?string $model = SecondMainSection::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = "Website Content";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make(Attributes::BACKGROUND_IMAGE),
                TextInput::make(Attributes::HEADING),
                TextInput::make(Attributes::PARAGRAPH),
                TextInput::make(Attributes::BULLET_POINTS),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make(Attributes::ID),
                TextColumn::make(Attributes::BACKGROUND_IMAGE),
                TextColumn::make(Attributes::HEADING),
                TextColumn::make(Attributes::PARAGRAPH),
                TextColumn::make(Attributes::BULLET_POINTS),
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
            'index' => Pages\ListSecondMainSections::route('/'),
            'create' => Pages\CreateSecondMainSection::route('/create'),
            'edit' => Pages\EditSecondMainSection::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        /** @var User $user */
        $user = auth()->user();
        return $user->canAccess(AdminUserType::SUPER_ADMIN) || $user->canAccess(AdminUserType::MODERATOR);
    }
}
