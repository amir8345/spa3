<?php

namespace App\Models;

use App\Models\Post;
use App\Models\User;
use App\Models\Score;
use App\Models\Shelf;
use App\Models\Comment;
use App\Models\Suggestion;
use App\Models\BookNumbers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $hidden = ['users' , 'shelves' , 'suggestions'];

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('action');
    }
   
    public function shelves()
    {
        return $this->belongsToMany(Shelf::class);
    }
    
    public function posts_on()
    {
        return $this->morphMany(Post::class , 'posted');
    }

    public function comments_on()
    {
        return $this->morphMany(Comment::class , 'commented');
    }

    public function scores()
    {
        return $this->hasMany(Score::class , 'book_id');
    }

    public function suggestions()
    {
        return $this->hasMany(Suggestion::class);
    }

    public function book_numbers()
    {
        return $this->hasOne(BookNumbers::class);
    }

}
