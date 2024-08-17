<?php

namespace App\Filament\Resources;

use Illuminate\Support\Facades\Auth;
use App\Filament\Resources\FeePaymentResource\Pages;
use App\Filament\Resources\FeePaymentResource\RelationManagers;
use App\Models\FeePayment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FeePaymentResource extends Resource
{
    protected static ?string $model = FeePayment::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationGroup = 'Fees Management';
    protected static ?int $navigationSort = 2;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('student_id') 
                    ->required()
                    ->relationship('student', 'name')
                    ->preload()
                    ->searchable()
                    ->columnSpan(2)
                    ->label('Student Name:'),

                Forms\Components\TextInput::make('amount') 
                    ->required()
                    ->label('Amount:') 
                    ->maxLength(10)
                    ->placeholder('e.g. 30000'),
                
                Forms\Components\Select::make('feestypes_id')
                    ->relationship('feestypes', 'name')
                    ->preload()
                    ->searchable()
                    ->createOptionForm([
                        Forms\Components\Textarea::make('name')
                        ->label('Fee Type')
                        ->placeholder('e.g. Tution fees')
                        ->required()
                        ->maxLength(255),
                        ])
                    ->label('Fee Type:')
                    ->required(),

            Forms\Components\Select::make('paymentmode_id')
                    ->relationship('paymentmode', 'name')
                    ->preload()
                    ->searchable()
                    ->createOptionForm([
                        Forms\Components\Textarea::make('name')
                        ->label('Fee Type')
                        ->placeholder('e.g. MPESA')
                        ->required()
                        ->maxLength(255),
                        ])
                    ->label('Payment Mode:')
                    ->required(),

            Forms\Components\Hidden::make('added_by')
                    ->default(Auth::user()->id)
                    ->required()
                    ->columnSpan(2),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.name') ->sortable(),
                Tables\Columns\TextColumn::make('student.stream.name') ->sortable(),
                Tables\Columns\TextColumn::make('feestypes.name') ->sortable(),
                Tables\Columns\TextColumn::make('amount'),
                Tables\Columns\TextColumn::make('created_at') ->dateTime() ->label('Payment Date') ->sortable(),
                Tables\Columns\TextColumn::make('paymentmode.name'),
                

            ])
            ->filters([
                //
            ])
            ->actions([
                /*Tables\Actions\EditAction::make(),*/
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
            'index' => Pages\ListFeePayments::route('/'),
            'create' => Pages\CreateFeePayment::route('/create'),
            //'edit' => Pages\EditFeePayment::route('/{record}/edit'),
        ];
    }
}
