<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\PostsRequest;
use App\Http\Traits\CrudTrait;
use App\Http\Traits\ManyToManyTrait;
use App\Http\Traits\MetaTrait;
use App\Http\Traits\TagTrait;
use App\Http\Traits\UploadTrait;
use App\Model\Category;
use App\Model\MediaLibrary;
use App\Model\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use DOMDocument;

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
			$storage_path = storage_path("app/public/uploads/media/library/");
			if (!file_exists($storage_path)) {
				mkdir($storage_path, 0777, true);
			}
			if (!empty($request->slug)) {
				$data['slug'] = str_slug($request->title);
			}
			//First check need to clean the description for html tag
			//$data['description'] = clean($request->description);
			$dom = new DOMDocument();
			$dom->loadHtml(mb_convert_encoding($data['description'], 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
			$images = $dom->getElementsByTagName('img');
			// foreach <img> in the submitted message
			foreach ($images as $img) {
				$src = $img->getAttribute('src');
				// if the img source is 'data-url'
				if (preg_match('/data:image/', $src)) {
					// get the mimetype
					preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
					$mimetype = $groups['mime'];
					// Generating a random filename
					$filename = uniqid() . str_random(60);
					$filename_mime = $filename . '.' . $mimetype;
					$filepath = "/admin/media-library/$filename_mime";
					// @see http://image.intervention.io/api/
					$image = Image::make($src)// resize if required	/* ->resize(300, 200) */
					->encode($mimetype, 100)// encode file to the specified mimetype
					->save($storage_path . $filename_mime);
					$medialibrary = new MediaLibrary();
					$medialibrary->storeMediaLibraryByPost($filename_mime, $mimetype, $filename_mime, $filename_mime);
					$new_src = asset($filepath);
					$img->removeAttribute('src');
					$img->setAttribute('src', $new_src);
				} // <!--endif -->
			} // <!--Check-->
			//<!--Save the description content to db-->
			$data['description'] = $dom->saveHTML();
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
			//$path = 'uploads/article/' . date('Y') . '/';
			$storage_path = storage_path("app/public/uploads/media/library/");
			if (!file_exists($storage_path)) {
				mkdir($storage_path, 0777, true);
			}
			if ($request->hasFile('thumbnail')) {
				$post->storeAndSetThumbnail($request->file('thumbnail'), $post);
			}
			$post->storeAndSetAuthor();
			//$data['description'] = clean($request->description);
			$dom = new DOMDocument();
			$dom->loadHtml(mb_convert_encoding($data['description'], 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
			$images = $dom->getElementsByTagName('img');
			// foreach <img> in the submitted message
			foreach ($images as $img) {
				$src = $img->getAttribute('src');
				// if the img source is 'data-url'
				if (preg_match('/data:image/', $src)) {
					// get the mimetype
					preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
					$mimetype = $groups['mime'];
					// Generating a random filename
					$filename = uniqid() . str_random(60);
					$filename_mime = $filename . '.' . $mimetype;
					$filepath = "/admin/media-library/$filename_mime";
					// @see http://image.intervention.io/api/
					$image = Image::make($src)// resize if required	/* ->resize(300, 200) */
					->encode($mimetype, 100)// encode file to the specified mimetype
					->save($storage_path . $filename_mime);
					$medialibrary = new MediaLibrary();
					$medialibrary->storeMediaLibraryByPost($filename_mime, $mimetype, $filename_mime, $filename_mime);
					$new_src = asset($filepath);
					$img->removeAttribute('src');
					$img->setAttribute('src', $new_src);
				} // <!--endif -->
			} // <!--Check-->
			//<!--Save the description content to db-->
			$data['description'] = $dom->saveHTML();
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
