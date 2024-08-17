<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeePayment extends Model
{
    /*** ledger entries of payments ***/
    use HasFactory;
    protected $table = 'fee_payments';
    protected $fillable = [
        'student_id',
        'payment_date',
        'amount',
        'feestypes_id',
        'paymentmode_id',
        'added_by',
    ];

    
    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function feestypes(){
        return $this->belongsTo(Feestype::class);
    }

    public function paymentmode( ){
        return $this-> belongsTo(PaymentMode::class);
    }

    public function users(){
        return $this->belongsTo(User::class, 'added_by', 'id');
    }
}
