<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\Task;

class BoardController extends Controller
{
    /**
     * Display a listing of the boards.
     *
     * Retrieves all boards associated with the authenticated user,
     * including their related tasks.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Fetch boards associated with the authenticated user and their tasks
        $boards = auth()->user()->boards()->with('tasks')->get();

        // Return JSON response with boards data
        return response()->json([
            'message' => 'Boards retrieved successfully',
            'data' => $boards
        ], 200);
    }

    /**
     * Store a new board in storage.
     *
     * Validates and creates a new board for the authenticated user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validate incoming data for title and description fields
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Create a new board associated with the authenticated user
        $board = auth()->user()->boards()->create($validatedData);

        // Return JSON response with the newly created board
        return response()->json([
            'message' => 'Board created successfully',
            'data' => $board
        ], 201);
    }

    /**
     * Update the specified board in storage.
     *
     * Authorizes the action, validates, and updates the board details.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Board  $board
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Board $board)
    {
        // Check if the authenticated user is authorized to update this board
        $this->authorize('update', $board);

        // Validate incoming data for title and description fields
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Update board details with validated data
        $board->update($validatedData);

        // Return JSON response with the updated board details
        return response()->json([
            'message' => 'Board updated successfully',
            'data' => $board
        ], 200);
    }

    /**
     * Remove the specified board from storage.
     *
     * Authorizes and deletes the board. All associated tasks are deleted
     * due to foreign key constraints with `onDelete('cascade')`.
     *
     * @param  \App\Models\Board  $board
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Board $board)
    {
        // Check if the authenticated user is authorized to delete this board
        $this->authorize('delete', $board);

        // Delete the board and all associated tasks
        $board->delete();

        // Return JSON response confirming deletion
        return response()->json([
            'message' => 'Board deleted successfully'
        ], 204);
    }
}
