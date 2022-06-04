<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function posts(User $user , $type, $page)
    {
       
        $offset = ($page - 1) * 20;

        $posts = $user->$type()->offset($offset)->limit(20)->get();

        return PostResource::collection($posts);
       
    }
    
}
