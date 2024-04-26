<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;

    //table name
    protected $table = 'blog_category';

    //has names and slugs
    protected $fillable = ['name', 'slug'];

    //has timestamps
    public $timestamps = true;

    //has id
    protected $primaryKey = 'id';

    //has author
    protected $author = 'author';

    //has many posts
    public function posts()
    {
        return $this->hasMany(BlogPost::class);
    }
}
