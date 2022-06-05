<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class ScoreController extends Controller
{

    // return final score of a book
    public function book_score(Book $book)
    {
        return round( $book->scores()->avg('score') , 1);
    }
}
