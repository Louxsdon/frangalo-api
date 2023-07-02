<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = Gallery::orderBy("created_at", "desc")->get();
        return response()->json(compact("galleries"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'style_name' => 'nullable|string|max:50',
            'gender' => 'nullable|in:male,female',
            'photos.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $photos = [];
        if (request('photos')) {
            foreach ($validatedData['photos'] as $index => $photo) {
                $file_name = $photo->getClientOriginalName();
                $photo->move(public_path('gallery'), $file_name);
                $photos[] = ["photo" => $file_name];
                Gallery::create(["photo" => $file_name]);
            }
            // Associate the photos with the post
        }

        return response()->json(["message" => "Gallery photos added successfully!"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $gallery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        //
    }
}
