<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostsApiController;
use App\Http\Controllers\CategoriesApiController;


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
//get analityque data
Route::get("/Dashboard", [DashboardController::class,'index']);
//get all posts
Route::get("/Posts", [PostsApiController::class,'index']);
//get post details by its id
Route::get("/Posts/{id}", [PostsApiController::class,'getPost']);
//delete a post by its id
Route::delete("/Posts/{id}", [PostsApiController::class,'DeletePost']);
//get all categories
Route::get("/Categories", [CategoriesApiController::class,'index']);
//create a new post
Route::post("/Posts/New", [PostsApiController::class,'store']);
//update a post by its id
Route::put("/Posts/{id}", [PostsApiController::class,'UpdatePost']);



