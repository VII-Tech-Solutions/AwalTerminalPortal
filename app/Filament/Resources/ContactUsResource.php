<?php

namespace App\Filament\Resources;

use App\Constants\Attributes;
use App\Filament\Resources\ContactUsResource\Pages;
use App\Models\ContactUs;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class ContactUsResource extends Resource
{
    protected static ?string $model = ContactUs::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Contact Us';

    protected static ?string $navigationGroup = 'Submissions';

    protected static ?string $pluralLabel = 'Contact Us';

    protected static bool $shouldRegisterNavigation = true;

    protected static ?int $navigationSort = 3;

    protected static function getNavigationBadge(): ?string
    {
        if(env("FILAMENT_ENABLE_BADGE", false)){
            return null;
        }
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make(Attributes::FIRST_NAME)->required()->disabled(true),
                Forms\Components\TextInput::make(Attributes::LAST_NAME)->required()->disabled(true),
                Forms\Components\TextInput::make(Attributes::EMAIL)->required()->disabled(true),
                Forms\Components\Textarea::make(Attributes::MESSAGE)->required()->disabled(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make( Attributes::ID),
                Tables\Columns\TextColumn::make( Attributes::EMAIL),
                Tables\Columns\TextColumn::make( Attributes::MESSAGE),
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
            'index' => Pages\ListContactUs::route('/'),
            'view' => Pages\ViewContactUs::route('/{record}'),
//            'edit' => Pages\EditContactUs::route('/{record}/edit'),
        ];
    }
}
