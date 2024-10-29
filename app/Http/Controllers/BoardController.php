<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    // Display a listing of all boards for the authenticated user.
    public function index()
    {
        $boards = auth()->user()->boards;
        return view('boards.index', compact('boards'));
    }

    // Show the form for creating a new board.
    public function create()
    {
        return view('boards.create');
    }

    // Store a newly created board in the database.
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        auth()->user()->boards()->create($request->only('title', 'description'));

        return redirect()->route('boards.index')->with('success', 'Board created successfully.');
    }

    // Display the specified board and its tasks.
    public function show(Board $board)
    {
        // Authorize that the user can view this board
        $this->authorize('view', $board);

        $tasks = $board->tasks;
        return view('boards.show', compact('board', 'tasks'));
    }

    // Show the form for editing the specified board.
    public function edit(Board $board)
    {
        $this->authorize('update', $board);

        return view('boards.edit', compact('board'));
    }

    // Update the specified board in the database.
    public function update(Request $request, Board $board)
    {
        $this->authorize('update', $board);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $board->update($request->only('title', 'description'));

        return redirect()->route('boards.index')->with('success', 'Board updated successfully.');
    }

    // Remove the specified board from the database.
    public function destroy(Board $board)
    {
        $this->authorize('delete', $board);

        $board->delete();

        return redirect()->route('boards.index')->with('success', 'Board deleted successfully.');
    }
}
