<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookHelp extends Model
{
    use HasFactory;

    protected $table = 'book_help';


    public function users()
    {
        return $this->belongsToMany(User::class , 'book_user' , 'book_id')->withPivot('action');
    }
}
