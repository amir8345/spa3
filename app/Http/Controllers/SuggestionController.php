<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

class SuggestionController extends Controller
{
    public function suggestions_count(Book $book)
    {
        return $book->suggestions->count();
    }


    // return suggesions made by users about a book
    public function book_suggestions(Book $book)
    {

        $suggestions = $book->suggestions()->where('public' , true)->get();
        $suggestions_details = [];

        foreach ($suggestions as $suggestion) {

            $suggestions_details[] = [
                'maker' => new UserResource( User::find($suggestion->user_id) ),
                'receiver' => $suggestion->receiver,                
                'reason' => $suggestion->reason,                
            ];

        }

        return $suggestions_details;

    }

    // return all public suggestions a user had made
    public function user_suggestions(User $user)
    {
        
    }

}
