@extends('layouts.app')

@section('title', 'User Details | POS System')

@section('content')

<div class="max-w-3xl mx-auto space-y-6">

    <div>
        <a href="{{ route('users.index') }}"
           class="text-sm text-purple-600 font-semibold">
            ← Back to Users
        </a>

        <h1 class="text-3xl font-bold text-slate-800 mt-4">
            User Details
        </h1>

        <p class="text-slate-500 mt-2">
            View the selected system user's information.
        </p>
    </div>

    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6 space-y-5">

        <div class="flex items-center gap-4">

            @if ($user->avatar && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->avatar))

                <img src="{{ asset('storage/' . $user->avatar) }}"
                     alt="{{ $user->full_name }}"
                     class="w-20 h-20 rounded-full object-cover border-2 border-purple-200">

            @else

                <div class="w-20 h-20 rounded-full bg-purple-100 text-purple-700 flex items-center justify-center text-2xl font-bold">
                    {{ strtoupper(substr($user->full_name, 0, 1)) }}
                </div>

            @endif

            <div>
                <h2 class="text-xl font-bold text-slate-800">
                    {{ $user->full_name }}
                </h2>

                <p class="text-slate-500">
                    {{ '@' . $user->username }}
                </p>
            </div>

        </div>

        <div class="border-t pt-5 space-y-4">

            <div>
                <p class="text-sm text-slate-500">User ID</p>
                <p class="font-semibold text-slate-800">#{{ $user->id }}</p>
            </div>

            <div>
                <p class="text-sm text-slate-500">Full Name</p>
                <p class="font-semibold text-slate-800">{{ $user->full_name }}</p>
            </div>

            <div>
                <p class="text-sm text-slate-500">Username</p>
                <p class="font-semibold text-slate-800">{{ $user->username }}</p>
            </div>

        </div>

        <div class="flex gap-3 pt-5 border-t">

            <a href="{{ route('users.edit', $user->id) }}"
               class="bg-purple-600 hover:bg-purple-700 text-white px-5 py-3 rounded-xl font-semibold">
                Edit User
            </a>

            <a href="{{ route('users.index') }}"
               class="border border-slate-300 text-slate-600 px-5 py-3 rounded-xl font-semibold">
                Back
            </a>

        </div>

    </div>

</div>

@endsection
