<?php

    use App\Http\Controllers\FollowerController;
    use App\Http\Controllers\Post\PostController;
    use App\Http\Controllers\ProfileController;
    use App\Http\Controllers\User\UserController;
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
    return view('welcome');
});

Route::post('/posts/{post}/comment',[PostController::class,'storeComment'])
    ->name('posts.storeComment')
    ->middleware('auth');

Route::get('/comments/{comment}/likes',[PostController::class,'usersWhoLikeComment'])
    ->name('posts.usersWhoLikeComment')
    ->middleware('auth');

Route::post('/user/{user}/follow',[FollowerController::class,'follow'])
    ->name('users.follow')
    ->middleware('auth');

Route::post('/posts/{post}/comment/{comment}',[PostController::class,'likeComment'])
    ->name('posts.likeComment')
    ->middleware('auth');

Route::resource('users', UserController::class)
    ->only('show')
    ->middleware('auth');

Route::post('/posts/{post}/like',[PostController::class,'markAsFavourite'])
    ->name('posts.markAsFavourite')
    ->middleware('auth');

Route::resource('posts', PostController::class)
    ->name('index','dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
