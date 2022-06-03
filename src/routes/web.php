<?php

use App\Events\MessageSent;
use App\Events\PostVoting;
use App\Events\UserVotedEvent;
use App\Http\Controllers\PostController;
use App\Models\Post;
use App\Models\User;
use App\Notifications\SentMessage;
use App\Notifications\UserVoted;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/testing', function() {
    return Artisan::call('show:users');
});

Route::get('/dashboard', function () {
    $users = User::where('id', '!=', Auth::id())->get();

    $auth = User::findOrFail(Auth::id());
    return view('dashboard', compact('users'));
})->middleware(['auth'])->name('dashboard');

Route::get('/chatting', function() {
    return view('chatting');
})->name('chatting');

Route::post('/sent-message/{id}', function($id) {
    $user = User::findOrFail($id);
    $noti = $user->notifications()->count();
    event(new MessageSent($user, $noti, request()->message));
    $user->notify(new SentMessage(Auth::user(), request()->message));
    return back();
});

Route::get('/message-list', function() {
    $user = User::findOrFail(Auth::id());
    $notification = $user->unreadNotifications()->get();
    
    return view('message-list', [
        'notification' => $notification
    ]);
});

Route::get('/message-read/{id}', function($id) {
    $user = User::findOrFail(Auth::id());

    $notification = $user->notifications()->where('id', $id)->first();

    if ($notification) {
        $notification->markAsRead();
    }

    --$user->vote;
    $user->update();
    return back();
});

Route::get('/post-vote/{id}', function($id) {
    $post = Post::findOrFail($id);
    ++$post->vote;
    $post->update();
    event(new PostVoting($post));
    return $post;
});

Route::resource('/posts', PostController::class);

require __DIR__.'/auth.php';

