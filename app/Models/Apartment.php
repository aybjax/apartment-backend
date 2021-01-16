<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'id', 'title', 'description', 'price', 'street',
    //     'home', 'apartment', 'owner'
    // ];

    protected $guarded = [
        'created_at', 'updated_at'
    ];

    /** */
    protected $hidden = [
        'created_at', 'updated_at'
    ];

    /** */
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    /** */
    public function owner()
    {
        return $this->belongsTo(User::class);
    }
}
