<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Attendance extends Model  
{
    use HasFactory;
    // const CREATED_AT = '';
    // const UPDATED_AT = '';

    protected $table = 'attendances'; 
    protected $fillable = [
       'member_id',
       'trainer_id',
       'type'
    ];
 

    public function member(): HasOne
    {
        return $this->hasOne(Member::class, 'id', 'member_id');
    }

    public function trainer(): HasOne
    {
        return $this->hasOne(trainer::class, 'id', 'trainer_id');
    }
}
