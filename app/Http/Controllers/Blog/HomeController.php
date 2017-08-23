<?php

namespace App\Http\Controllers\Blog;

use App\Model\Category;
use App\Model\Post;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public $view = 'blog.';

    public function index()
    {
        $posts = Post::with('categories')->get();
        $categories = Category::with('articles')->get();
        return view($this->view . 'index', compact('posts', 'categories'));
    }
}
