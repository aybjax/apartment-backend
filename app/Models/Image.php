<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
    ];

    /** 
     * morphTo User or Apartment
     */
    public function imageable()
    {
        return $this->morphTo();
    }
}
