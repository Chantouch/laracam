<?php

namespace App\Http\Controllers\Ref;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Tag;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
	public $route = 'admin.ref.category.';
	public $view = 'ref.category.';

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$categories = Category::with('parent', 'children')->paginate(25);
		return view($this->view . 'index', compact('categories'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$categories = Category::with('children')
			->where('status', 1)
			->orderBy('id')->pluck('name', 'id');
		return view($this->view . 'create', compact('categories'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(Request $request)
	{
		try {
			DB::beginTransaction();
			$data = $request->all();
			$validator = Validator::make($data, Category::rules(), Category::messages());
			if ($validator->fails()) {
				return back()->withInput()->withErrors($validator);
			}
			if ($request->has('parent_id')) {
				$data['parent_id'] = $request->parent_id;
				Category::with('parent')->create($data);
			} else {
				$create = Category::with('children')->create($data);
				if (!$create) {
					DB::rollback();
					return back()->with('error', 'Your category can not add to our system right now. Plz try again later.');
				}
			}
			DB::commit();
			return redirect()->route($this->route . 'index')->with('success', 'Category added successfully.');
		} catch (ModelNotFoundException $exception) {
			DB::rollback();
			return back()->with('error', 'Your category can not add to our system right now. Plz try again later.');
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Model\ $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$category = Category::find($id);
		return view($this->view . 'show', compact('category'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Model\ $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		if ($id === null) {
			return redirect()->route($this->route . 'index')->with('error', 'We can not find category with that id, please try the other');
		}
		$category = Category::with('children')->find($id);
		$categories = Category::with('children')
			->where('status', 1)
			->orderBy('id')->pluck('name', 'id');
		return view($this->view . 'edit', compact('category', 'categories'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \App\Model\ $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(Request $request, $id)
	{
		try {
			DB::beginTransaction();
			$data = $request->all();
			if ($id === null) {
				return redirect()->route($this->route . 'index')->with('error', 'We can not find category with that id, please try the other');
			}
			$category = Category::with('children')->find($id);
			if ($category->parent_id !== null)
				$category = Category::with('children')->find($id);
			$validator = Validator::make($data, Category::rules($id), Category::messages());
			if ($validator->fails()) {
				return back()->withInput()->withErrors($validator);
			}
			if ($request->has('tags')) {
				//$trim = trim($request->tags, " ");
				$trimmed_array = explode(',', $request->tags);
				$tags = array_map('trim', $trimmed_array);
				//$tags = $request->tags;
				$ids = [];
				foreach ($category->tags as $tg) {
					$ids[] = $tg->id;
				}
				DB::table('taggables')
					->whereIn('tag_id', $ids)
					->delete();
				foreach ($tags as $tag) {
					$data['tags'] = $tag;
					$tgs = Tag::firstOrNew(['tags' => $tag]);
					//$tgs = Tag::firstOrCreate(['tags'=> $tag]);
					$category->tags()->save($tgs);
					//if (!$product->tags()->saveMany([$tgs]))
					//    throw new ModelNotFoundException();
				}
			}
			$update = $category->update($data);
			if (!$update) {
				DB::rollBack();
				return back()->with('error', 'Your category can not add to your system right now. Plz try again later.');
			}
			DB::commit();
			return redirect()->route($this->route . 'index')->with('success', 'Category added successfully.');
		} catch (ModelNotFoundException $exception) {
			return back()->with('error', 'Your category can not add to your system right now. Plz try again later.');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Model\ $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$category = Category::find($id);
		$delete = $category->delete();
		if (!$delete) {
			return back()->with('error', 'Your category can not delete from your system right now. Plz try again later.');
		}
		return redirect()->route($this->route . 'index')->with('success', 'Category deleted successfully');
	}
}