<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BookHelp;
use Illuminate\Http\Request;
use App\Http\Resources\BookResource;

class BookController extends Controller
{
    
    public function books(User $user , $order , $page)      
    {

        $offset = ($page - 1) * 20;
        $asc_desc = 'desc';
        
        if ($order == 'title') {
            $asc_desc = 'asc';
        }

        $books_id = $user->book_help()
        ->orderBy($order , $asc_desc)
        ->offset($offset)
        ->limit(20)
        ->pluck('book_help.id');

        $books = BookHelp::whereIn('id' , $books_id->toArray())->get();
        
        return BookResource::collection($books);
    }
}
