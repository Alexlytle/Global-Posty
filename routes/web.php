<?php

use App\Models\Post;
use App\Models\User;
use App\Events\Hello;
use App\Models\BlockUser;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\UserPostController;
use App\Http\Controllers\AdminSpamController;
use App\Http\Controllers\AdminControllerAllUsers;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\LocationSearchController;
use App\Http\Controllers\AdminControllerBlockedUsers;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!envb
|
*/

Route::get('/tester', function () {

    $user =  User::get();
    dd($user[0]->blocked);
    // return view('pages.home');
});

// Route::get('/broadcast', function () {
//     broadcast(new Hello());
// });
// Route::view('home','home')->middleware('auth');

Route::get('/contacts',[ContactsController::class,'get']);
Route::get('/conversation/{id}',[ContactsController::class,'conversationFor']);
Route::post('/conversation/send',[ContactsController::class,'send']);


// Route::resource('/dashboard',UserDashboardController::class);

Route::get('/dashboard',[UserDashboardController::class,'index'])->name('dash-home');
Route::get('/dashboard/block-users',[UserDashboardController::class,'blockusers'])->name('block-users');
Route::get('/dashboard/change-password',[UserDashboardController::class,'changepassword'])->name('change-password');
Route::get('/dashboard/user-info',[UserDashboardController::class,'userInfo'])->name('user-info');
Route::get('/dashboard/deactivate-account',[UserDashboardController::class,'deactivateaccount'])->name('deactivate-account');
Route::get('/dashboard/location',[UserDashboardController::class,'add_location'])->name('add_location');
//crud
Route::delete('/dashboard/{id}/delete-block',[UserDashboardController::class,'delete_block'])->name('delete_block');
Route::post('/dashboard/update/update-location',[UserDashboardController::class,'update_location'])->name('update_location');

Route::post('/dashboard/{user}/user-info',[UserDashboardController::class,'update_user_info'])->name('update_user_info');


// Route::post('/posts/{post}/like',[LikeController::class,'store'])->name('posts.like');
Route::post('/posts/{post}/likes', [LikeController::class, 'store'])->name('posts.likes');
Route::post('/posts/{post}/block', [PostController::class, 'block'])->name('posts.block');
Route::get('/users/{user}/posts', [UserPostController::class, 'index'])->name('users.posts');
Route::delete('/posts/{post}/likes', [LikeController::class, 'destroy'])->name('posts.likes.delete');
Route::post('/posts/{post}/report',[PostController::class,'report'])->name('posts.report');


Route::resource('/', PostController::class);

Route::get('/chat',[ChatController::class,'index'])->name('chat');
Route::get('/chat/{user}/send',[ChatController::class,'send'])->name('send');
Route::post('/chat/send',[ChatController::class,'send_post'])->name('send.post');


//search

Route::get('/location/{placename}/placename',[LocationSearchController::class,'getPlaceName'])->name('placename');
Route::get('/location/{country}/country',[LocationSearchController::class,'getCountry'])->name('country');
Route::get('/location/{state}/state',[LocationSearchController::class,'getState'])->name('state');


Route::group(['prefix'=>'dashboard','middleware'=>'auth'],function(){
        Route::get('/admin', [AdminControllerAllUsers::class,'admin']);
        Route::resource('/blocked', AdminControllerBlockedUsers::class);
        Route::resource('/users', AdminControllerAllUsers::class);
        Route::resource('/spam', AdminSpamController::class);
});

Route::get('/search',function(){
        return view('pages.search');
})->name('search');