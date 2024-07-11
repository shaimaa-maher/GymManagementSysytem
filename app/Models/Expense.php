<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Expense extends Model
{
    use HasFactory;
    protected $table='expenses';

    protected $fillable=[ 
        'cat_id',
        'sub_cat_id',
        'amount',
        'note'
    ];

    public function category(): HasOne
    {
        return $this->hasOne(Category::class,'id','cat_id');
    }

    public function subCategory(): HasOne
    {
        return $this->hasOne(Category::class,'id','sub_cat_id');
    } 
}

