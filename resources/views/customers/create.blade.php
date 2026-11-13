@extends('layouts.app')

@section('title', 'Create Customer | POS System')

@section('content')

<div class="max-w-3xl mx-auto space-y-6">

    <!-- Header -->
    <div>
        <a href="{{ route('customers.index') }}"
           class="text-sm text-purple-600 hover:text-purple-800 font-medium">
            ← Back to Customers
        </a>

        <p class="text-sm font-semibold text-purple-600 mt-5">
            CUSTOMER MANAGEMENT
        </p>

        <h1 class="text-3xl font-bold text-slate-800 mt-1">
            Add New Customer
        </h1>

        <p class="text-slate-500 mt-2">
            Enter the customer's information below.
        </p>
    </div>

    <!-- Form Card -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">

        <div class="p-6 border-b border-slate-200">
            <h2 class="text-lg font-bold text-slate-800">
                Customer Information
            </h2>

            <p class="text-sm text-slate-500 mt-1">
                Fields marked with * are required.
            </p>
        </div>

        <form action="{{ route('customers.store') }}" method="POST"
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
                    placeholder="Enter customer's full name"
                    required
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 outline-none"
                >

                @error('full_name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email"
                       class="block text-sm font-semibold text-slate-700 mb-2">
                    Email Address *
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="example@email.com"
                    required
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 outline-none"
                >

                @error('email')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Phone -->
            <div>
                <label for="phone"
                       class="block text-sm font-semibold text-slate-700 mb-2">
                    Phone Number
                </label>

                <input
                    type="text"
                    id="phone"
                    name="phone"
                    value="{{ old('phone') }}"
                    placeholder="Enter phone number"
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 outline-none"
                >

                @error('phone')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex flex-col sm:flex-row justify-end gap-3 pt-5 border-t border-slate-200">

                <a href="{{ route('customers.index') }}"
                   class="px-5 py-3 rounded-xl border border-slate-300 text-slate-600 font-semibold text-center hover:bg-slate-50">
                    Cancel
                </a>

                <button type="submit"
                        class="px-6 py-3 rounded-xl bg-purple-600 hover:bg-purple-700 text-white font-semibold shadow-sm">
                    Save Customer
                </button>

            </div>

        </form>

    </div>

</div>

@endsection
