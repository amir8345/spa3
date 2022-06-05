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
                'score' => $this->book_numbers->score,
                'debate' => $this->book_numbers->debate,
                'read' => $this->book_numbers->read,
                'want' => $this->book_numbers->want,
                'reading' => $this->book_numbers->reading,
            ]
        ];
    }
}
