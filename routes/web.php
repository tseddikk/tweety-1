<?php

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
auth()->loginUsingId(1);

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/tweets', 'TweetsController@index')->name('home');
    Route::post('/tweets', 'TweetsController@store')->name('create-tweet');
    Route::delete('/tweets/{tweet}', 'TweetsController@destroy')->name('delete-tweet');


    Route::post('/tweets/{tweet}/like', 'TweetsLikesController@store')->name('like-tweet');
    Route::delete('/tweets/{tweet}/like', 'TweetsLikesController@destroy')->name('dislike-tweet');

    Route::post('/profiles/{user}/follow', 'FollowsController@store')->name('follows');
    Route::get('/profiles/{user}/edit', 'ProfilesController@edit')->middleware('can:edit,user')->name('edit-profile');
    Route::patch('/profiles/{user}', 'ProfilesController@update')->middleware('can:edit,user')->name('update-profile');
    Route::get('/explore', 'ExploreController')->name('explore');

    Route::get('/api/friends', 'FriendsController@index');
});

Route::get('/profiles/{user}', 'ProfilesController@show')->name('profile');
