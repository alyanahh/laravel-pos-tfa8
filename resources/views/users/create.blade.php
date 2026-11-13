
@extends('layouts.app')

@section('title', 'Create User | POS System')

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
            Add New User
        </h1>

        <p class="text-slate-500 mt-2">
            Create a new account for your POS system.
        </p>
    </div>

    <!-- Form Card -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">

        <div class="p-6 border-b border-slate-200">
            <h2 class="text-lg font-bold text-slate-800">
                User Information
            </h2>

            <p class="text-sm text-slate-500 mt-1">
                Complete the required account details.
            </p>
        </div>

        <form action="{{ route('users.store') }}"
              method="POST"
              class="p-6 space-y-5">

            @csrf

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
                    value="{{ old('username') }}"
                    placeholder="Enter username"
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
                    value="{{ old('full_name') }}"
                    placeholder="Enter full name"
                    required
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 outline-none"
                >

                @error('full_name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="border-t border-slate-200 pt-5">
                <h3 class="font-bold text-slate-800">
                    Account Security
                </h3>

                <p class="text-sm text-slate-500 mt-1">
                    Create a secure password for this account.
                </p>
            </div>

            <!-- Password -->
            <div>
                <label for="password"
                       class="block text-sm font-semibold text-slate-700 mb-2">
                    Password *
                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Minimum 8 characters"
                    required
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
                    Confirm Password *
                </label>

                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Re-enter password"
                    required
                    autocomplete="new-password"
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 outline-none"
                >
            </div>

            <!-- Buttons -->
            <div class="flex flex-col sm:flex-row justify-end gap-3 pt-5 border-t border-slate-200">

                <a href="{{ route('users.index') }}"
                   class="px-5 py-3 rounded-xl border border-slate-300 text-slate-600 font-semibold text-center hover:bg-slate-50">
                    Cancel
                </a>

                <button type="submit"
                        class="px-6 py-3 rounded-xl bg-purple-600 hover:bg-purple-700 text-white font-semibold shadow-sm">
                    Create User
                </button>

            </div>

        </form>

    </div>

</div>

@endsection
