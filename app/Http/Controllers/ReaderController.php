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

        return $readers;

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
