
@extends('layouts.app')

@section('title', 'Edit User | POS System')

@section('content')

<div class="max-w-3xl mx-auto space-y-6">

    <!-- Header -->
    <div>
        <a href="{{ route('users.index') }}"
           class="text-sm text-purple-600 hover:text-purple-800 font-medium">
            ← Back to Users
        </a>

        <p class="text-sm font-semibold text-purple-600 mt-5">
            USER MANAGEMENT
        </p>

        <h1 class="text-3xl font-bold text-slate-800 mt-1">
            Edit User
        </h1>

        <p class="text-slate-500 mt-2">
            Update account details and profile settings.
        </p>
    </div>

    <!-- Form Card -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">

        <div class="p-6 border-b border-slate-200">
            <h2 class="text-lg font-bold text-slate-800">
                Account Information
            </h2>

            <p class="text-sm text-slate-500 mt-1">
                Editing {{ $user->full_name }} ({{ $user->username }}).
            </p>
        </div>

        <form action="{{ route('users.update', $user->id) }}"
              method="POST"
              enctype="multipart/form-data"
              class="p-6 space-y-6">

            @csrf
            @method('PUT')

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 rounded-xl p-4">
                    <strong>Please correct the following errors:</strong>

                    <ul class="list-disc ml-5 mt-2 text-sm space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Username -->
            <div>
                <label for="username"
                       class="block text-sm font-semibold text-slate-700 mb-2">
                    Username *
                </label>

                <input
                    type="text"
                    id="username"
                    name="username"
                    value="{{ old('username', $user->username) }}"
                    required
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 outline-none"
                >

                @error('username')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Full Name -->
            <div>
                <label for="full_name"
                       class="block text-sm font-semibold text-slate-700 mb-2">
                    Full Name *
                </label>

                <input
                    type="text"
                    id="full_name"
                    name="full_name"
                    value="{{ old('full_name', $user->full_name) }}"
                    required
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 outline-none"
                >

                @error('full_name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Avatar Section -->
            <div class="border-t border-slate-200 pt-6">

                <h3 class="text-lg font-bold text-slate-800">
                    Profile Picture
                </h3>

                <p class="text-sm text-slate-500 mt-1">
                    Manage the user's profile avatar.
                </p>

                <div class="mt-5 flex flex-col sm:flex-row items-start sm:items-center gap-5">

                    @if ($user->avatar && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->avatar))

                        <img
                            src="{{ asset('storage/' . $user->avatar) }}"
                            alt="{{ $user->full_name }}"
                            class="w-24 h-24 rounded-full object-cover border-4 border-purple-100 shadow-sm"
                        >

                    @else

                        <div class="w-24 h-24 rounded-full bg-purple-100 text-purple-700 flex items-center justify-center text-3xl font-bold border-4 border-purple-200">
                            {{ strtoupper(substr($user->full_name, 0, 1)) }}
                        </div>

                    @endif

                    <div>
                        <p class="font-semibold text-slate-700">
                            Current Profile Picture
                        </p>

                        <p class="text-sm text-slate-500 mt-1">
                            Upload a new image to replace the current avatar.
                        </p>
                    </div>

                </div>

                <div class="mt-5">

                    <label for="avatar"
                           class="block text-sm font-semibold text-slate-700 mb-2">
                        Upload New Profile Picture
                    </label>

                    <input
                        type="file"
                        id="avatar"
                        name="avatar"
                        accept=".jpg,.jpeg,.png,.webp"
                        class="block w-full text-sm text-slate-600 file:mr-4 file:py-3 file:px-4 file:rounded-lg file:border-0 file:bg-purple-100 file:text-purple-700 file:font-semibold hover:file:bg-purple-200"
                    >

                    <p class="text-xs text-slate-500 mt-2">
                        Accepted formats: JPG, JPEG, PNG, WEBP. Maximum size: 2MB.
                    </p>

                    @error('avatar')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror

                </div>

            </div>

            <!-- Password Section -->
            <div class="border-t border-slate-200 pt-6">

                <h3 class="text-lg font-bold text-slate-800">
                    Change Password
                </h3>

                <p class="text-sm text-slate-500 mt-1">
                    Leave both password fields blank to keep the existing password.
                </p>

                <div class="mt-5 space-y-5">

                    <!-- New Password -->
                    <div>
                        <label for="password"
                               class="block text-sm font-semibold text-slate-700 mb-2">
                            New Password
                        </label>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Enter new password"
                            autocomplete="new-password"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 outline-none"
                        >

                        @error('password')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation"
                               class="block text-sm font-semibold text-slate-700 mb-2">
                            Confirm New Password
                        </label>

                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            placeholder="Re-enter new password"
                            autocomplete="new-password"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 outline-none"
                        >

                    </div>

                </div>

            </div>

            <!-- Buttons -->
            <div class="flex flex-col sm:flex-row justify-end gap-3 pt-5 border-t border-slate-200">

                <a href="{{ route('users.index') }}"
                   class="px-5 py-3 rounded-xl border border-slate-300 text-slate-600 font-semibold text-center hover:bg-slate-50">
                    Cancel
                </a>

                <button type="submit"
                        class="px-6 py-3 rounded-xl bg-purple-600 hover:bg-purple-700 text-white font-semibold shadow-sm">
                    Update User
                </button>

            </div>

        </form>

    </div>

</div>

@endsection
