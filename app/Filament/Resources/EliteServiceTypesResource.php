<?php

namespace App\Filament\Resources;

use App\Constants\AdminUserType;
use App\Constants\Attributes;
use App\Filament\Resources\EliteServiceTypesResource\Pages;
use App\Filament\Resources\EliteServiceTypesResource\RelationManagers;
use App\Models\EliteServiceTypes;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class EliteServiceTypesResource extends Resource
{
    protected static ?string $model = EliteServiceTypes::class;

    protected static ?string $navigationIcon = 'heroicon-o-dots-circle-horizontal';

    protected static ?string $navigationGroup = 'Elite Services Metadata';

    protected static function getNavigationBadge(): ?string
    {
        if(env("FILAMENT_ENABLE_BADGE", false)){
            return static::getModel()::count();
        }
        return null;
    }

    protected static function shouldRegisterNavigation(): bool
    {
        /** @var User $user */
        $user = auth()->user();
        return $user->canAccess(AdminUserType::ELITE_ONLY);
    }

    public static function canViewAny(): bool
    {
        /** @var User $user */
        $user = auth()->user();
        return $user->canAccess(AdminUserType::ELITE_ONLY);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make(Attributes::NAME)->required(),
                Forms\Components\TextInput::make(Attributes::PRICE_PER_ADULT)->numeric(true)->required()->label("Price per adult in BHD:"),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make(Attributes::ID),
                Tables\Columns\TextColumn::make(Attributes::NAME),

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
            'index' => Pages\ListEliteServiceTypes::route('/'),
            'create' => Pages\CreateEliteServiceTypes::route('/create'),
            'edit' => Pages\EditEliteServiceTypes::route('/{record}/edit'),
        ];
    }
}
