<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'description',
        'price',
        'cover',
        'pdf',
        'category_id',
        'created_at',
        'updated_at'
    ];
/*
    public function category()
    {
        return $this->belongsTo(Category::class);
    }*/

    public function users()
    {
        return $this->belongsToMany(User::class, 'book_user')->withTimestamps();
    }
}
