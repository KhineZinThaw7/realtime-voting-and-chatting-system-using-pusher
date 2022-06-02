<?php

use App\Events\UserVotedEvent;
use App\Models\User;
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

Route::get('/vote/{id}', function($id) {
   $user = User::findOrFail($id);
   $user->vote++;
   $user->update();

   event(new UserVotedEvent($user));
   $user->notify(new UserVoted(Auth::user()));
    return back()->withSuccess("You are now voted for {$user->name}");
});

Route::get('/vote-list', function() {
    $user = User::findOrFail(Auth::id());
    $notification = $user->unreadNotifications()->get();
    
    return view('vote-list', [
        'notification' => $notification
    ]);
});

Route::get('/vote-read/{id}', function($id) {
    $user = User::findOrFail(Auth::id());

    $notification = $user->notifications()->where('id', $id)->first();

    if ($notification) {
        $notification->markAsRead();
    }

    --$user->vote;
    $user->update();
    return back();
});

Route::get('/dashboard', function () {
    $users = User::where('id', '!=', Auth::id())->get();
    return view('dashboard', compact('users'));
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
