<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->json([
            'message' => 'Show user creation form',
            'fields' => [
                'username' => 'string (required)',
                'email' => 'email (required, unique)',
                'password_hash' => 'string (required)',
                'role' => 'string (default: user)',
                'is_active' => 'boolean (default: true)'
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:100',
            'email' => 'required|email|max:150|unique:users',
            'password_hash' => 'required|string|min:6',
            'role' => 'string|max:50|in:user,admin,moderator',
            'is_active' => 'boolean'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = $request->all();
        $data['password_hash'] = Hash::make($data['password_hash']);
        $data['is_active'] = $data['is_active'] ?? true;
        $data['role'] = $data['role'] ?? 'user';

        $user = User::create($data);
        return response()->json($user, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        return response()->json([
            'message' => 'Show user edit form',
            'user' => $user,
            'fields' => [
                'username' => 'string',
                'email' => 'email',
                'password_hash' => 'string',
                'role' => 'string',
                'is_active' => 'boolean'
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'username' => 'sometimes|required|string|max:100',
            'email' => 'sometimes|required|email|max:150|unique:users,email,'.$id.',uid',
            'password_hash' => 'sometimes|required|string|min:6',
            'role' => 'sometimes|string|max:50|in:user,admin,moderator',
            'is_active' => 'sometimes|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = $request->all();
        if (isset($data['password_hash'])) {
            $data['password_hash'] = Hash::make($data['password_hash']);
        }

        $user->update($data);
        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete(); // Soft delete
        return response()->json(['message' => 'User deleted successfully']);
    }
}
