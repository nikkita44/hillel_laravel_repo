<?php

use App\Http\Controllers\PostController;
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

Route::get('/', [PostController::class, 'index']);

Route::get('/author/{id}', [PostController::class, 'author'])->name('author.posts');
Route::get('/author/{id}/category/{category_id}', [PostController::class, 'author_category'])->name('author.category.posts');
Route::get('/author/{id}/category/{category_id}/tag/{tag_id}', [PostController::class, 'author_category_tag'])->name('author.category.tag.posts');
Route::get('/category/{id}', [PostController::class, 'category'])->name('category.posts');
Route::get('/tag/{id}', [PostController::class, 'tag'])->name('tag.posts');

