<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublisherController extends Controller
{
    public function all($order , $page)
    {

        $asc_desc = 'desc';

        if ($order == 'name') {
            $asc_desc = 'asc';
        }

        $offset = ($page - 1) * 20;

        $publishers = DB::table('main_publisher')
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
        ->select('user_id')
        ->whereNot('action' , 'publisher')
        ->whereIn('book_id' , $books_id->toArray())
        ->distinct()
        ->count();


        return $contributors;

        return [
            'info' => [
                'name' => $user->name,
            ],
            'followers' => $user->followers->count(),
            'books' => $user->books->count(),
            ''
        ];
        
    }

    // public function contributors(MainPublisher $publisher , $contributor_type , $order , $page)
    // {

    //     $offset = ($page - 1) * 20;
    //     $asc_desc = 'desc';

    //     if ($order == 'name') {
    //         $asc_desc = 'asc';
    //     }

    //     $contributor_ids = $publisher
    //     ->contributors()
    //     ->where('action' , $contributor_type)
    //     ->pluck('contributor_id');
        
    //     $contributors = MainContributor::whereIn('id' , $contributor_ids->toArray())
    //     ->orderBy($order , $asc_desc)
    //     ->offset($offset)
    //     ->limit(20)
    //     ->get();

    //     return MainContributorResource::collection($contributors);

    // }

}
