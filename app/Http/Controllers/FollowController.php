<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\FlareClient\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\UserResource;

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

        $types = ['publishers' , 'readers' , 'contributors'];
        $result = [];

        foreach ($types as $type) {
            $type_ids = DB::table($type)->pluck('user_id');
            $result[$type] = $user->$kind()->whereIn('users.id' , $type_ids->toArray())->count();
        }

        return $result;
    }

    public function follower_following(User $user , $kind , $type , $page)
    {

        // kind: followers or following
        // type: publisher / contributor / reader

        $offset = ($page - 1) * 20;

        $type_ids = DB::table($type)->orderByDesc('created_at')->pluck('user_id');

        $kind_ids = $user->$kind()
        ->whereIn('users.id' , $type_ids->toArray())
        ->offset($offset)
        ->limit(20)
        ->pluck('users.id');
        
        return UserResource::collection(User::whereIn('id' , $kind_ids->toArray())->get());

    }





}
