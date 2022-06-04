<?php

namespace App\Models;

use App\Models\Book;
use App\Models\Post;
use App\Models\Score;
use App\Models\Shelf;
use App\Models\Reader;
use App\Models\Comment;
use App\Models\BookHelp;
use App\Models\Publisher;
use App\Models\Suggestion;
use App\Models\Contributor;
use App\Models\SocialMedia;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function book_help()
    {
        return $this->belongsToMany(BookHelp::class , 'book_user' , 'user_id' , 'book_id');
    }

    public function books()
    {
        return $this->belongsToMany(Book::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function publisher()
    {
        return $this->hasOne(Publisher::class);
    }
  
    public function contributor()
    {
        return $this->hasOne(Contributor::class);
    }

    public function reader()
    {
        return $this->hasOne(Reader::class);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class , 'follows' , 'following' , 'follower')->wherePivot('status' , 'a');
    }
    
    public function followings()
    {
        return $this->belongsToMany(User::class , 'follows' , 'follower' , 'following')->wherePivot('status' , 'a');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function posts_by()
    {
        return $this->hasMany(Post::class);
    }

    public function posts_on()
    {
        return $this->morphMany(Post::class , 'posted');
    }
    
    public function scores()
    {
        return $this->hasMany(Score::class);
    }
    
    public function shelves()
    {
        return $this->hasMany(Shelf::class);
    }

    public function social_medias()
    {
        return $this->hasMany(SocialMedia::class);
    }

    public function suggestions()
    {
        return $this->hasMany(Suggestion::class);
    }

}
