<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeePayment extends Model
{
    /*** ledger entries of payments ***/
    use HasFactory;
    protected $table = 'fee_payments';

    
    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function feestype(){
        return $this->belongsTo(Feestype::class);
    }
}
