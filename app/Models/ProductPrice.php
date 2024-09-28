<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_id',
        'type_id',
        'value',
    ];

    public function type() // relation get type attached to product price
    {
        return $this->hasOne(UserType::class,'id','type_id');
    }

}
