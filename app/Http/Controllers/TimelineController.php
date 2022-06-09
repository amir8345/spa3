<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use App\Models\Score;
use App\Models\Shelf;
use App\Models\Follow;
use App\Models\Reader;
use App\Models\Comment;
use App\Models\BookUser;
use App\Models\BookShelf;
use App\Models\Suggestion;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\BookResource;
use App\Http\Resources\LikeResource;
use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\ScoreResource;
use App\Http\Resources\FollowResource;
use App\Http\Resources\CommentResource;
use Illuminate\Support\Collection;

class TimelineController extends Controller
{
    public function user_timeline(User $user , $kind , $page)
    {
        
        $timeline = DB::table('timeline')
        
        ->where(function($query) use ($user) {
            
            return $query->where('user_id' , $user->id)
            ->orwhere(function($query) use ($user) {
                $query->where('type' , 'user')->where('type_id' , $user->id);
            });

        })
        
        ->where(function($query) use($kind) {
            if ($kind != 'all') {
                return $query->where('table' , $kind);
            }
            
        })
      
        ->whereNot(function($query) {
            $query->where('type' , 'user')->where('table' , 'suggestions');
        })
        
        ->orderByDesc('created_at')
        ->offset( ( $page - 1 ) * 20 )
        ->limit(20)
        ->get();
        
        return $this->timeline_details($timeline);
    }
    
    
    public function book_timeline(Book $book , $kind , $page)
    {

        $timeline = DB::table('timeline')
        ->where('type' , 'book')
        ->where('type_id' , $book->id)
        ->where(function($query) use($kind) {
            
            if ($kind != 'all') {
                return $query->where('table' , $kind);
            }
        
        })
        ->orderByDesc('created_at')
        ->offset( ( $page - 1 ) * 20 )
        ->limit(20)
        ->get(); 

        return $this->timeline_details($timeline);
    }
    
    public function homepage(User $user , $page)
    {
        
        $timeline = DB::table('timeline')
        ->whereIn('user_id' , $user->followings()->pluck('users.id')->toArray())
        ->whereNot(function($query) {
            $query->where('type' , 'user')->where('table' , 'suggestions');
        })
        ->orderByDesc('created_at')
        ->offset( ( $page - 1 ) * 20 )
        ->limit(20)
        ->get(); 
        
        return $this->timeline_details($timeline);
        
    }
    
    
    public function notification(User $user ,$page)
    {
        
        $timeline = DB::table('timeline')
        ->where('type' , 'user')
        ->where('type_id' , $user->id)
        ->orderByDesc('created_at')
        ->offset( ( $page - 1 ) * 20 )
        ->limit(20)
        ->get(); 
        
        return $this->timeline_details($timeline);

    }



    public function timeline_details(Collection $timeline)
    {

        $timeline_details = [];

        foreach ($timeline as $event) {
        // echo $event->table;
        // continue;
            switch ($event->table) {

                case 'likes':
                    $timeline_details[] = ['like' => new LikeResource( Like::find( $event->id ) ) ];
                    break;
                
                case 'comments':
                    $timeline_details[] = ['comment' => new CommentResource( Comment::find( $event->id ) ) ];
                    break;
                
                case 'posts':
                    $timeline_details[] = [ 'post' => new PostResource( Post::find( $event->id ) ) ];
                    break;
                
                case 'follows':
                    $timeline_details[] = ['follow' => new FollowResource( Follow::find( $event->id ) ) ];
                    break;
                
                case 'scores':
                    $timeline_details[] = ['score' => new ScoreResource( Score::find( $event->id ) ) ];
                    break;

                case 'book_user':

                    $book_user = BookUser::find( $event->id );

                    $timeline_details[] = ['book_user' => [
                        'user' => new UserResource( User::find($book_user->user_id) ),
                        'book' => new BookResource( Book::find($book_user->book_id) ),
                        'action' => $book_user->action,
                        'created_at' => $event->created_at
                        ] 
                    ];
                    break;

                case 'book_shelf':
                    $book_shelf = BookShelf::find($event->id);
                    $shelf = Shelf::find($book_shelf->shelf_id); 

                    $timeline_details[] = ['book_shelf' => [
                        'user' => new UserResource($shelf->user),
                        'book' => new BookResource( Book::find( $book_shelf->book_id) ),
                        'name' => $shelf->name,
                        'created_at' => $event->created_at
                    ] ];
                    break;
               
                case 'suggestions':

                    $suggestion = Suggestion::find($event->id);

                    $timeline_details[] = ['suggestion' => [
                        'user' => new UserResource( User::find( $suggestion->user_id ) ),
                        'book' => new BookResource( Book::find( $suggestion->book_id ) ),
                        'receiver' => $suggestion->receiver,
                        'reason' => $suggestion->reason,
                        'created_at' => $suggestion->created_at,
                    ] ];
                    break;
                
            }
        
        }

        return $timeline_details;
    }


}
