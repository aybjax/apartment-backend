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

    protected $hidden = [
        'created_at', 'updated_at', 'imageable_type', 'imageable_id', 'id',
    ];

    /** 
     * morphTo User or Apartment
     */
    public function imageable()
    {
        return $this->morphTo();
    }
}
