<?php

namespace App\Filament\Resources\StudentResource\Pages;

use App\Filament\Resources\StudentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Tab;
use Illuminate\Database\Eloquent\Builder;

use App\Models\Student;

class ListStudents extends ListRecords
{
    protected static string $resource = StudentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'All' => Tab::make()
            ->badge(Student::count()),

            'With Fee Balance' => Tab::make()
            ->modifyQueryUsing(fn (Builder $query): Builder => $query->whereHas('studentAccount', fn (Builder $query) => $query->where('balance', '<', 0)))
            ->badge(Student::query()->whereHas('studentAccount', fn (Builder $query) => $query->where('balance', '<', 0))->count()),

            'Without Fee Balance' => Tab::make()
            ->modifyQueryUsing(fn (Builder $query): Builder => $query->whereHas('studentAccount', fn (Builder $query) => $query->where('balance', '>', -1)))
            ->badge(Student::query()->whereHas('studentAccount', fn (Builder $query) => $query->where('balance', '>', -1))->count()),

            ];
        
    }
}
