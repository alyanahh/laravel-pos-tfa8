@extends('layouts.app')

@section('title', 'User Accounts | POS System')

@section('content')

<div class="space-y-6">

    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

        <div>
            <p class="text-sm font-semibold text-purple-600 mb-1">
                POS MANAGEMENT
            </p>

            <h1 class="text-3xl font-bold text-slate-800">
                User Accounts
            </h1>

            <p class="text-slate-500 mt-2">
                Manage registered system users and their account information.
            </p>
        </div>

        <a href="{{ route('users.create') }}"
           class="inline-flex items-center justify-center gap-2 bg-purple-600 hover:bg-purple-700 text-white font-semibold px-5 py-3 rounded-xl shadow-sm transition">

            <span class="text-xl">+</span>
            Add New User

        </a>

    </div>

    <!-- Success Notification -->
    @if (session('success'))
        <div class="flex items-center gap-3 bg-green-50 border border-green-200 text-green-700 px-5 py-4 rounded-xl">

            <span class="font-bold text-lg">✓</span>

            <p class="font-medium">
                {{ session('success') }}
            </p>

        </div>
    @endif

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

        <!-- Total Users -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm font-medium text-slate-500">
                        Total System Users
                    </p>

                    <h2 class="text-3xl font-bold text-slate-800 mt-2">
                        {{ $users->count() }}
                    </h2>

                    <p class="text-sm text-purple-600 mt-2">
                        Registered system accounts
                    </p>
                </div>

                <div class="w-14 h-14 bg-purple-100 text-purple-700 rounded-2xl flex items-center justify-center text-2xl">
                    ♟
                </div>

            </div>

        </div>

        <!-- Management Card -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm font-medium text-slate-500">
                        Account Management
                    </p>

                    <h2 class="text-xl font-bold text-slate-800 mt-2">
                        User Records
                    </h2>

                    <p class="text-sm text-slate-500 mt-2">
                        Manage usernames, personal details and profile avatars.
                    </p>
                </div>

                <div class="w-14 h-14 bg-purple-100 text-purple-700 rounded-2xl flex items-center justify-center text-2xl">
                    ☷
                </div>

            </div>

        </div>

    </div>

    <!-- Users Table -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">

        <!-- Table Header -->
        <div class="p-5 sm:p-6 border-b border-slate-200">

            <h2 class="text-lg font-bold text-slate-800">
                Registered System Users
            </h2>

            <p class="text-sm text-slate-500 mt-1">
                Complete list of registered POS system accounts.
            </p>

        </div>

        <!-- Responsive Table -->
        <div class="overflow-x-auto">

            <table class="w-full text-sm text-left">

                <thead class="bg-slate-50 text-slate-600 uppercase text-xs tracking-wider">

                    <tr>
                        <th class="px-6 py-4 font-semibold">Avatar</th>
                        <th class="px-6 py-4 font-semibold">ID</th>
                        <th class="px-6 py-4 font-semibold">Full Name</th>
                        <th class="px-6 py-4 font-semibold">Username</th>
                        <th class="px-6 py-4 font-semibold text-center">Actions</th>
                    </tr>

                </thead>

                <tbody class="divide-y divide-slate-100">

                    @forelse ($users as $user)

                        <tr class="hover:bg-purple-50/40 transition">

                            <!-- Avatar -->
                            <td class="px-6 py-4">

                                @if ($user->avatar && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->avatar))

                                    <img
                                        src="{{ asset('storage/' . $user->avatar) }}"
                                        alt="{{ $user->full_name }}"
                                        class="w-11 h-11 rounded-full object-cover border-2 border-purple-200"
                                    >

                                @else

                                    <div class="w-11 h-11 rounded-full bg-purple-100 text-purple-700 flex items-center justify-center font-bold text-sm">
                                        {{ strtoupper(substr($user->full_name, 0, 1)) }}
                                    </div>

                                @endif

                            </td>

                            <!-- ID -->
                            <td class="px-6 py-4 text-slate-500">
                                #{{ $user->id }}
                            </td>

                            <!-- Full Name -->
                            <td class="px-6 py-4">

                                <div class="font-semibold text-slate-800">
                                    {{ $user->full_name }}
                                </div>

                            </td>

                            <!-- Username -->
                            <td class="px-6 py-4 text-slate-600">
                                {{ '@' . $user->username }}
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4">

                                <div class="flex items-center justify-center gap-2 flex-wrap">

                                    <!-- View -->
                                    <a href="{{ route('users.show', $user->id) }}"
                                       class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold px-3 py-2 rounded-lg transition">
                                        View
                                    </a>

                                    <!-- Edit -->
                                    <a href="{{ route('users.edit', $user->id) }}"
                                       class="bg-purple-100 hover:bg-purple-200 text-purple-700 font-semibold px-3 py-2 rounded-lg transition">
                                        Edit
                                    </a>

                                    <!-- Delete -->
                                    @if (auth()->id() !== $user->id)

                                        <form action="{{ route('users.destroy', $user->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Are you sure you want to delete this user?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="bg-red-100 hover:bg-red-200 text-red-700 font-semibold px-3 py-2 rounded-lg transition">
                                                Delete
                                            </button>

                                        </form>

                                    @else

                                        <span class="text-xs text-slate-400 px-2">
                                            Current account
                                        </span>

                                    @endif

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">

                                <div class="text-slate-400 text-4xl mb-3">
                                    ♟
                                </div>

                                <p class="text-slate-600 font-semibold">
                                    No users found.
                                </p>

                                <p class="text-sm text-slate-400 mt-1">
                                    Create a new system user to get started.
                                </p>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <!-- Table Footer -->
        <div class="px-6 py-4 bg-slate-50 border-t border-slate-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">

            <p class="text-sm text-slate-500">
                Showing {{ $users->count() }} registered users.
            </p>

            <p class="text-xs text-slate-400">
                POS User Management
            </p>

        </div>

    </div>

</div>

@endsection
