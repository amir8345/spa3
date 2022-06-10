<?php

namespace App\Http\Resources;

use App\Models\Book;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'user' => new UserResource( User::find( $this->user_id ) ),
            'commented_type' => $this->commented_type,
            'commented_id' => $this->commented_id,
            'body' => $this->body,
            'created_at' => $this->created_at,
            'likes' => $this->likes()->count(),
            'comments' => $this->comments()->count()
        ];
      
    }
}
