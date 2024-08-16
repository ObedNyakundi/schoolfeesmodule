<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Filament\Resources\StudentResource\RelationManagers;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Exports\StudentExporter;
use Filament\Tables\Actions\Action;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Students Management';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Student Details')
                ->description('Fill the new Student Details.')
                ->schema([
                     //Form for adding a student
                Forms\Components\TextInput::make('name') 
                    ->required()
                    ->label('Enter Name') 
                    ->maxLength(255)
                    ->placeholder('e.g. Obed Paul') 
                    ->columnSpan(2),
                Forms\Components\Select::make('stream_id') 
                    ->required()
                    ->relationship('stream', 'name')
                    ->preload()
                    ->searchable()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                        ->label('Class Name')
                        ->placeholder('e.g. Pre Primary 1')
                        ->required()
                        ->maxLength(255),
                        ])
                    ->columnSpan(2)
                    ->label('Select Class'),
                Forms\Components\TextInput::make('admission_number') 
                    ->required()
                    ->unique()
                    ->maxLength(15)
                    //->uppercase()
                    ->placeholder('e.g. XY1234'),
                ]),

               Forms\Components\Section::make('Guardian Details')
                ->description('Fill the new Student\'s Guardian Details.')
                ->schema([
                        Forms\Components\TextInput::make('guardian_name')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('e.g. Baba Obed') 
                            ->columnSpan(2),
                        Forms\Components\TextInput::make('guardian_phone')
                            ->required()
                            ->tel()
                            ->maxLength(10)
                            ->placeholder('e.g. 0701234567')
                            ->columnSpan(2),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('admission_number')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('stream.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('guardian_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('guardian_phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                ->label('Admitted on'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->headerActions([
                ExportAction::make('export')
                    ->exporter(StudentExporter::class),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
                ExportBulkAction::make('export')
                    ->exporter(StudentExporter::class),

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
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}
