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
        'gender',
        'admission_number',
        'guardian_phone',
        'guardian_name',
        'stream_id',
        'added_by',
    ];

    public function stream() 
    {
        return $this->belongsTo(Stream::class);
    }

    public function user(){
        return $this->belongsTo(User::class, 'added_by');
    }

    public function feepayment(){
     return $this->hasMany(FeePayment::class);   
    }
    
    public function studentaccount(){
     return $this->hasOne(StudentAccount::class);   
    }
}
