<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class UserController extends Controller
{
    /**
     * Display all users.
     */
    public function index()
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }

    /**
     * Show the create user form.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a new user.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'full_name' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'username' => $validated['username'],
            'full_name' => $validated['full_name'],
            'password' => $validated['password'],
        ]);

        return redirect()
            ->route('users.index')
            ->with('success', 'User added successfully!');
    }

    /**
     * Display a specific user.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the edit user form.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update user information and avatar.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'full_name' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Update basic information.
        $user->username = $validated['username'];
        $user->full_name = $validated['full_name'];

        // Update password only when provided.
        if (!empty($validated['password'])) {
            $user->password = $validated['password'];
        }

        // Process uploaded avatar.
        if ($request->hasFile('avatar')) {

            $image = Image::read($request->file('avatar'))
                ->cover(300, 300)
                ->toJpeg(85);

            $avatarPath = 'avatars/' . Str::uuid() . '.jpg';

            // Store processed image.
            Storage::disk('public')->put(
                $avatarPath,
                (string) $image
            );

            // Delete previous avatar.
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Save new avatar path.
            $user->avatar = $avatarPath;
        }

        $user->save();

        return redirect()
            ->route('users.index')
            ->with('success', 'User updated successfully!');
    }

    /**
     * Delete a user.
     */
    public function destroy(User $user)
    {
        // Prevent deleting the currently authenticated account.
        if (auth()->id() === $user->id) {
            return redirect()
                ->route('users.index')
                ->with('error', 'You cannot delete your own account.');
        }

        // Delete avatar from public storage.
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        // Delete user record.
        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'User deleted successfully!');
    }
}
