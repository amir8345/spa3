<?php

namespace App\Http\Resources;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class SuggestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
    
        // return [

        //     'user' => $this->when(request('type') == 'book' , function() {
        //         return new UserResource( User::find($this->user_id) );
        //     }),
            
        //     'book' => $this->when(request('type') == 'user' , function() {
        //         return new BookResource( Book::find($this->book_id) );
        //     }),

        //     'receiver' => $this->receiver,
        //     'reason' => $this->reason,
        //     'created_at' => $this->created_at,

        // ];

    
    }
}
