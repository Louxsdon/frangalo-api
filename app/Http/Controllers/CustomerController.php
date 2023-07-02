<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::orderBy("created_at", "desc")->get();
        return response(compact("customers"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => "required|string|max:100",
            "phone" => "required|string|max:10",
            "gender" => "required|in:male,female"
        ]);

        Customer::create($validated);

        return response()->json(["message" => "Customer add successfully!"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return response()->json($customer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            "name" => "required|string|max:100",
            "phone" => "required|string|max:10",
            "gender" => "required|in:male,female"
        ]);

        $customer->update($validated);

        return response()->json(["message" => "Customer updated successfully!"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return response()->json(["message" => "Customer deleted succefully"]);
    }
}
