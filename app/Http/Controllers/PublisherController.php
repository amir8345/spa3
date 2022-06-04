<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
use App\Http\Resources\UserResource;
use App\Models\BookHelp;
use App\Models\Publisher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublisherController extends Controller
{
    public function all($order , $page)
    {

        $offset = ($page - 1) * 20;

        $asc_desc = 'desc';

        if ($order == 'name') {
            $asc_desc = 'asc';
        }

        $publishers = DB::table('user_help')
        ->where('type' , 'publisher')
        ->orderBy($order , $asc_desc)
        ->offset($offset)
        ->limit(20)
        ->get();

        return $publishers;

    }

    public function one(User $user)
    {

        $books_id = $user->books->pluck('id');

        $contributors = DB::table('book_user')
        ->select('user_id', 'action')
        ->whereNot('action' , 'publisher')
        ->whereIn('book_id' , $books_id->toArray())
        ->distinct()
        ->pluck('action');

        $contributors_num = $contributors->countBy()->all();

        return [
            'info' => [
                'name' => $user->name,
            ],
            'books' => $user->books->count(),
            'contributors_num' => $contributors_num
        ];
        
    }

    public function contributors(User $user , $action , $order , $page)
    {
        // action: contributor types e.g. writers / translators ...
        
        $offset = ($page - 1) * 20;
        $asc_desc = 'desc';
        
        if ($order == 'name') {
            $asc_desc = 'asc';
        }
        
        $books_id = $user->books()->pluck('books.id');

        $contributors_id = DB::table('book_user')
        ->whereIn('book_id' , $books_id->toArray())
        ->where('action' , $action)
        ->pluck('user_id');

        $contributors = DB::table('user_help')
        ->whereIn('user_id' , $contributors_id->toArray())
        ->offset($offset)
        ->limit(20)
        ->get();

        return $contributors;

    }


  

}
