<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    use HasFactory;

    protected $table = 'finance';
    protected $fillable = [
        'member_id',
        'amount',
        'sub_type',
    ];
}
