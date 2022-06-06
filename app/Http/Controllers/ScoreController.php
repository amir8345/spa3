<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\BookResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\ScoreResource;

class ScoreController extends Controller
{

    // return final score of a book
    public function book_score(Book $book)
    {
        return round( $book->scores()->avg('score') , 1);
    }


    // return all scores submitted about a book or all scores a user had made
    // first check if a book or a user model been send
    public function scores($type , $id , $page)
    {
        if ($type == 'user') {
            $model = User::find($id);
        }
        
        if ($type == 'book') {
            $model = Book::find($id);
        }

        $scores = $model->scores()
        ->orderByDesc('created_at')
        ->offset( ($page - 1) * 20 )
        ->limit(20)
        ->get();

        return ScoreResource::collection($scores); 

    }

}
