<?php

namespace App\Filament\Resources;

use App\Constants\AdminUserType;
use App\Constants\Attributes;
use App\Filament\Resources\ImageSectionResource\Pages;
use App\Filament\Resources\ImageSectionResource\RelationManagers;
use App\Models\ImageSection;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ImageSectionResource extends Resource
{
    protected static ?string $model = ImageSection::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = "Website Content";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextColumn::make(Attributes::SECTION_IMAGE)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make(Attributes::SECTION_IMAGE)
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
            'index' => Pages\ListImageSections::route('/'),
            'create' => Pages\CreateImageSection::route('/create'),
            'edit' => Pages\EditImageSection::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        /** @var User $user */
        $user = auth()->user();
        return $user->canAccess(AdminUserType::SUPER_ADMIN) || $user->canAccess(AdminUserType::MODERATOR);
    }
}
