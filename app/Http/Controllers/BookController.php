<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\BookHelp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\BookResource;
use App\Http\Resources\UserResource;
use App\Http\Controllers\ShelfController;
use App\Http\Controllers\SuggestionController;

class BookController extends Controller
{

    public function all($order , $page)
    {

        $request_info = $this->order_page($order , $page);

        $books = Book::join('book_numbers' , 'books.id' , '=' , 'book_numbers.book_id')
        ->orderBy($order , $request_info['asc_desc'])
        ->offset($request_info['offset'])
        ->limit(20)
        ->get();

        return BookResource::collection($books);

    }
    
    public function one(Book $book)
    {
        foreach ($book->users as $user) {
            $contributors[$user->pivot->action][] = new UserResource($user);
        }

        $shelf = new ShelfController();
        $suggesion = new SuggestionController();
        $score = new ScoreController();
        
        // $user_score = DB::table('scores')
        // ->where('book_id' , $book->id)
        // ->where('user_id' , request()->user()->id)
        // ->value('score');

        return [
            'info' => $book,
            'contributors' => $contributors,
            'shelves' => $shelf->shelves_count($book),
            'suggestions' => $suggesion->suggestions_count($book),
            // 'user_score' => 
            'score' => $score->book_score($book),
            'posts' => $book->posts_on()->count(),
            'comments' => $book->comments_on()->count(),
        ];

    }


    public function books(User $user , $action , $order , $page)      
    {

        $request_info = $this->order_page($order , $page);

        $books_id = $user->books()->wherePivot('action' , $action)->pluck('books.id');

        $books = Book::join('book_numbers' , 'books.id' , '=' , 'book_numbers.book_id')
        ->whereIn('id' , $books_id->toArray())
        ->orderBy($order , $request_info['asc_desc'])
        ->offset($request_info['offset'])
        ->limit(20)
        ->get();

        return BookResource::collection($books);

    }

    public function timeline(Book $book, $page)
    {
        $timeline = DB::table('timeline')
        ->where('type' , 'book')
        ->where('type_id' , $book->id)
        ->orderByDesc('created_at')
        ->offset(($page - 1) * 20)
        ->limit(20)
        ->get();

        return $timeline;
    }



    public function order_page($order , $page)
    {
       
        $asc_desc = 'desc';

        if ($order == 'title') {
            $asc_desc = 'asc';
        }

        return [
            'offset' => ($page - 1) * 20,
            'asc_desc' => $asc_desc
        ];

    }


}
