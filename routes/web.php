<?php

use App\Http\Controllers\ChannelController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\RegisterControlller;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
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



Route::controller(VideoController::class)->group(function()
{
    Route::get('/','home')->name('home');
    Route::get('/search','search')->name('search');
    Route::get('/Like_Video','like_video')->name('like_video')->middleware('Login');
});


Route::controller(DetailController::class)->group(function()
{
    Route::get('/Video/{id}','index')->name('Detail');
    Route::get('/subscribe/{id}','subscribe')->name('subscribe');
    Route::get('/unSub/{id}','unSub')->name('unSub');
});

Route::controller(LoginController::class)->group(function()
{
    Route::get('/Login','show')->name('login');
    Route::post('/authenticate', 'authenticate')->name('auth');
    Route::get('/logout','logout')->name('logout');
});

Route::controller(RegisterControlller::class)->group(function()
{
    Route::get('/Register','show')->name('register');
    Route::post('/RegisterStart','register')->name('register.start');
});

Route::controller(CommentController::class)->group(function()
{
    Route::POST('/comment/{comment}','Comment')->name('comment')->middleware('Login'); 
    Route::get('/Deletecomment/{id}','Delete')->name('comment.delete');
});

Route::controller(UserController::class)->group(function()
{
    Route::get('/User','index')->name('User.show')->middleware('Login');
    Route::POST('/User/{id}','update')->name('User.update');
});

Route::controller(ChannelController::class)->group(function()
{
    Route::get('/chanel/{id}','index')->name('Channel.show')->middleware('Login');
    Route::get('/Edit_Channel/{id}','edit')->name('Channel.edit');
    Route::post('/update/{id}','update')->name('Channel.update');
    Route::get('/Add_Video','create')->name('Channel.create');
    Route::Post('/Store_Video','store')->name('Channel.store');
    Route::get('/Delete_Video/{id}','delete')->name('Channel.delete');

    Route::get('/ChannelName/{id}','channel')->name('Channel');
});

Route::controller(LikeController::class)->middleware('Login')->group(function()
{
    Route::get('/like/{id}','like')->name('like');
    Route::get('/dislike/{id}','dislike')->name('dislike');
});

Route::controller(SubscribeController::class)->middleware('Login')->group(function()
{
    Route::get('/subscribed_channel','index')->name('sub_channel');
    Route::get('/subscribe/{id}','subscribe')->name('subscribe');
    Route::get('/unSub/{id}','unSub')->name('unSub');
});

Route::controller(MailController::class)->middleware('Login')->group(function()
{
    Route::get('mail/','index')->name('mail');
    Route::get('sendmail/','send')->name('sendmail');
});

