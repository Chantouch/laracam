<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\PostsRequest;
use App\Http\Traits\CrudTrait;
use App\Http\Traits\ManyToManyTrait;
use App\Http\Traits\MetaTrait;
use App\Http\Traits\TagTrait;
use App\Http\Traits\UploadTrait;
use App\Model\Category;
use App\Model\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    use CrudTrait;
    use UploadTrait;
    use TagTrait;
    use ManyToManyTrait;
    use MetaTrait;
    public $route = 'admin.article.';
    public $view = 'article.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Post::with(['tags', 'categories', 'images'])
            ->withCount('comments')->with('author')->latest()->paginate(25);
        return view($this->view . 'index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::with('articles')->where('status', 1)
            ->orderBy('name', 'desc')
            ->pluck('name', 'id')->toArray();
        $most_used_cat = Category::with('articles')->get();
        //return response($most_used_cat);
        return view($this->view . 'create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostsRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            $path = 'uploads/article/' . date('Y') . '/';
            $data['path'] = $path;
            if (!empty($request->slug)) {
                $data['slug'] = str_slug($request->title);
            }
            $data['description'] = clean($request->description);
            $model_created = Post::with('images')->create($data);
            if ($model_created) {
                $model_created->storeAndSetAuthor();
                if ($request->hasFile('thumbnail')) {
                    $model_created->storeAndSetThumbnail($request->file('thumbnail'), $model_created);
                }
                if ($request->has('tags')) {
                    $this->attachTag($model_created, 'App\Model\Post', $request->tags);
                }
                if ($request->has('categories')) {
                    $this->attachRelation($model_created->categories(), explode(',', $request->categories));
                }
                if ($request->has('meta_title')) {
                    $this->createMeta($model_created, $request->meta_title, $request->meta_keywords, $request->meta_description);
                }
            }
            DB::commit();
            return redirect()->route($this->route . 'index')->with('success', 'Post created successfully');
        } catch (ModelNotFoundException $exception) {
            throw new ModelNotFoundException();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::with('media')->find($id);
        return view($this->view . 'show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::with('articles')->where('status', 1)
            ->orderBy('name', 'desc')
            ->pluck('name', 'id')->toArray();
        $post = Post::with('images')->find($id);
        return view($this->view . 'edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostsRequest|Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostsRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            $post = Post::with('images')->find($id);
            $path = 'uploads/article/' . date('Y') . '/';
            $data['path'] = $path;
            if ($request->hasFile('thumbnail')) {
                $post->storeAndSetThumbnail($request->file('thumbnail'), $post);
            }
            $post->storeAndSetAuthor();
            $data['description'] = clean($request->description);
            $updated = $post->update($data);
            if ($updated) {
                if ($request->has('tags')) {
                    $this->syncTag($post, 'App\Model\Post', $request->tags);
                }
                if ($request->has('categories')) {
                    $this->syncRelation($post->categories(), explode(',', $request->categories));
                }
                if ($request->has('meta_title')) {
                    $this->createMeta($post, $request->meta_title, $request->meta_keywords, $request->meta_description);
                }
            }
            DB::commit();
            return redirect()->route($this->route . 'index')->with('success', 'Post updated successfully');
        } catch (ModelNotFoundException $exception) {
            throw new ModelNotFoundException();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::with('images')->find($id);
        $post->delete();
        return redirect()->route($this->route . 'index')->with('success', 'Article deleted successfully.');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function draft()
    {
        $articles = Post::with('images')->where('active', 3)->paginate(25);
        return view($this->view . 'index', compact('articles'));
    }
}
