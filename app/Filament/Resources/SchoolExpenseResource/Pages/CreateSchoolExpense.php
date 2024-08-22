<?php

namespace App\Filament\Resources\SchoolExpenseResource\Pages;

use App\Filament\Resources\SchoolExpenseResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSchoolExpense extends CreateRecord
{
    protected static string $resource = SchoolExpenseResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function getTitle(): string
    {
        return 'Add New School Expense';
    }


}
