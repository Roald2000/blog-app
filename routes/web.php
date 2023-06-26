<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserPostController;
use App\Models\UserPost;
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
    $posts =  UserPost::orderBy('created_at', 'desc')->get();
    return view('welcome', compact('posts'));
})->name('welcome');

//? Login Views
Route::get('/auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/auth/register', [AuthController::class, 'register'])->name('auth.register');

//? Authentication Requests
Route::post('/auth/create-user', [AuthController::class, 'createUser'])->name('auth.create-user');
Route::post('/auth/login-user', [AuthController::class, 'loginUser'])->name('auth.login-user');
Route::get('/auth/logout-user', [AuthController::class, 'logoutUser'])->name('auth.logout-user');


Route::middleware('auth')->group(function () {
    //* Profile
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'profile'])->name('profile.profile');
        Route::get('/check-profile/{id}', [ProfileController::class, 'checkProfile'])->name('profile.check-profile');
        Route::get('/setup-profile', [ProfileController::class, 'setupProfile'])->name('profile.setup-profile');
        Route::post('/create-update', [ProfileController::class, 'createOrUpdateProfile'])->name('profile.create-update');
    });

    //* Posts
    Route::prefix('post')->group(function () {
        Route::post('/', [UserPostController::class, 'createPost'])->name('post.create');
        Route::get('/delete/{id}', [UserPostController::class, 'deletePost'])->name('post.delete');
        Route::get('/edit/{id}', [UserPostController::class, 'edit'])->name('post.edit');
        Route::put('/edit/save/{id}', [UserPostController::class, 'saveEdit'])->name('post.edit-save');
        Route::get('/my-post', [UserPostController::class, 'myPosts'])->name('post.my-post');
    });

    //*Comments
    Route::post('/post-comment', [PostCommentController::class, 'createComment'])->name('post.post-comment');
    Route::get('/delete-comment/{id}', [PostCommentController::class, 'deleteComment'])->name('post.delete-comment');
});
