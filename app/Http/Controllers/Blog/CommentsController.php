<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentsRequest;
use Illuminate\Support\Facades\Auth;
use App\Model\Comment;
use App\Model\Post;

class CommentsController extends Controller
{
    /**
    * Store a newly created resource in storage.
    *
    * @return Response
    */
    public function store(CommentsRequest $request)
    {
        $user = Auth::user();
        $post = Post::findOrFail($request->input('post_id'));

        $comment = $user->comments()->create([
            'post_id' => $post->id,
            'content' => $request->input('content')
        ]);

        return redirect()->route('posts.show', $post)->withSuccess(__('comments.created'));
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  Comment  $comment
    * @return \Illuminate\Http\Response
    */
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return redirect()->route('posts.show', $comment->post)->withSuccess(__('comments.deleted'));
    }
}
