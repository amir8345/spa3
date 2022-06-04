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
            'id' => $this->id ,
            'writer' => new UserResource(User::find($this->user_id)),
            'title' => $this->title,
            'body' => $this->body,
            'created_at' => $this->created_at,
            'numbers' => [
                'like' => $this->likes->count(),
                'comment' => $this->comments->count(),
            ]
        ];
    }
}
