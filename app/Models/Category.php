<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Category extends Model
{
    use HasFactory;

    protected $table='categories';
    
    protected $fillable=[
        'name',
    ];


    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class,'id','parent_id');
    }


    public function subCategory(): HasMany
    {
        return $this->hasMany(Category::class,'parent_id','id');
    }

}
