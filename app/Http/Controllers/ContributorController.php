<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContributorController extends Controller
{
    public function all($order , $page)
    {

        $offset = ($page - 1) * 20;

        $asc_desc = 'desc';

        if ($order == 'name') {
            $asc_desc = 'asc';
        }

        $contributors = DB::table('user_help')
        ->whereNot('type' , 'publisher')
        ->orderBy($order , $asc_desc)
        ->offset($offset)
        ->limit(20)
        ->get();

        return $contributors;
    }

    public function one(User $user)
    {
        $actions = DB::table('book_user')
        ->where('user_id' , $user->id)
        ->pluck('action');

        return [
            'info' => [
                'name' => $user->name,
                'birth' => $user->contributor->birth
            ],
            'books_num' => $actions->countBy()->all()
        ];

        
    }
}
