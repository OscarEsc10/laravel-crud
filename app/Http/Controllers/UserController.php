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
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
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
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();
        $data['password_hash'] = Hash::make($data['password_hash']);
        $data['is_active'] = $data['is_active'] ?? true;
        $data['role'] = $data['role'] ?? 'user';

        User::create($data);
        return redirect()->route('users.index')
            ->with('success', 'User created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('users.index')
                ->with('error', 'User not found');
        }
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('users.index')
                ->with('error', 'User not found');
        }
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('users.index')
                ->with('error', 'User not found');
        }

        $validator = Validator::make($request->all(), [
            'username' => 'sometimes|required|string|max:100',
            'email' => 'sometimes|required|email|max:150|unique:users,email,'.$id.',uid',
            'password_hash' => 'sometimes|required|string|min:6',
            'role' => 'sometimes|string|max:50|in:user,admin,moderator',
            'is_active' => 'sometimes|boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();
        if (isset($data['password_hash'])) {
            $data['password_hash'] = Hash::make($data['password_hash']);
        }

        $user->update($data);
        return redirect()->route('users.index')
            ->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('users.index')
                ->with('error', 'User not found');
        }

        $user->delete(); // Soft delete
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully!');
    }
}
