<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Dyrynda\Database\Support\GeneratesUuid;
use Spatie\MediaLibrary\HasMedia; //use spatie media library to allow model to acts with media
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory;
    use GeneratesUuid; // to generate uuid
    use InteractsWithMedia; // to allow model to deal with media


     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'name',
        'description',
        'slug',
        'is_active'
    ];


    public function prices()
    {
        return $this->hasMany(ProductPrice::class,'product_id','id');
    }


    //function to take name of user type and set product price value
    public function set_price(string $key,$value)
    {
        $user_type_id = UserType::where('name',$key)->first()->id;
         ProductPrice::create([
            'type_id'=>$user_type_id,
            'product_id'=>$this->id,
            'value'=>$value
         ]);
    }
}
