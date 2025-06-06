<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //

    public function view()
    {
        return view('admin.add-customer');
    }

    public function index()
    {
        return Customer::all();
    }

    public function store(Request $request)
    {
        $customer = Customer::create($request->only(['name', 'email', 'phone', 'address']));
        return response()->json($customer, 201);
    }

    public function show($id)
    {
        return Customer::findOrFail($id);
    }

    public function update_view($id)
    {
        $customer = Customer::findOrFail($id);

        // pass the $customer to the view
        return view('admin.update-customer', compact('customer'));
    }


    // Handle the form submission
    public function customer_update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        // validate inputs
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $id,
            'phone' => 'required|string|max:20',
        ]);

        // update and save
        $customer->update($validated);

        // redirect back to list (or wherever you like)
        return redirect()->route('index') // adjust if your list route is named differently
            ->with('success', 'Customer updated successfully.');
    }

    public function destroy($id)
    {
        Customer::findOrFail($id)->delete();
        return response()->json(['message' => 'Customer deleted']);
    }
}
