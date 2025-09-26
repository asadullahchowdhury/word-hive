<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cateories extends Model
{
    protected $table = 'cateories';
    protected $fillable = ['name'];
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
