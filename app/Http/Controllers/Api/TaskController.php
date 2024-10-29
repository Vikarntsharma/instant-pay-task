<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\Task;

class TaskController extends Controller
{
    public function index(Board $board)
    {
        // Authorize the user to view the board's tasks
        $this->authorize('view', $board);

        // Fetch tasks associated with the board
        $tasks = $board->tasks;

        // Return JSON response
        return response()->json([
            'message' => 'Tasks retrieved successfully',
            'data' => $tasks
        ], 200);
    }

    public function store(Request $request, Board $board)
    {
        // Authorize the user to create a task on the board
        $this->authorize('create', $board);

        // Validate request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Create task associated with the board
        $task = $board->tasks()->create($validatedData);

        // Return JSON response
        return response()->json([
            'message' => 'Task created successfully',
            'data' => $task
        ], 201);
    }

    public function update(Request $request, Board $board, Task $task)
    {
        // Authorize the user to update the task
        $this->authorize('update', $task);

        // Validate request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        // Update the task
        $task->update($validatedData);

        // Return JSON response
        return response()->json([
            'message' => 'Task updated successfully',
            'data' => $task
        ], 200);
    }

    public function destroy(Board $board, Task $task)
    {
        // Authorize the user to delete the task
        $this->authorize('delete', $task);

        // Delete the task
        $task->delete();

        // Return JSON response
        return response()->json([
            'message' => 'Task deleted successfully'
        ], 200);
    }
}
