<?php

namespace App\Filament\Resources\FeePaymentResource\Pages;

use Illuminate\Support\Facades\Auth;
use App\Filament\Resources\FeePaymentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\StudentAccount;

class CreateFeePayment extends CreateRecord
{
    protected static string $resource = FeePaymentResource::class;

    /* protected function handleRecordCreation(array $data): FeePayment
    {
         //normal insert
       $record =  static::getModel()::create($data);

    }*/

    public function getTitle() : string
    {
        return 'Add a New Fee Payment';
    }
}
