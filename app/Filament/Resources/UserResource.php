<?php

namespace App\Filament\Resources;

use App\Constants\AdminUserType;
use App\Constants\Attributes;
use App\Filament\Resources\UserResource\Pages;
use App\Models\Country;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-s-user-group';

    protected static ?string $navigationLabel = 'Users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make(Attributes::NAME)->required(),
                Forms\Components\TextInput::make(Attributes::EMAIL)->email(true)->required(),
                Select::make(Attributes::USER_TYPE)
                    ->label('User type')
                    ->options([
                        AdminUserType::GA => 'General Aviation',
                        AdminUserType::ELITE_ONLY => 'Elite Services',
                        AdminUserType::SUPER_ADMIN => 'Admin',
                    ]),
                Forms\Components\TextInput::make(Attributes::PASSWORD)->default('123abC--')->visible(false)

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make( Attributes::ID),
                Tables\Columns\TextColumn::make( Attributes::NAME),
                Tables\Columns\TextColumn::make( Attributes::EMAIL),
                BadgeColumn::make(Attributes::USER_TYPE)
                    ->enum([
                        AdminUserType::GA => 'General Aviation',
                        AdminUserType::ELITE_ONLY => 'Elite Services',
                        AdminUserType::SUPER_ADMIN => 'Admin',
                    ])

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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
