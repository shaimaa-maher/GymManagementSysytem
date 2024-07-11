<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    use HasFactory;

    protected $table='trainers';
    
    protected $fillable=[
        'name',
        'phone',
        'salary',
        'email',
        'working_hours',
        'card_id',
        'address',
        'class'
    ];


    public function member(): HasMany
    {
        return $this->hasMany(Member::class,'member_id','id');
    }

}
