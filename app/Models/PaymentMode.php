<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMode extends Model
{
    use HasFactory;
    protected $table = 'payment_modes';
    protected $fillable = [
      'name',
    ];

    public function feepayment(){
        return $this->hasMany(FeePayment::class);
    }
}
