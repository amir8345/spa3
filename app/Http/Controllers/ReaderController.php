<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Reader;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

class ReaderController extends Controller
{
    public function all($order , $page)
    {
        $order_page = $this->order_page($order , $page);

        $readers = User::
        join('reader_numbers' , 'users.id' , '=' , 'reader_numbers.user_id')
        ->select('users.username' , 'users.name' , 'reader_numbers.*')
        ->orderBy($order , $order_page['asc_desc'])
        ->offset($order_page['offset'])
        ->limit(20)
        ->get();

        return ['data' => $readers];

    }


    public function one(User $user)
    {
        return [
            'info' => $user->reader,
            'numbers' => [
                'posts_by' => $user->posts_by()->count(),
                'comments_by' => $user->comments_by()->count(),
                'scores' => $user->scores()->count(),
                'suggestions' => $user->suggestions()->count(),
            ],
        ];
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
