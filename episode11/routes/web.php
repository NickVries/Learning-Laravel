<?php

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

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\TagsController;
use Illuminate\Support\Facades\Route;

Route::get('/', PostsController::class . '@index')->name('home');
Route::get('/posts/create', PostsController::class . '@create');
Route::get('/posts/{post}', PostsController::class . '@show');
Route::post('/posts', PostsController::class . '@store');

Route::post('/posts/{post}/comments', CommentsController::class . '@store');

Route::get('/register', RegistrationController::class . '@create');
Route::post('/register', RegistrationController::class . '@store');

Route::get('/login', SessionsController::class . '@create')->name('login');
Route::post('/sessions', SessionsController::class . '@store');
Route::get('/logout', SessionsController::class . '@destroy');

Route::get('/posts/tags/{tag}', TagsController::class . '@index');
