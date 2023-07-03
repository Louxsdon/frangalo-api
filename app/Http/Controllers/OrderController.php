<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pending = Order::with("customer")->where("status", "pending")->orderBy("created_at", "desc")->get();
        $progress = Order::with("customer")->where("status", "started")->orderBy("created_at", "desc")->get();
        $completed = Order::with("customer")->where("status", "done")->orderBy("created_at", "desc")->get();
        return response()->json(compact("pending", "progress", "completed"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "customer_id" => "required|exists:customers,id",
            "style" => "required|string|max:100",
            "shirt_length" => "nullable|string|max:10",
            "around_arm" => "nullable|string|max:10",
            "waist" => "nullable|string|max:10",
            "neck" => "nullable|string|max:10",
            "trouser_length" => "nullable|string|max:10",
            "shoulder_to_chest" => "nullable|string|max:10",
            "hip" => "nullable|string|max:10",
            "shoulder_to_hip" => "nullable|string|max:10",
            "breast_length" => "nullable|string|max:10",
            "shoulder_to_waist" => "nullable|string|max:10",
            "ankle" => "nullable|string|max:10",
            "dress_length" => "nullable|string|max:10",
            "notes" => "nullable|string|max:10",
        ]);

        $order = Order::create($validated);

        return response()->json(["order" => $order, "message" => "Order placed succefully"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $order->customer;
        return response()->json($order);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            "style" => "required|string|max:100",
            "shirt_length" => "nullable|string|max:10",
            "around_arm" => "nullable|string|max:10",
            "waist" => "nullable|string|max:10",
            "neck" => "nullable|string|max:10",
            "trouser_length" => "nullable|string|max:10",
            "shoulder_to_chest" => "nullable|string|max:10",
            "hip" => "nullable|string|max:10",
            "shoulder_to_hip" => "nullable|string|max:10",
            "breast_length" => "nullable|string|max:10",
            "shoulder_to_waist" => "nullable|string|max:10",
            "ankle" => "nullable|string|max:10",
            "dress_length" => "nullable|string|max:10",
            "notes" => "nullable|string",
            "status" => "required|in:pending,started,done",
        ]);

        $order = $order->update($validated);

        return response()->json(["order" => $order, "message" => "Order updated succefully"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json(["message" => "Order deleted succefully"]);
    }
}
