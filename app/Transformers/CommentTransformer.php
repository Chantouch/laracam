<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Model\Comment;

class CommentTransformer extends TransformerAbstract
{
    /**
     * Transform a comment.
     *
     * @param Comment $comment
     * @return array
     */
    public function transform(Comment $comment): array
    {
        return [
            'id' => $comment->id,
            'body' => $comment->body,
            'posted_at' => $comment->posted_at->toIso8601String(),
            'user_id' => $comment->user_id,
            'post_id' => $comment->post_id
        ];
    }
}
