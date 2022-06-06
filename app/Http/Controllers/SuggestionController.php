<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Resources\SuggestionResource;

class SuggestionController extends Controller
{
    public function suggestions_count(Book $book)
    {
        return $book->suggestions->count();
    }


    // return suggestions made by users about a book or all suggestions a user had made
    public function suggestions($type , $id , $page)
    {

        if ($type == 'user') {
            $model = User::find($id);
        }
        
        if ($type == 'book') {
            $model = Book::find($id);
        }

        $suggestions = $model->suggestions()
        ->where('public' , true)
        ->orderByDesc('created_at')
        ->offset( ($page - 1 ) * 20)  
        ->limit(20)
        ->get();

        return SuggestionResource::collection($suggestions); 


    }


}
