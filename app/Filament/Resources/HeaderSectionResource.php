<?php

namespace App\Filament\Resources;

use App\Constants\AdminUserType;
use App\Constants\Attributes;
use App\Filament\Resources\DashboardResource\Pages;
use App\Filament\Resources\DashboardResource\RelationManagers;
use App\Models\HeaderSection;
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

class HeaderSectionResource extends Resource
{
    protected static ?string $model = HeaderSection::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = "Website Content";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make(Attributes::BACKGROUND_IMAGE),
                TextInput::make(Attributes::HEADING_TOP),
                TextInput::make(Attributes::HEADING),
                TextInput::make(Attributes::SUBHEADING),
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
            'index' => Pages\ListDashboards::route('/'),
            'create' => Pages\CreateDashboard::route('/create'),
            'edit' => Pages\EditDashboard::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        /** @var User $user */
        $user = auth()->user();
        return $user->canAccess(AdminUserType::SUPER_ADMIN) || $user->canAccess(AdminUserType::MODERATOR);
    }
}
