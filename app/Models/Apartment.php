<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'title', 'description', 'price', 'street',
        'home', 'apartment'
    ];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
