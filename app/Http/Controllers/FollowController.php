<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\FlareClient\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\UserResource;
use App\Models\BookUser;

class FollowController extends Controller
{
    public function total_count(User $user)
    {
        return [
            'followers' => $user->followers->count(),
            'followings' => $user->followings->count(),
        ];
    }

    public function type_count(User $user , $kind)
    {
        // kind: followers or followings

        $cnotributors = $this->make_follow_query($user , $kind)
        ->addSelect( 'users.id' , 'book_user.action' )
        ->distinct()
        ->get();

        foreach ($cnotributors as $cnotributor) {
            $contributors_count[] = $cnotributor['action'];
        }

        return collect($contributors_count)->countBy();
    }

    public function follower_following(User $user , $kind , $action , $page)
    {
        $cnotributors = $this->make_follow_query($user , $kind)
        ->where('book_user.action' , $action)
        ->distinct()
        ->offset( ($page - 1) * 20 )
        ->limit(20)
        ->get();

        return $cnotributors;

    }


    public function make_follow_query(User $user , $kind)
    {
        return $user->$kind()->join('book_user' , 'users.id' , '=' , 'book_user.user_id');
    }

}
