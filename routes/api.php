<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Contollers
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserLikesDislikesController;

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

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/trainers', [UserController::class, 'trainerList']);
    
    // User group
    Route::prefix('user')->group(function () {
        Route::get('/profile/get', [UserController::class, 'profile']);
        Route::post('/profile/update', [UserController::class, 'update']);
        Route::get('{id}/pokemon', [UserController::class, 'list']);

        Route::prefix('pokemon')->group(function () {
            Route::post('/remove', [UserLikesDislikesController::class, 'remove']);
            Route::post('/like', [UserLikesDislikesController::class, 'likePokemon']);
            Route::post('/dislike', [UserLikesDislikesController::class, 'dislikePokemon']);
        });
    });
});
