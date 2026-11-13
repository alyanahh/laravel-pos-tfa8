<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // Display all customers
    public function index()
    {
        $customers = Customer::all();

        return view('customers.index', compact('customers'));
    }

    // Show the create customer form
    public function create()
    {
        return view('customers.create');
    }

    // Store a new customer
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:255',
        ]);

        $validated['phone'] = $validated['phone'] ?? '';

        Customer::create($validated);

        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer added successfully!');
    }

    // Display a specific customer
    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    // Show the edit customer form
    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    // Update an existing customer
    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:255',
        ]);

        $validated['phone'] = $validated['phone'] ?? '';

        $customer->update($validated);

        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer updated successfully!');
    }

    // Delete a customer
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer deleted successfully!');
    }
}
