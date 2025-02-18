<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use DB;
use Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $users = User::all();
        if (auth()->user()->isAdmin) {
            return view('admin.users.index', compact('users'));
        } else {
            return view('user.users.index', compact('users'));
        }
    }

    public function create()
    {
        $user = auth()->user();
        if (auth()->user()->isAdmin) {
            return view('admin.users.create');
        } else {
            return view('user.users.create');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'isAdmin' => 'required|boolean',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'isAdmin' => $request->isAdmin,
        ]);

        $user = auth()->user();

        if ($user->isAdmin()) {
        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
        }
         else {
        return redirect()->route('user.users.index')->with('success', 'User created successfully.');
     }
    }

    public function show($id)
    {
        $user = auth()->user();

        $user = User::findOrFail($id);
        if (auth()->user()->isAdmin) {
            return view('admin.users.show', compact('user'));
        } else {
            return view('user.users.show', compact('user'));
        }
    }

    public function edit($id)
    {
        $user = auth()->user();

        $user = User::findOrFail($id);
        if (auth()->user()->isAdmin) {
            return view('admin.users.edit', compact('user'));
        } else {
            return view('user.users.edit', compact('user'));
        }
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'isAdmin' => 'required|boolean',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->isAdmin = $request->isAdmin;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();
        $user = auth()->user();

        if ($user->isAdmin()) {
            return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
        } else {
            return redirect()->route('user.users.index')->with('success', 'User updated successfully.');
        }
        
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        $user = auth()->user();

        if ($user->isAdmin()) {
            return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
        } else {
            return redirect()->route('user.users.index')->with('success', 'User deleted successfully.');
        }
        
    }
}