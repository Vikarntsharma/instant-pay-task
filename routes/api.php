<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Api\{UserController, BoardController, TaskController};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| This file is where you can register API routes for your application.
| These routes are loaded by the RouteServiceProvider within a group
| that is assigned the "api" middleware group, which applies common 
| configurations to the API routes.
|
*/

// User authentication routes (public access)
Route::post('/signup', [UserController::class, 'signup']); // Register a new user
Route::post('/login', [UserController::class, 'login']); // Log in an existing user

// Protected routes requiring authentication via Sanctum
Route::middleware('auth:sanctum')->group(function() {
    
    // User routes
    Route::get('/users', [UserController::class, 'index']); // List all users
    Route::get('/users/{id}', [UserController::class, 'show']); // Show a specific user by ID

    // Board routes
    Route::get('/boards', [BoardController::class, 'index']); // Get all boards for the authenticated user
    Route::post('/boards', [BoardController::class, 'store']); // Create a new board
    Route::put('/boards/{board}', [BoardController::class, 'update']); // Update a specific board by ID
    Route::delete('/boards/{board}', [BoardController::class, 'destroy']); // Delete a specific board by ID

    // Task routes (nested within specific boards)
    Route::get('/boards/{board}/tasks', [TaskController::class, 'index']); // Get all tasks for a specific board
    Route::post('/boards/{board}/tasks', [TaskController::class, 'store']); // Create a new task within a specific board
    Route::put('/boards/{board}/tasks/{task}', [TaskController::class, 'update']); // Update a specific task within a board
    Route::delete('/boards/{board}/tasks/{task}', [TaskController::class, 'destroy']); // Delete a specific task within a board

});
