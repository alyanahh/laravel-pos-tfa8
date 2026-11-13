<x-app-layout>

    <x-slot name="header">
        <div>
            <p class="text-sm font-semibold text-purple-600">
                POS MANAGEMENT SYSTEM
            </p>

            <h2 class="font-bold text-2xl text-slate-800 mt-1">
                Dashboard
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Welcome Section -->
            <div class="bg-gradient-to-r from-purple-700 to-violet-600 rounded-2xl p-7 sm:p-9 text-white shadow-lg">

                <p class="text-purple-100 text-sm font-medium">
                    POINT OF SALE SYSTEM
                </p>

                <h1 class="text-3xl sm:text-4xl font-bold mt-3">
                    Welcome back, {{ Auth::user()->full_name }}!
                </h1>

                <p class="text-purple-100 mt-3 max-w-xl">
                    Manage your customer records and system user accounts
                    through your POS management dashboard.
                </p>

                <div class="mt-6">
                    <span class="inline-flex items-center bg-white/15 px-4 py-2 rounded-lg text-sm">
                        Logged in as {{ Auth::user()->username }}
                    </span>
                </div>

            </div>

            <!-- Statistics -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                <!-- Customers -->
                <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">

                    <div class="flex items-center justify-between">

                        <div>
                            <p class="text-sm font-medium text-slate-500">
                                Total Customers
                            </p>

                            <h2 class="text-3xl font-bold text-slate-800 mt-2">
                                {{ $customersCount }}
                            </h2>

                            <p class="text-sm text-purple-600 mt-2">
                                Registered customer accounts
                            </p>
                        </div>

                        <div class="w-14 h-14 bg-purple-100 text-purple-700 rounded-2xl flex items-center justify-center text-2xl">
                            <span>♙</span>
                        </div>

                    </div>

                    <a href="{{ route('customers.index') }}"
                       class="inline-flex items-center text-sm font-semibold text-purple-700 hover:text-purple-900 mt-6">
                        Manage Customers →
                    </a>

                </div>

                <!-- Users -->
                <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">

                    <div class="flex items-center justify-between">

                        <div>
                            <p class="text-sm font-medium text-slate-500">
                                Total System Users
                            </p>

                            <h2 class="text-3xl font-bold text-slate-800 mt-2">
                                {{ $usersCount }}
                            </h2>

                            <p class="text-sm text-purple-600 mt-2">
                                Registered system accounts
                            </p>
                        </div>

                        <div class="w-14 h-14 bg-purple-100 text-purple-700 rounded-2xl flex items-center justify-center text-2xl">
                            <span>♟</span>
                        </div>

                    </div>

                    <a href="{{ route('users.index') }}"
                       class="inline-flex items-center text-sm font-semibold text-purple-700 hover:text-purple-900 mt-6">
                        Manage Users →
                    </a>

                </div>

            </div>

            <!-- Quick Actions -->
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6">

                <h2 class="text-lg font-bold text-slate-800">
                    Quick Actions
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    Quickly access your POS management features.
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-6">

                    <a href="{{ route('customers.create') }}"
                       class="border border-slate-200 hover:border-purple-300 hover:bg-purple-50 rounded-xl p-5 transition">

                        <span class="text-purple-700 font-bold text-lg">
                            + Add Customer
                        </span>

                        <p class="text-sm text-slate-500 mt-2">
                            Register a new POS customer.
                        </p>

                    </a>

                    <a href="{{ route('users.create') }}"
                       class="border border-slate-200 hover:border-purple-300 hover:bg-purple-50 rounded-xl p-5 transition">

                        <span class="text-purple-700 font-bold text-lg">
                            + Add User
                        </span>

                        <p class="text-sm text-slate-500 mt-2">
                            Create a new system user account.
                        </p>

                    </a>

                </div>

            </div>

            <!-- Account Information -->
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6">

                <h2 class="text-lg font-bold text-slate-800">
                    Account Information
                </h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mt-5">

                    <div>
                        <p class="text-sm text-slate-500">Full Name</p>
                        <p class="font-semibold text-slate-800 mt-1">
                            {{ Auth::user()->full_name }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-slate-500">Username</p>
                        <p class="font-semibold text-slate-800 mt-1">
                            {{ Auth::user()->username }}
                        </p>
                    </div>

                </div>

                <a href="{{ route('profile.edit') }}"
                   class="inline-flex mt-6 text-sm font-semibold text-purple-700 hover:text-purple-900">
                    Manage Profile →
                </a>

            </div>

        </div>
    </div>

</x-app-layout>
