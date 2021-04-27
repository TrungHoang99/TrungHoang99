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

Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('/logout', function () {
    return redirect($request);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('profile/{name}','AuthorController@profile')->name('pages.user');

Route::get('/home/category', 'HomeController@category')->name('home.category');

Route::get('post/details/post_{id}','PostController@details')->name('post.details');

Route::get('/category/{title}','PostController@postByCategory')->name('category.posts');

Route::get('/search','SearchController@search')->name('search');

Route::get('profile/{name}','UserController@profile')->name('user.profile');

Route::group(['middleware'=>['auth']], function (){
    Route::post('comment/{post}','CommentController@store')->name('comment.add');
    Route::post('comment-reply/{comment}','CommentReplyController@store')->name('reply.add');

    Route::delete('comment-reply/{id}','CommentReplyController@destroy')->name('reply.destroy');
 });

//Admin
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function(){
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    Route::resource('category', 'CategoryController');
    Route::resource('post', 'PostController');

    Route::get('settings','SettingController@index')->name('settings');
    Route::put('profile-update', 'SettingController@updateProfile')->name('profile.update');
    Route::put('password-update','SettingController@updatePassword')->name('password.update');

    Route::get('pending/post', 'PostController@pending')->name('post.pending');
    Route::put('/post_{id}/approve', 'PostController@approval')->name('post.approve');

    Route::get('comment','CommentController@index')->name('comment.index');
    Route::delete('comment_{id}','CommentController@destroy')->name('comment.destroy');

    Route::get('users', 'UserController@index')->name('users.index');
    Route::delete('users/{id}', 'UserController@destroy')->name('users.destroy');
});

//User
Route::group(['prefix' => 'user', 'as' => 'user.', 'namespace' => 'User', 'middleware' => ['auth', 'user']], function(){
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    Route::resource('post', 'PostController');
    Route::get('post/pending', 'PostController@postPending')->name('post.pending');

    Route::get('personal/profile','PersonalController@changeProfile')->name('personal.profile');
    Route::put('profile-update', 'PersonalController@updateProfile')->name('profile.update');
    Route::get('personal/password', 'PersonalController@changePassword')->name('personal.password');
    Route::put('password-update', 'PersonalController@updatePassword')->name('password.update');

    Route::get('comment','CommentController@index')->name('comment.index');
    Route::delete('comment_{id}','CommentController@destroy')->name('comment.destroy');

});