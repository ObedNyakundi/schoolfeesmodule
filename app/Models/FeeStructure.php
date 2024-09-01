<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeStructure extends Model
{
    use HasFactory;
    protected $table = 'fee_structures';

    protected $fillable = [
        'stream_id',
        'term',
        'amount',
        'added_by',
    ];


    public function stream(){
        return $this->belongsTo(Stream::class);
    }

    public function user(){
        return $this->belongsTo(User::class, 'added_by');
    }

}
