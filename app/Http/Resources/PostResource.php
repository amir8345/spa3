<?php

namespace App\Http\Resources;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        if ($this->posted_type == 'user') {
            $parent = new UserResource( User::find( $this->posted_id ) );
        }
       
        if ($this->posted_type == 'book') {
            $parent = new BookResource( Book::find( $this->posted_id ) );
        }


        return [
            'user' => new UserResource( User::find( $this->user_id ) ),
            'parent' => $parent,
            'posted_type' => $this->posted_type,
            'posted_id' => $this->posted_id,
            'title' => $this->title,
            'body' => $this->body,
            'created_at' => $this->created_at,
            'likes' => $this->likes()->count(),
            'comments' => $this->comments()->count(),
        ];
    }
}
