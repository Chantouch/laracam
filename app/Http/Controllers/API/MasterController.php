<?php

namespace App\Http\Controllers\API;

use App\Model\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MasterController extends Controller
{
	public function category()
	{
		$category = Category::all();
		return response($category, 200);
	}
}
