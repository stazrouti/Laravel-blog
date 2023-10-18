<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostsApiController;
use App\Http\Controllers\CategoriesApiController;
use App\Http\Controllers\UsersApiController;
use App\Http\Controllers\ContactController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//get analytique data
Route::get("/Dashboard", [DashboardController::class,'index']);
//get all posts
Route::get("/Posts", [PostsApiController::class,'index']);
//create a new post
Route::post("/Posts/New", [PostsApiController::class,'store']);
//update a post by its id
Route::put("/Posts/{id}", [PostsApiController::class,'UpdatePost']);
//get post details by its id
Route::get("/Posts/{id}", [PostsApiController::class,'getPost']);
//delete a post by its id
Route::delete("/Posts/{id}", [PostsApiController::class,'DeletePost']);

//delete a comment by its id
Route::delete("/Comment/{id}", [PostsApiController::class,'DeleteComment']);
//get all categories
Route::get("/Categories", [CategoriesApiController::class,'index']);
//New category
Route::post("/Categories", [CategoriesApiController::class,'store']);
//Delete category
Route::delete("/Categories/{id}", [CategoriesApiController::class,'Delete']);
//Update category
Route::put("/Categories/{id}", [CategoriesApiController::class,'Update']);

//get users info
Route::get("/Users", [UsersApiController::class,'index']);
//delete a user
Route::delete("/Users/{id}", [UsersApiController::class,'Delete']);
//update user info
Route::put("/Users/{id}", [UsersApiController::class,'Update']);
//get contact messages
Route::get("/Contact", [ContactController::class,'index']);
Route::put("/Contact/Read/{id}", [ContactController::class,'State']);
Route::delete("/Contact/{id}", [ContactController::class,'Delete']);






