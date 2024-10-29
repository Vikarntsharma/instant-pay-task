<?php

namespace App\Policies;

use App\Models\Board;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BoardPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given board can be viewed by the user.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Board  $board
     * @return bool
     */
    public function view(User $user, Board $board)
    {
        return $user->id === $board->user_id;
    }

    public function create(User $user, Board $board)
    {
        return $user->id === $board->user_id;
    }

    public function update(User $user, Board $board)
    {
        // Only allow the owner of the board to update it
        return $user->id === $board->user_id;
    }

    public function delete(User $user, Board $board)
    {
        return $user->id === $board->user_id;  // Only the board owner can delete the board
    }
}
