<?php

use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\AdminTagController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Oauth\GitHubController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\GeoIpController;
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

Route::middleware(['guest'])->group(function(){
    Route::get('/auth/login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('/auth/handleLogin', [AuthController::class, 'handleLogin'])->name('auth.handle.login');

    Route::get('oauth/github/callback', GitHubController::class)->name('oauth.github.callback');

    Route::get('/geo', [GeoIpController::class, 'index']);
});

Route::middleware(['auth'])->group(function(){
    Route::get('/', [PostController::class, 'index'])->name('index');

    Route::get('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::get('/author/{id}', [PostController::class, 'author'])->name('author.posts');
    Route::get('/author/{id}/category/{category_id}', [PostController::class, 'author_category'])->name('author.category.posts');
    Route::get('/author/{id}/category/{category_id}/tag/{tag_id}', [PostController::class, 'author_category_tag'])->name('author.category.tag.posts');
    Route::get('/category/{id}', [PostController::class, 'category'])->name('category.posts');
    Route::get('/tag/{id}', [PostController::class, 'tag'])->name('tag.posts');

    Route::get('/admin/post', [AdminPostController::class, 'index'])->name('admin.post');
    Route::get('/admin/post/{id}/show', [AdminPostController::class, 'show'])->name('admin.post.show');
    Route::get('/admin/post/create', [AdminPostController::class, 'create'])->name('admin.post.create');
    Route::post('/admin/post/store', [AdminPostController::class, 'store'])->name('admin.post.store');
    Route::get('/admin/post/{id}/edit', [AdminPostController::class, 'edit'])->name('admin.post.edit');
    Route::post('/admin/post/update', [AdminPostController::class, 'update'])->name('admin.post.update');
    Route::get('/admin/post/{id}/destroy', [AdminPostController::class, 'destroy'])->name('admin.post.destroy');
    Route::post('/admin/post/comment/{id}/add', [AdminPostController::class, 'commentAdding'])->name('admin.post.add.comment');

    Route::get('/admin/category', [AdminCategoryController::class, 'index'])->name('admin.category');
    Route::get('/admin/category/{id}/show', [AdminCategoryController::class, 'show'])->name('admin.category.show');
    Route::get('/admin/category/create', [AdminCategoryController::class, 'create'])->name('admin.category.create');
    Route::post('/admin/category/store', [AdminCategoryController::class, 'store'])->name('admin.category.store');
    Route::get('/admin/category/{id}/edit', [AdminCategoryController::class, 'edit'])->name('admin.category.edit');
    Route::post('/admin/category/update', [AdminCategoryController::class, 'update'])->name('admin.category.update');
    Route::get('/admin/category/{id}/destroy', [AdminCategoryController::class, 'destroy'])->name('admin.category.destroy');
    Route::post('/admin/category/comment/{id}/add', [AdminCategoryController::class, 'commentAdding'])->name('admin.category.add.comment');

    Route::get('/admin/tag', [AdminTagController::class, 'index'])->name('admin.tag');
    Route::get('/admin/tag/{id}/show', [AdminTagController::class, 'show'])->name('admin.tag.show');
    Route::get('/admin/tag/create', [AdminTagController::class, 'create'])->name('admin.tag.create');
    Route::post('/admin/tag/store', [AdminTagController::class, 'store'])->name('admin.tag.store');
    Route::get('/admin/tag/{id}/edit', [AdminTagController::class, 'edit'])->name('admin.tag.edit');
    Route::post('/admin/tag/update', [AdminTagController::class, 'update'])->name('admin.tag.update');
    Route::get('/admin/tag/{id}/destroy', [AdminTagController::class, 'destroy'])->name('admin.tag.destroy');
    Route::post('/admin/tag/comment/{id}/add', [AdminTagController::class, 'commentAdding'])->name('admin.tag.add.comment');
});









