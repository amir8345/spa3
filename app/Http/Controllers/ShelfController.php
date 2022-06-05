<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

class ShelfController extends Controller
{
 
    // receive a book and tell us how many shelves has that book
    public function shelves_count(Book $book)
    {
        return $book->shelves->count();
    }


    public function shelves(Book $book)
    {
        
        $shelves = [];

        foreach ($book->shelves as $shelf) {
            $shelves[] = [
                'id' => $shelf->id,
                'creator' => new UserResource( User::find($shelf->user_id) ) ,
                'name' => $shelf->name,
                'created_at' => $shelf->created_at,
            ];
        }

        return $shelves;
    }

}
