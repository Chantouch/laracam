<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public $view = 'blog.';

    public function index()
    {
        return view($this->view . 'index');
    }
}
