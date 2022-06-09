<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
use App\Http\Resources\UserResource;
use App\Models\BookHelp;
use App\Models\Publisher;
use App\Models\SocialMedia;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublisherController extends Controller
{
    public function all($order , $page)
    {

        $order_page = $this->order_page($order , $page);

        $publishers = DB::table('user_help')
        ->where('type' , 'publisher')
        ->orderBy($order , $order_page['asc_desc'])
        ->offset($order_page['offset'])
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
                'social_medias' => $user->social_medias
            ],
            'books' => $user->books->count(),
            'contributors_num' => $contributors_num
        ];
        
    }

    public function contributors(User $user , $action , $order , $page)
    {
        // action: contributor types e.g. writers / translators ...

        $order_page = $this->order_page($order , $page);
        
        $books_id = $user->books()->pluck('books.id');

        $contributors = DB::table('book_user')
        ->leftJoin('user_help' , 'user_help.user_id' , '=' , 'book_user.user_id')
        ->whereIn('book_user.book_id' , $books_id->toArray())
        ->where('action' , $action)
        ->distinct()
        ->orderBy($order , $order_page['asc_desc'])
        ->offset($order_page['offset'])
        ->limit(20)
        ->get();


        return $contributors;

    }


    public function order_page($order , $page)
    {

        $asc_desc = 'desc';

        if ($order == 'name') {
            $asc_desc = 'asc';
        }

        return [
            'offset' => ($page - 1) * 20,
            'asc_desc' => $asc_desc
        ];
    }






}
