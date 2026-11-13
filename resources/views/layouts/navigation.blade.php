
<nav x-data="{ open: false }" class="bg-white border-b border-slate-200 shadow-sm">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between items-center h-16">

            <!-- Logo and Branding -->
            <div class="flex items-center gap-3">

                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-3">

                    <div class="w-10 h-10 rounded-xl bg-purple-600 text-white flex items-center justify-center font-bold text-lg shadow-sm">
                        P
                    </div>

                    <div>
                        <h1 class="font-bold text-lg text-slate-800 leading-tight">
                            POS System
                        </h1>

                        <p class="text-xs text-slate-500">
                            Management Portal
                        </p>
                    </div>

                </a>

            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center gap-2">

                <a href="{{ route('dashboard') }}"
                   class="px-4 py-2 rounded-lg text-sm font-semibold transition
                   {{ request()->routeIs('dashboard')
                        ? 'bg-purple-100 text-purple-700'
                        : 'text-slate-600 hover:bg-slate-100' }}">
                    Dashboard
                </a>

                <a href="{{ route('customers.index') }}"
                   class="px-4 py-2 rounded-lg text-sm font-semibold transition
                   {{ request()->routeIs('customers.*')
                        ? 'bg-purple-100 text-purple-700'
                        : 'text-slate-600 hover:bg-slate-100' }}">
                    Customers
                </a>

                <a href="{{ route('users.index') }}"
                   class="px-4 py-2 rounded-lg text-sm font-semibold transition
                   {{ request()->routeIs('users.*')
                        ? 'bg-purple-100 text-purple-700'
                        : 'text-slate-600 hover:bg-slate-100' }}">
                    Users
                </a>

            </div>

            <!-- User Dropdown -->
            <div class="hidden md:flex items-center gap-3">

                <div class="text-right">
                    <p class="text-sm font-semibold text-slate-800">
                        {{ Auth::user()->full_name }}
                    </p>

                    <p class="text-xs text-slate-500">
                        {{ '@' . Auth::user()->username }}
                    </p>
                </div>

                <div class="w-10 h-10 rounded-full bg-purple-100 text-purple-700 flex items-center justify-center font-bold border border-purple-200">
                    {{ strtoupper(substr(Auth::user()->full_name, 0, 1)) }}
                </div>

                <div x-data="{ profileOpen: false }" class="relative">

                    <button @click="profileOpen = !profileOpen"
                            @click.outside="profileOpen = false"
                            class="p-2 rounded-lg hover:bg-slate-100 text-slate-600"
                            aria-label="User menu">

                        <svg class="w-5 h-5" fill="none"
                             stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M19 9l-7 7-7-7"/>
                        </svg>

                    </button>

                    <div x-cloak
                         x-show="profileOpen"
                         x-transition
                         class="absolute right-0 mt-3 w-48 bg-white border border-slate-200 rounded-xl shadow-lg py-2 z-50">

                        <a href="{{ route('profile.edit') }}"
                           class="block px-4 py-2 text-sm text-slate-700 hover:bg-purple-50">
                            Profile Settings
                        </a>

                        <div class="border-t border-slate-100 my-2"></div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button type="submit"
                                    class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                Log Out
                            </button>
                        </form>

                    </div>

                </div>

            </div>

            <!-- Mobile Menu Button -->
            <button @click="open = !open"
                    class="md:hidden p-2 rounded-lg text-slate-600 hover:bg-slate-100"
                    aria-label="Toggle navigation">

                <svg x-show="!open" class="w-6 h-6"
                     fill="none" stroke="currentColor"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>

                <svg x-show="open" x-cloak class="w-6 h-6"
                     fill="none" stroke="currentColor"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M6 18L18 6M6 6l12 12"/>
                </svg>

            </button>

        </div>

    </div>

    <!-- Mobile Navigation -->
    <div x-show="open" x-cloak x-transition
         class="md:hidden border-t border-slate-200 bg-white">

        <div class="px-4 py-4 space-y-2">

            <a href="{{ route('dashboard') }}"
               class="block px-4 py-3 rounded-lg text-sm font-semibold
               {{ request()->routeIs('dashboard')
                    ? 'bg-purple-100 text-purple-700'
                    : 'text-slate-600 hover:bg-slate-100' }}">
                Dashboard
            </a>

            <a href="{{ route('customers.index') }}"
               class="block px-4 py-3 rounded-lg text-sm font-semibold
               {{ request()->routeIs('customers.*')
                    ? 'bg-purple-100 text-purple-700'
                    : 'text-slate-600 hover:bg-slate-100' }}">
                Customer Accounts
            </a>

            <a href="{{ route('users.index') }}"
               class="block px-4 py-3 rounded-lg text-sm font-semibold
               {{ request()->routeIs('users.*')
                    ? 'bg-purple-100 text-purple-700'
                    : 'text-slate-600 hover:bg-slate-100' }}">
                User Accounts
            </a>

            <a href="{{ route('profile.edit') }}"
               class="block px-4 py-3 rounded-lg text-sm font-semibold text-slate-600 hover:bg-slate-100">
                Profile Settings
            </a>

            <div class="border-t border-slate-200 pt-4 mt-4">

                <p class="font-semibold text-slate-800">
                    {{ Auth::user()->full_name }}
                </p>

                <p class="text-sm text-slate-500 mt-1">
                    {{ '@' . Auth::user()->username }}
                </p>

                <form method="POST" action="{{ route('logout') }}" class="mt-3">
                    @csrf

                    <button type="submit"
                            class="w-full text-left px-4 py-3 rounded-lg text-sm font-semibold text-red-600 hover:bg-red-50">
                        Log Out
                    </button>
                </form>

            </div>

        </div>

    </div>

</nav>
