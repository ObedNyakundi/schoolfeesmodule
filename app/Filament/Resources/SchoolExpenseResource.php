<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SchoolExpenseResource\Pages;
use App\Filament\Resources\SchoolExpenseResource\RelationManagers;
use App\Models\SchoolExpense;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SchoolExpenseResource extends Resource
{
    protected static ?string $model = SchoolExpense::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListSchoolExpenses::route('/'),
            'create' => Pages\CreateSchoolExpense::route('/create'),
            'edit' => Pages\EditSchoolExpense::route('/{record}/edit'),
        ];
    }
}
