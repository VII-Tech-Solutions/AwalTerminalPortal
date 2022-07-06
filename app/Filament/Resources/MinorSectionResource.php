<?php

namespace App\Filament\Resources;

use App\Constants\AdminUserType;
use App\Constants\Attributes;
use App\Filament\Resources\MinorSectionResource\Pages;
use App\Filament\Resources\MinorSectionResource\RelationManagers;
use App\Models\MinorSection;
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

class MinorSectionResource extends Resource
{
    protected static ?string $model = MinorSection::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = "Website Content";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make(Attributes::IMAGE),
                TextInput::make(Attributes::PARAGRAPH),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make(Attributes::IMAGE),
                TextColumn::make(Attributes::PARAGRAPH),
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
            'index' => Pages\ListMinorSections::route('/'),
            'create' => Pages\CreateMinorSection::route('/create'),
            'edit' => Pages\EditMinorSection::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        /** @var User $user */
        $user = auth()->user();
        return $user->canAccess(AdminUserType::SUPER_ADMIN) || $user->canAccess(AdminUserType::MODERATOR);
    }
}
