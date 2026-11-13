@extends('layouts.app')

@section('title', 'Customer Details | POS System')

@section('content')

<div class="max-w-3xl mx-auto space-y-6">

    <div>
        <a href="{{ route('customers.index') }}"
           class="text-sm text-purple-600 font-semibold">
            ← Back to Customers
        </a>

        <h1 class="text-3xl font-bold text-slate-800 mt-4">
            Customer Details
        </h1>

        <p class="text-slate-500 mt-2">
            View the selected customer's information.
        </p>
    </div>

    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6 space-y-5">

        <div>
            <p class="text-sm text-slate-500">Customer ID</p>
            <p class="font-semibold text-slate-800">#{{ $customer->id }}</p>
        </div>

        <div>
            <p class="text-sm text-slate-500">Full Name</p>
            <p class="font-semibold text-slate-800">{{ $customer->full_name }}</p>
        </div>

        <div>
            <p class="text-sm text-slate-500">Email Address</p>
            <p class="font-semibold text-slate-800">{{ $customer->email }}</p>
        </div>

        <div>
            <p class="text-sm text-slate-500">Phone Number</p>
            <p class="font-semibold text-slate-800">{{ $customer->phone ?: 'Not provided' }}</p>
        </div>

        <div class="flex gap-3 pt-5 border-t">

            <a href="{{ route('customers.edit', $customer->id) }}"
               class="bg-purple-600 hover:bg-purple-700 text-white px-5 py-3 rounded-xl font-semibold">
                Edit Customer
            </a>

            <a href="{{ route('customers.index') }}"
               class="border border-slate-300 text-slate-600 px-5 py-3 rounded-xl font-semibold">
                Back
            </a>

        </div>

    </div>

</div>

@endsection
