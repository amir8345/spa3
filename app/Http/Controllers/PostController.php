<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Post;
use App\Models\User;
use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\CommentResource;

class PostController extends Controller
{
    // public function posts($kind , $id , $type, $page)
    // {
    //     // kind: book / user
    //     // $type : posts_on / posts_by
        
    //     if ($kind == 'book') {
    //         $model = Book::find($id);
    //     }
        
    //     if ($kind == 'user') {
    //         $model = User::find($id);
    //     }
        
    //     $offset = ($page - 1) * 20;
        
    //     $posts = $model->$type()->offset($offset)->limit(20)->get();
        
    //     foreach ($posts as $post) {
            
    //         $posts_details[] = [
    //             'id' => $post->id ,
    //             'writer' => new UserResource(User::find($post->user_id)),
    //             'title' => $post->title,
    //             'body' => $post->body,
    //             'posted_type' => $post->posted_type,
    //             'posted_id' => $post->posted_id,
    //             'created_at' => $post->created_at,
    //             'numbers' => [
    //                 'like' => $post->likes->count(),
    //                 'comment' => $post->comments_on->count(),
    //                 ]
    //             ];
    //         }

    //         return $posts_details;
            
    //     }
        
    
    public function one(Post $post)
    {
        return [
            'post' => new PostResource($post),
            'comments' => CommentResource::collection($post->comments)
        ];
    }



}
    