<?php
namespace App\Filament\Resources\FeePaymentResource\Pages;

use Illuminate\Support\Facades\Auth;
use App\Filament\Resources\FeePaymentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\StudentAccount;
use App\Models\FeePayment;
use App\Models\Receipt;
use App\Models\SchoolAccount;


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

    // chain a transaction to update the student and school accounts
    protected function handleRecordCreation(array $data): FeePayment
    {
         //normal insert
       $record =  static::getModel()::create($data);

       //credit amount
       $credit=$record->amount;

       //Fetch student account for credit update
       $studentAccount = StudentAccount::where('student_id', '=', $record->student_id)->get()->first();
       $std_balance=$studentAccount->balance; //student balance before update
       $studentAccount->balance=$studentAccount->balance+$credit; //update balance
       $studentAccount->credit=$studentAccount->credit+$credit; //update credit
       $studentAccount->save();

       //Create a receipt ledger record
       $receipt = new Receipt();
       $receipt->feepayment_id = $record->id;
       $receipt->student_id = $record->student_id;
       $receipt->existing_balance=$std_balance;
       $receipt->amount_paid=$credit;
       $receipt->new_balance=$std_balance+$credit;
       $receipt->save();

       //Fetch school account for Income update
       $schoolAccount=SchoolAccount::latest()->first();
       $schoolAccount->balance=$schoolAccount->balance+$credit; //update balance
       $schoolAccount->income=$schoolAccount->income+$credit; //update income
       $schoolAccount->save();

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
