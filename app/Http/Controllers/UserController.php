<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Reader;
use App\Models\Publisher;
use App\Models\Contributor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\PostResource;
use App\Http\Resources\CommentResource;

class UserController extends Controller
{

    public function timeline(User $user , $page)
    {
        $timeline = DB::table('timeline')
        ->where('user_id' , $user->id)
        ->orwhere(function($query) use ($user) {
            $query->where('type' , 'user')->where('type_id' , $user->id);
        })
        ->orderByDesc('created_at')
        ->offset( ( $page - 1 ) * 20 )
        ->limit(20)
        ->get();

        return $timeline;
    }

}
