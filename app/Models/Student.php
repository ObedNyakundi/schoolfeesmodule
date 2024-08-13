<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $table='students';

    protected $fillable=[
        'name',
        'admission_number',
        'guardian_phone',
        'guardian_name',
        'stream_id',
    ];

    public function stream() 
    {
        return $this->belongsTo(Stream::class);
    }

    public function feepayment(){
     return $this->hasMany(FeePayment::class);   
    }
    
    public function studentaccount(){
     return $this->hasMany(StudentAccount::class);   
    }
}
