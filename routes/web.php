<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\middleware\RedirectToPreviousPage;
use App\Http\middleware\VisitMiddleware;
use App\Http\Controllers\SearchController;

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
//this middleware save the visiter ip and time 
Route::group(['middleware' => 'VisitMiddleware'], function () {
    //posts routes
    Route::get('/', function () {
        return redirect('posts');
    });
    //manage posts
    Route::resource("posts", PostController::class);


    Route::group(['middleware' => 'RedirectToPreviousPage'], function () {
        Route::get('/sign-in', function () {
            return view('Authentification.SignIn');
        })->name('Sign-in'); 

        Route::get('/sign-up', function () {
            return view('Authentification.SignUp');
        })->name('Sign-up'); 
        
        Route::get('/Logout',[AuthController::class,'Logout']);
    });
    Route::post('/sign-up',[AuthController::class,'Signup']);
        Route::post('/sign-in',[AuthController::class,'Signin']);
    //show posts by  category
    Route::get('/categories/{id}', [CategoriesController::class, 'show'])->name('categories.show');
    //comment route
    Route::resource('comments', CommentController::class)->only(['store', 'destroy']);
    //like to + -  like
    Route::PUT('/Like/{id}', [PostController::class, 'UpdateLike'])->name('Like.UpdateLike');
    //Contact routes
    Route::get('/Contact',function ()  {
        return view('Header links.Contact');
    })->middleware('RedirectToPreviousPage');
    Route::post('/Contact',[ContactController::class,'Contact'])->name("Contact.submit");
    //about us
    Route::get('/About',function ()  {
        return view('Header links.About');
    });
    Route::get('/search',[SearchController::class,'Search'])->name('search');
});



// Email Verification Routes...





