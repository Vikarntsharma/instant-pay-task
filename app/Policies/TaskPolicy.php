<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use App\Models\Board;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Task $task)
    {
        // Allow viewing if the user owns the board associated with the task
        return $user->id === $task->board->user_id;
    }

    public function create(User $user, Task $task)
    {
        // Allow creation if the user owns the board associated with the task
        return $user->id === $task->board->user_id;
    }

    public function update(User $user, Task $task)
    {
        // Allow updates if the user owns the board associated with the task
        return $user->id === $task->board->user_id;
    }
    
    public function delete(User $user, Task $task)
    {
        // Allow deletion if the user owns the board associated with the task
        return $user->id === $task->board->user_id;
    }
}
