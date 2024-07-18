<?php

use App\Models\Article;
use App\Models\Image;
use App\Models\User;
use App\Models\Video;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {

    $article = Article::find(2);
    $video = Video::find(3);
    $user = User::find(3);

    $comments = $user->comments;

    $imageComments = $comments->filter(function ($comment) {
        return $comment->commentable_type === Image::class;
    });

    $videoComment = $comments->filter(function ($comment) {
        return $comment->commentable_type === Video::class;
    });
    $articalComment = $comments->filter(function ($comment) {
        return $comment->commentable_type === Article::class;
    });


    $topRatedArticles = Article::with([
        'ratings' => function ($query) {
            $query->select(DB::raw('rateable_id, AVG(rating) as average_rating'))
                ->groupBy('rateable_id')
                ->orderBy('average_rating', 'desc')
                ->take(5);
        }
    ])->get();

    // dd($article->comments());
    // dd($video->ratings);
    // dd($user->comments());
    // dd($article->ratings()->avg('rating'));
    // dd($imageComments);
    // dd($videoComment);
    // dd($articalComment);
    dd($topRatedArticles);

    return view('welcome');
});
