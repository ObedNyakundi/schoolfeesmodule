<?php

namespace App\Filament\Resources\StudentResource\Pages;

use Illuminate\Support\Facades\Auth;
use App\Filament\Resources\StudentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\StudentAccount;
use App\Models\Student;

class CreateStudent extends CreateRecord
{
    protected static string $resource = StudentResource::class;

    protected function handleRecordCreation(array $data): Student
    {
        //normal insert
       $record =  static::getModel()::create($data);

        //transaction to create a student account
        $stdAccount=new StudentAccount();
        $stdAccount->student_id=$record->id;
        $stdAccount->stream_id=$record->stream_id;
        $stdAccount->created_by=Auth::user()->id;
        $stdAccount->save();

        return $record;
    }
    
    //the custom title for admitting a student
    public function getTitle(): string
    {
        return 'Admit a Student';
    }


    
}
