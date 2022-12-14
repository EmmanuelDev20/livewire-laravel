<?php

use App\Http\Livewire\ArticleForm;
use App\Http\Livewire\Articles;
use App\Http\Livewire\ArticleShow;
use App\Models\User;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', Articles::class)->name('articles.index');
Route::get('/blog/crear', ArticleForm::class)->name('articles.create');
Route::get('/blog/{article}', ArticleShow::class)->name('articles.show');
Route::get('/blog/{article}/edit', ArticleForm::class)->name('articles.edit');

// Route::get('/search', function () {
//     return view('partials.users', [
//         'users' => User::where('name', 'LIKE', '%'.request('q').'%')->get()
//     ]);
// });
