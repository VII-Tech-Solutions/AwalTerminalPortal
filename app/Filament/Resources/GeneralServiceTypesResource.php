<?php

namespace App\Filament\Resources;

use App\Constants\AdminUserType;
use App\Constants\Attributes;
use App\Filament\Resources\GeneralServiceTypesResource\Pages;
use App\Filament\Resources\GeneralServiceTypesResource\RelationManagers;
use App\Models\FormServices;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class GeneralServiceTypesResource extends Resource
{
    protected static ?string $model = FormServices::class;

    protected static ?string $navigationIcon = 'heroicon-o-server';

    protected static ?string $navigationGroup = 'Metadata';

    protected static function getNavigationBadge(): ?string
    {
        return null;
    }

    protected static function shouldRegisterNavigation(): bool
    {
        /** @var User $user */
        $user = auth()->user();
        return $user->canAccess(AdminUserType::GA);
    }

    public static function canViewAny(): bool
    {
        /** @var User $user */
        $user = auth()->user();
        return $user->canAccess(AdminUserType::GA);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make(Attributes::NAME)->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make( Attributes::ID)->label("ID"),
                Tables\Columns\TextColumn::make( Attributes::NAME),

            ])
            ->filters([
                //
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
            'index' => Pages\ListGeneralServiceTypes::route('/'),
            'create' => Pages\CreateGeneralServiceTypes::route('/create'),
            'edit' => Pages\EditGeneralServiceTypes::route('/{record}/edit'),
        ];
    }
}
