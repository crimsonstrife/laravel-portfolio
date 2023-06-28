<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    //Blog
    public function index()
    {
        $posts = BlogPost::all();

        return view('blog.index', compact('posts'));
    }

    //Category
    public function category($slug)
    {
        $category = BlogCategory::where('slug', $slug)->firstOrFail();
        $posts = BlogPost::where('category_id', $category->id)->get();

        return view('blog.category', compact('category', 'posts'));
    }

    //Blog Post controller show using blog category slug and blog post slug
    public function show($category, $slug)
    {
        $post = BlogPost::where('slug', $slug)
            ->whereHas(
                'category',
                function ($query) use ($category) {
                    $query->where('slug', $category);
                }
            )
            ->firstOrFail();

        return view('blog.show', compact('post'));
    }
}
