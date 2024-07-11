<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $table = 'members';
    
    protected $fillable = [
        'name',
        'email',
        'phone',
        'membership_cost',
        'membership_period',
        'payment',
        'barcode_number',
        'start_subscription',
        'end_subscription',
        'sessionsNumber',
        'trainer_id'
    ];


    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    public function trainer()
    {
        return $this->hasOne(Trainer::class,'trainer_id','id');
    }
}
