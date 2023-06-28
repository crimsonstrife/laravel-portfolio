<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;

    //has names and slugs
    protected $fillable = ['name', 'slug'];

    //has many posts
    public function posts()
    {
        return $this->hasMany(BlogPost::class);
    }
}
