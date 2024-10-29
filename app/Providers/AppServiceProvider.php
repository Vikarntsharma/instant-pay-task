<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\Board;
use App\Policies\BoardPolicy;
use App\Models\Task;
use App\Policies\TaskPolicy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    protected $policies = [
        Board::class => BoardPolicy::class,  // Maps the Board model to the BoardPolicy for authorization checks
        Task::class => TaskPolicy::class,    // Maps the Task model to the TaskPolicy for authorization checks
    ];

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
    }
}
