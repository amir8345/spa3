<?php

namespace App\Http\Resources;

use App\Models\Contributor;
use App\Models\Publisher;
use App\Models\Reader;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        if (Publisher::where('user_id' , $this->id)->first()) {
            $type = 'publisher';
        }
        if (Contributor::where('user_id' , $this->id)->first()) {
            $type = 'contributor';
        }
        if (Reader::where('user_id' , $this->id)->first()) {
            $type = 'reader';
        }

        return [
            'id' => $this->id,
            'username' => $this->username,
            'name' => $this->name,
            'type' => $type,
        ];
    }
}
