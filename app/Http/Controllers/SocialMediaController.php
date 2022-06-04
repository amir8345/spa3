<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SocialMediaController extends Controller
{
    public function get(User $user)
    {
        return $user->social_medias;
    }
}
