<?php
namespace App\Filament\Resources\FeePaymentResource\Pages;

use Illuminate\Support\Facades\Auth;
use App\Filament\Resources\FeePaymentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\StudentAccount;
use App\Models\FeePayment;

class CreateFeePayment extends CreateRecord
{
    protected static string $resource = FeePaymentResource::class;

    protected function handleRecordCreation(array $data): FeePayment
    {
         //normal insert
       $record =  static::getModel()::create($data);

       //credit amount
       $credit=$record->amount;

       //Fetch student account for credit update
       $studentAccount = StudentAccount::where('student_id', '=', $record->student_id)->get()->first();
       $studentAccount->balance=$studentAccount->balance+$credit; //update balance
       $studentAccount->credit=$studentAccount->credit+$credit; //update credit
       $studentAccount->save();

       return $record;
    }

    public function getTitle() : string
    {
        return 'Add a New Fee Payment';
    }
}
