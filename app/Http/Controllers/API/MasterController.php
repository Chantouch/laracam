<?php

namespace App\Http\Controllers\API;

use App\Model\Category;
use App\Model\Tag;
use App\Http\Controllers\Controller;

class MasterController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function tag()
    {
        $tags = Tag::all();
        return response($tags, 200);
    }

    public function categories()
    {
        $categories = Category::all();
        return response($categories, 200);
    }

    public function catMostUsed()
    {
        $most = Category::with('articles')->get()->toArray();
        return response($most, 200);
    }
}
