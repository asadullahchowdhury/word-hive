<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'image',
    ];

    public function images()
    {
        return $this->hasMany(BlogImage::class);
    }

}
