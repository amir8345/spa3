<?php

namespace App\Models;

use App\Models\Like;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    public function likes()
    {
        return $this->morphMany(Like::class , 'liked');
    }

    public function comments_on()
    {
        return $this->morphMany(Comment::class , 'commented');
    }

}
