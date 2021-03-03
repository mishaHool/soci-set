<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataCotroller;
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

Route::get('/', [DataCotroller::class, 'distributor']);
Route::get('/log-in', [DataCotroller::class, 'logIn']);
Route::post('/sign-up', [DataCotroller::class, 'signUp']);
Route::get('/drop', [DataCotroller::class, 'dropSession']);
Route::get('/profile', [DataCotroller::class, 'profile']);
Route::get('/write-post', [DataCotroller::class, 'write_post']);
Route::post('/add-post', [DataCotroller::class, 'add_post']);
Route::get('/main', [DataCotroller::class, 'main_render'])->name('main');
Route::get('/read', [DataCotroller::class, 'post_render']);
Route::post('/add-comment', [DataCotroller::class, 'add_comment']);
// Route::post('/upload', [DataCotroller::class, 'upload']);