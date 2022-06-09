<?php

namespace App\Http\Resources;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class LikeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        if ($this->liked_type == 'post') {
            $liked = new PostResource(Post::find($this->liked_id));
        }
       
        if ($this->liked_type == 'comment') {
            $liked = new CommentResource(Comment::find($this->liked_id));
        }


        return [
            'user' => new UserResource( User::find($this->user_id) ) ,
            'liked_type' => $this->liked_type,
            'liked' => $liked,
            'created_at' => $this->created_at
        ];
        
        
        
    }
}
