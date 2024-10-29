<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{UserController, BoardController, TaskController};

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

Route::get('/', function () {
    return view('auth.login'); // Returns the login view when the root URL is accessed
});

// Route to display the dashboard, protected by authentication and email verification
Route::get('/dashboard', function () {
    return view('dashboard'); // Returns the dashboard view for authenticated and verified users
})->middleware(['auth', 'verified'])->name('dashboard');

// Grouping of routes that require authentication
Route::middleware('auth')->group(function () {
    // Resource routes for managing boards
    Route::resource('boards', BoardController::class);
    
    // Resource routes for managing tasks associated with boards, using shallow nesting
    Route::resource('boards.tasks', TaskController::class)->shallow();
});

require __DIR__.'/auth.php';
