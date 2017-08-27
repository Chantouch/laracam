<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Model\Post;

class PostsController extends Controller
{
    public $view = 'blog.';

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with([
            'posts' => Post::with('author')->latest()->paginate(20)
        ]);
    }

    /**
     * Show the rss feed of posts.
     *
     * @return Response
     */
    public function feed()
    {
        $posts = Cache::remember('feed-posts', 60, function () {
            return Post::latest()->limit(20)->get();
        });

        return response()->view('posts.feed', [
            'posts' => $posts
        ], 200)->header('Content-Type', 'text/xml');
    }

    /**
     * Display the specified resource.
     * @param $idOrSlug
     * @return $this
     */
    public function show($idOrSlug)
    {
        if (ctype_digit($idOrSlug)) {
            $post = Post::with('comments')
                ->where('id', $idOrSlug)->firstOrFail();
        } else {
            $post = Post::with('comments')
                ->where('slug', $idOrSlug)->firstOrFail();
        }
        $comments = $post->comments()->with('author')->latest()->paginate(50);
        $previous = Post::with('comments')
            ->where('id', '<', $post->id)->max('slug');
        $next = Post::with('comments')
            ->where('id', '>', $post->id)->min('slug');
        return view($this->view . 'show', compact('post', 'comments', 'previous', 'next'));
    }
}
