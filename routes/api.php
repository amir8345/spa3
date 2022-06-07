<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\ShelfController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\ContributorController;
use App\Http\Controllers\Crawler\BookResources;
use App\Http\Controllers\ReaderController;
use App\Http\Controllers\SocialMediaController;
use App\Http\Controllers\SuggestionController;
use App\Http\Controllers\TimelineController;

// // login
// Route::post('/login' , [LoginController::class , 'login']);
// Route::get('/login/send_code' , [LoginController::class , 'send_code']);
// Route::post('/login/code_verification' , [LoginController::class , 'code_verification']);
// Route::post('/login/set_username_password' , [LoginController::class , 'set_username_password']);
// Route::post('/login/password_check' , [LoginController::class , 'password_check']);
// Route::post('/login/update_password' , [LoginController::class , 'update_password']);
// Route::get('/login/disposable_code' , [LoginController::class , 'disposable_code']);
// Route::get('/login/logout' , [LoginController::class , 'logout']);


// // crawl
// Route::get('/crawl' , [BookResources::class , 'extract_resource']);


// // user
// Route::get('/users/{order}/{page}' , [UserController::class , 'get_users']);
// Route::get('/user/{user}' , [UserController::class , 'one'])->name('user');


// // book
Route::get('/books/{order}/{page}' , [BookController::class , 'all']);
// ->name('books');
Route::get('/book/{book}' , [BookController::class , 'one']);
// ->name('book');
// Route::get('/book/{book}/scores' , [BookController::class , 'scores']);

// Route::post('/book/add_to_shelf' , [BookController::class , 'add_to_shelf']);
// Route::post('/book/remove_from_shelf' , [BookController::class , 'remove_from_shelf']);
Route::get('/user/{user}/books/{action}/{order}/{page}' , [BookController::class , 'books']);

// // * when a user has finished reading a book and want to change it's stauts from reading to read
// Route::post('/book/update_book_status' , [BookController::class , 'update_book_status']);

// Route::get('/shelf/{shelf}/books/{order}/{page}' , [BookController::class , 'shelf_books']);

// Route::get('/contributor/{contributor}/books/{type}/{order}/{page}' , [BookController::class , 'contributor_books']);
// Route::get('/book/{book}/shelves' , [BookController::class , 'shelves']);
Route::get('/book/{book}/timeline/{page}' , [BookController::class , 'timeline']);

// // contributor 
Route::get('/contributors/{order}/{page}' , [ContributorController::class , 'all']);
// ->name('contributors');
Route::get('/contributor/{user}' , [ContributorController::class , 'one']);
// ->name('contributor');


// // publisher
Route::get('/publishers/{order}/{page}' , [PublisherController::class , 'all']);
// ->name('publishers');
Route::get('/publisher/{user}' , [PublisherController::class , 'one']);
// ->name('publisher');
Route::get('/publisher/{user}/contributors/{action}/{order}/{page}' , [PublisherController::class , 'contributors']);



// // like
// Route::post('/toggle_like' , [LikeController::class , 'toggle_like']);
// Route::get('/likers/{type}/{id}' , [LikeController::class , 'likers']);


// // post
// Route::post('/post/add' , [PostController::class , 'add']);
// Route::post('/post/delete' , [PostController::class , 'delete']);
// Route::post('/post/update' , [PostController::class , 'update']);
// Route::get('/post/{post}' , [PostController::class , 'show'])
// ->name('post');
// Route::get('/posts/{type}/{id}/{page}' , [PostController::class , 'get_posts']);
Route::get('/{kind}/{id}/posts/{type}/{page}' , [PostController::class , 'posts']);


// // comment
// Route::post('/comment/add' , [CommentController::class , 'add']);
// Route::post('/comment/delete' , [CommentController::class , 'delete']);
// Route::post('/comment/update' , [CommentController::class , 'update']);
// Route::get('/comment/{comment}' , [CommentController::class , 'show'])
// ->name('comment');
// Route::get('/comments/{type}/{id}/{page}' , [CommentController::class , 'get_comments']);
Route::get('/{kind}/{id}/comments/{type}/{page}' , [CommentController::class , 'comments']);


// // shelf
// Route::post('/shelf/add' , [ShelfController::class , 'add']);
// Route::post('/shelf/delete' , [ShelfController::class , 'delete']);
// Route::post('/shelf/update' , [ShelfController::class , 'update']);
// Route::get('/shelf/{shelf}/{page}' , [ShelfController::class , 'show'])
// ->name('shelf');
// Route::get('/user/{user}/library' , [ShelfController::class , 'library'])
// ->name('library');
// Route::get('/user/{user}/shelves' , [ShelfController::class , 'shelves']);
Route::get('/book/{book}/shelves' , [ShelfController::class , 'shelves']);

// // score
// Route::post('/score/add_or_update' , [ScoreController::class , 'add_or_update_score']);
// Route::post('/score/delete' , [ScoreController::class , 'delete']);
Route::get('/scores/{type}/{id}/{page}' , [ScoreController::class , 'scores']);


// // follow
// Route::post('/follow_add' , [FollowController::class , 'add']);
// Route::post('/follow_delete' , [FollowController::class , 'delete']);
// Route::post('/follow_update' , [FollowController::class , 'update']);
Route::get('/user/{user}/{kind}/{type}/{page}' , [FollowController::class , 'follower_following']);
Route::get('/user/{user}/follows/total_count' , [ FollowController::class , 'total_count' ]);
Route::get('/user/{user}/{kind}/type_count' , [ FollowController::class , 'type_count' ]);
// // suggestion
// Route::post('/suggestion/add' , [SuggestionController::class , 'add']);
// Route::post('/suggestion/delete' , [SuggestionController::class , 'delete']);
// Route::post('/suggestion/update' , [SuggestionController::class , 'update']);
Route::get('/suggestions/{type}/{id}/{page}' , [SuggestionController::class , 'suggestions']);

// // wall
// Route::get('/timeline/{page}' , [TimelineController::class , 'all']);

// social media
Route::get('/user/{user}/social_medias' , [ SocialMediaController::class , 'social_medias' ]);

// reader
Route::get('/readers/{order}/{page}' , [ReaderController::class , 'all']);
Route::get('/reader/{user}' , [ReaderController::class , 'one']);

// timeline
Route::get('/user/{user}/timeline/{page}' , [UserController::class , 'timeline']);