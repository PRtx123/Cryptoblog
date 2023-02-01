<?php

use App\Http\Controllers\CRUD\CommentsController;
use App\Http\Controllers\CRUD\FeedbacksController;
use App\Http\Controllers\CRUD\LikesController;
use App\Http\Controllers\CRUD\PostsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome', [
        'posts' => \App\Models\Admin\Posts::paginate(5)
    ]);
})->name('index');

Route::get('/auth', function (){
    return view('auth');
})->name('auth');

Route::post('/auth_user', [\App\Http\Controllers\LoginController::class, 'loginUser'])->name('loginUser');
Route::post('/auth_admin', [\App\Http\Controllers\LoginController::class, 'loginAdmin'])->name('loginAdmin');
Route::post('/logout_user', [\App\Http\Controllers\LoginController::class, 'logoutUser'])->name('logoutUser');
Route::post('/logout_admin', [\App\Http\Controllers\LoginController::class, 'logoutAdmin'])->name('logoutAdmin');

Route::get('/registration', function (){
    return view('registration');
})->name('registration');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contacts', function () {

});

Route::resource('users',UserController::class);
Route::put('users/ban/{user}', [UserController::class, 'ban'])->name('users.ban');
Route::put('users/unban/{user}', [UserController::class, 'unban'])->name('users.unban');

Route::resource('posts', PostsController::class);
Route::resource('comments', CommentsController::class);
Route::resource('likes', LikesController::class);
Route::resource('feedbacks', FeedbacksController::class);

Route::prefix('/user')->group(function () {

    Route::middleware(['auth:web'])->group(function () {

        Route::get('/profile', function() {
            // инфа о пользователе
            // смена пароля/email
            return view('users.profile', [
                'likedPosts' => \Illuminate\Support\Facades\Auth::user()->getLikedPosts()
            ]);
        })->name('user.profile');

        Route::get('/favorites', function() {
            // избранные посты
        });

    });


});

Route::prefix('/admin')->group(function() {

    Route::get('/login', function() {
        return view('admin.login');
    })->name('admin.login');

    Route::middleware(['auth:admins'])->group(function () {

        Route::get('/panel', function () {
            return view('admin.panel', [
                'postsCount' => \App\Models\Admin\Posts::all()->count(),
                'usersCount' => \App\Models\User::all()->count(),
                'likesCount' => \App\Models\Likes::all()->count(),
                'commentsCount' => \App\Models\Comments::all()->count(),
                'feedbacks' => \App\Models\Feedbacks::paginate(5)
            ]);
        })->name('admin.panel');

        Route::get('/posts', function () {
            return view('admin.posts', [
                'posts' => \App\Models\Admin\Posts::paginate(5)
            ]);
        })->name('admin.posts');

        Route::get('/users', function () {
            //таблица пользователей и работа с ними

            return view('admin.users', [
                'users' => \App\Models\User::paginate(5)
            ]);
        })->name('admin.users');

        Route::get('/settings', function () {
            //форма для редактирования соц сетей, названия сайта, смена пароля
        });

        Route::get('/feedbacks', function () {
            //таблица с обращениями читателей
        });

    });

});
