<?php

namespace App\Http\Controllers\API\V1;

use App\Transformers\CommentTransformer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Model\Comment;

class CommentsController extends ApiController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->transformer = new CommentTransformer;
        $this->resourceKey = 'comments';
    }

    /**
    * Return the comments.
    *
    * @param  Request $request
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $comments = Comment::latest()->paginate($request->input('limit', 20));

        return $this->paginatedCollection($comments);
    }

    /**
    * Return the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $comment = Comment::find($id);

        if (! $comment) {
            return $this->respondNotFound();
        }

        return $this->item($comment);
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $comment = Comment::find($id);

        if (! $comment) {
            return $this->respondNotFound();
        }

        if (! Auth::user()->can('delete', $comment)) {
            return $this->respondUnauthorized();
        }

        $comment->delete();

        return $this->respondNoContent();
    }
}
