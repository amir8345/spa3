<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Models\User;
use App\Models\Shelf;
use App\Models\BookShelf;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

class ShelfController extends Controller
{
    
    public function library(User $user)
    {

        $library = [];

        foreach ($user->shelves as $shelf) {
            $library[] = [
                'id' => $shelf->id,
                'name' => $shelf->name,
                'books' => $shelf->books()->count(),
            ];
        }

        $last_update = BookShelf::
        whereIn('shelf_id' , $user->shelves()->pluck('shelves.id')->toArray())
        ->orderBy('created_at')
        ->first()
        ->value('created_at');

        return [ 'library' => $library , 'last_update' => $last_update];

    }


    public function books(Shelf $shelf , $page)
    {
        $books = $shelf->books()
        ->offset( ($page - 1) * 20 )
        ->limit(20)
        ->get();

        return BookResource::collection($books);
    }
  

}
