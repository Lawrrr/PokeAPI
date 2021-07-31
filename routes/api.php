<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Contollers
use App\Http\Controllers\AuthController;

// Models
use App\Models\Pokemon;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // For testing of Pokemon model
    Route::get('pokemon/all', function () {
        return Pokemon::all();
    }); 
});
