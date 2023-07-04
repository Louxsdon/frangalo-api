<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventories = Inventory::orderBy("created_at", "desc")->get();
        return response(compact("inventories"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => "required|string|max:100",
            "quantity" => "required|integer|max:999",
        ]);

        Inventory::create($validated);

        return response()->json(["message" => "Inventory add successfully!"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventory $inventory)
    {
        return response()->json($inventory);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inventory $inventory)
    {
        $validated = $request->validate([
            "name" => "required|string|max:100",
            "quantity" => "required|integer|max:999",
        ]);

        $inventory->update($validated);

        return response()->json(["message" => "Inventory updated successfully!"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $inventory)
    {
        $inventory->delete();
        return response()->json(["message" => "Inventory deleted succefully"]);
    }
}
