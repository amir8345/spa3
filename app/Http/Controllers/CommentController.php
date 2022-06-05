<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Resources\CommentResource;
use App\Models\Comment;

class CommentController extends Controller
{
    public function comments($kind , $id , $type, $page)
    {
        // kind: book / user / post / comment
        // $type : comments_on / comments_by
        
        if ($kind == 'book') {
            $model = Book::find($id);
        }
        
        if ($kind == 'user') {
            $model = User::find($id);
        }
        
        if ($kind == 'post') {
            $model = Post::find($id);
        }
       
        if ($kind == 'comment') {
            $model = Comment::find($id);
        }

        $offset = ($page - 1) * 20;
        
        $comments = $model->$type()->offset($offset)->limit(20)->get();

        foreach ($comments as $comment) {

            $comment_details[] = [
                'id' => $comment->id ,
                'writer' => new UserResource(User::find($comment->user_id)),
                'body' => $comment->body,
                'commented_type' => $comment->commented_type,
                'commented_id' => $comment->commented_id,
                'created_at' => $comment->created_at,
                'numbers' => [
                    'like' => $comment->likes->count(),
                    'comment' => $comment->comments_on->count(),
                ],
            ];
            
        }

        return $comment_details;

    }
}
    