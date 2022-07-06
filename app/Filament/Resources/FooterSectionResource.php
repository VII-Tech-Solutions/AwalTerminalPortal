<?php

namespace App\Filament\Resources;

use App\Constants\AdminUserType;
use App\Constants\Attributes;
use App\Filament\Resources\FooterSectionResource\Pages;
use App\Filament\Resources\FooterSectionResource\RelationManagers;
use App\Models\FooterSection;
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

class FooterSectionResource extends Resource
{
    protected static ?string $model = FooterSection::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = "Website Content";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make(Attributes::BACKGROUND_IMAGE),
                TextInput::make(Attributes::HEADING_TOP),
                TextInput::make(Attributes::HEADING),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make(Attributes::ID),
                TextColumn::make(Attributes::BACKGROUND_IMAGE),
                TextColumn::make(Attributes::HEADING_TOP),
                TextColumn::make(Attributes::HEADING),
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
            'index' => Pages\ListFooterSections::route('/'),
            'create' => Pages\CreateFooterSection::route('/create'),
            'edit' => Pages\EditFooterSection::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        /** @var User $user */
        $user = auth()->user();
        return $user->canAccess(AdminUserType::SUPER_ADMIN) || $user->canAccess(AdminUserType::MODERATOR);
    }
}
