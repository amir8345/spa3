<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        foreach ($this->users as $user) {
            $contributors[$user->pivot->action][] = new UserResource(User::find($user->id));
        }

        return [
            'id' => $this->id,
            'title' => $this->title,
            'contributors' => $contributors,
            'numbers' => [
                'score' => $this->score,
                'debate' => $this->debate,
                'read' => $this->read,
                'want' => $this->want,
                'reading' => $this->reading,
            ]
        ];
    }
}
