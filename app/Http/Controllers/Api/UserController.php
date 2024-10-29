<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Register a new user (POST /api/signup).
     *
     * @param  Request  $request  The HTTP request object.
     * @return \Illuminate\Http\JsonResponse
     */
    public function signup(Request $request)
    {
        // Validate incoming request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Check if validation fails and return error response
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        // Create a new user record in the database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Generate a new API token for the user
        $token = $user->createToken('API Token')->plainTextToken;

        // Return JSON response with user data and token
        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    /**
     * Authenticate a user and log them in (POST /api/login).
     *
     * @param  Request  $request  The HTTP request object.
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        // Retrieve email and password from request
        $credentials = $request->only(['email', 'password']);

        // Attempt to authenticate the user
        if (!Auth::attempt($credentials)) {
            // If authentication fails, return error response
            return response()->json(['message' => 'Invalid login credentials'], 401);
        }

        // Retrieve authenticated user and generate API token
        $user = Auth::user();
        $token = $user->createToken('API Token')->plainTextToken;

        // Return JSON response with user data and token
        return response()->json([
            'message' => 'Login successful',
            'user' => $user,
            'token' => $token,
        ], 200);
    }

    /**
     * Retrieve a list of all users (GET /api/users).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Fetch all user records from the database
        $users = User::all();

        // Return JSON response with list of users
        return response()->json([
            'message' => 'Users retrieved successfully',
            'data' => $users
        ], 200);
    }

    /**
     * Retrieve a specific user by their ID (GET /api/users/{id}).
     *
     * @param  int  $id  The ID of the user to retrieve.
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        // Find the user by ID
        $user = User::find($id);

        // If the user is not found, return a 404 error response
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Return JSON response with user data
        return response()->json([
            'message' => 'User retrieved successfully',
            'data' => $user
        ], 200);
    }
}
