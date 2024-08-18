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

    //modify form data before create
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        //if it is a correction, multiply by negative 1 before insert
        if($data['is_correction']){
            $data['amount']=$data['amount']*-1;
        }

        return $data;
        
    }

    // chain a transaction to create an equivalent student account
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

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Fee Added Successfuly';
    }

    public function getTitle() : string
    {
        return 'Add a New Fee Payment';
    }


}
