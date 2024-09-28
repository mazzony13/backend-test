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
        'price',
        'slug',
        'is_active'
    ];

    //get stored price json in db as an array
    protected $casts = [
        'price' => 'array',
    ];

}
