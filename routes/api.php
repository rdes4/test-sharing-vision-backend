<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('article', [PostController::class, 'createPost']);
Route::get('article', [PostController::class, 'getAllPosts']);
Route::get('article/{id}', [PostController::class, 'getPostById']);
Route::put('article/{id}', [PostController::class, 'updatePost']);
Route::delete('article/{id}', [PostController::class, 'deletePost']);