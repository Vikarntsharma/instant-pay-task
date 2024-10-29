<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Display the form for creating a new task within a board.
    public function create(Board $board)
    {
        $this->authorize('view', $board);

        return view('tasks.create', compact('board'));
    }

    // Store a newly created task within a specified board.
    public function store(Request $request, Board $board)
    {
        $this->authorize('view', $board);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        $board->tasks()->create($request->only('title', 'description', 'status'));

        return redirect()->route('boards.show', $board)->with('success', 'Task created successfully.');
    }

    // Display the specified task in detail (optional).
    public function show(Task $task)
    {

        // $this->authorize('view', $board);
        $this->authorize('view', $task);
        $board = $task->board;
        return view('tasks.show', compact('board', 'task'));
    }

    // Show the form for editing the specified task within a board.
    public function edit(Task $task)
    {
        // $this->authorize('view', $board);
        $this->authorize('update', $task);
        $board = $task->board;
        return view('tasks.edit', compact('board', 'task'));
    }

    // Update the specified task within a board.
    public function update(Request $request, Board $board, Task $task)
    {
        // $this->authorize('view', $board);
        $this->authorize('update', $task);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        $task->update($request->only('title', 'description', 'status'));
        $board = $task->board;
        return redirect()->route('boards.show', $board)->with('success', 'Task updated successfully.');
    }

    // Remove the specified task from a board.
    public function destroy(Board $board, Task $task)
    {
        // $this->authorize('view', $board);
        $this->authorize('delete', $task);
        $board = $task->board;

        $task->delete();
        return redirect()->route('boards.show', $board)->with('success', 'Task deleted successfully.');
    }
}
