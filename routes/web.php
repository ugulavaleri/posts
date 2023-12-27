<?php

    use App\Http\Controllers\CommentController;
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

    Route::resource('posts', PostController::class)
        ->name('index', 'dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::post('/posts/{post}/comment/{comment}', [CommentController::class, 'toggleLike'])
            ->name('comments.likeComment');
        Route::get('/comments/{comment}/likes', [CommentController::class, 'showLikes'])
            ->name('comments.showLikes');
        Route::resource('posts.comments', CommentController::class);

        Route::post('/user/{user}/follow', [FollowerController::class, 'toggleFollow'])
            ->name('users.toggleFollow');
        Route::resource('followers', FollowerController::class)
            ->only('index');

        Route::resource('users', UserController::class)
            ->only('show');

        Route::post('/posts/{post}/favourite', [PostController::class, 'markAsFavourite'])
            ->name('posts.markAsFavourite');
        Route::get('/favourite-posts', [UserController::class, 'myFavouritePosts'])
            ->name('users.myFavouritePosts');
    });

    require __DIR__ . '/auth.php';
