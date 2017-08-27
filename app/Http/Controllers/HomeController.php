<?php

namespace App\Http\Controllers;

use App\Model\Comment;
use App\Model\Post;
use App\Model\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::lastWeek()->get();
        $posts = Post::lastWeek()->get();
        $users = User::lastWeek()->get();
        return view('admin.dashboard.index', compact('comments', 'posts', 'users'));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function insertPostCategory()
    {
        $id = 1;
        for ($i = 1; $i <= 66; $i++) {
            if ($id == 5) {
                $id = 1;
            }
            DB::table('post_categories')->insert([
                'post_id' => $i,
                'category_id' => $id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            $id++;
        }
        return response()->json(['message' => 'Successfully added to database']);
    }
}
