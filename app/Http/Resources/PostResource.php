<?php

namespace App\Http\Resources;

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
        return [
            'user' => new UserResource( User::find( $this->user_id ) ),
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
