<?php

namespace App\Models;

use App\Models\Post;
use App\Models\User;
use App\Models\Score;
use App\Models\Shelf;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
   
    public function shelves()
    {
        return $this->belongsToMany(Shelf::class);
    }
    
    public function posts()
    {
        return $this->morphMany(Post::class , 'posted');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class , 'commented');
    }

    public function scores()
    {
        return $this->hasMany(Score::class , 'book_id');
    }
}
