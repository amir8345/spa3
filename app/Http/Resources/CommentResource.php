<?php

namespace App\Http\Resources;

use App\Models\User;
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
            'user' => new UserResource( User::find( $this->user_id ) ),
            'commented_type' => $this->commented_type,
            'commented_id' => $this->commented_id,
            'body' => $this->body,
            'created_at' => $this->created_at,
        ];
      
    }
}
