<?php

namespace App\Http\Controllers;

use App\Models\LibraryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class LibraryItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $item = LibraryItem::all();
        return response()->json([
            'item' => $item
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $vld = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'file' => 'required|file',
            'category' => 'required',
            'province_id' => 'required|exists:provinces,id'
        ]);

        if ($vld->fails()) {
            return response()->json([
                'message' => 'Invalid field',
                'errors' => $vld->messages()
            ], 422);
        }

        $file     = $request->file('file');
        $path     = $file->store('library_items', 'public');
        $fileUrl  = Storage::url($path);
        $fileType = $file->getClientMimeType();

        $item = LibraryItem::create([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'province_id' => $request->province_id,
            'file_url' => $fileUrl,
            'metadata' => json_encode(['file_type' => $fileType]),
            'uploaded_by' => $request->user()->id
        ]);

        return response()->json([
            'message' => 'item created successfully!',
            'item' => $item
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = LibraryItem::findOrFail($id);
        return response()->json([
            'item' => $item
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = LibraryItem::findOrFail($id);

        $vld = Validator::make($request->all(), [
            'title'       => 'sometimes|required|string',
            'description' => 'sometimes|required|string',
            'category'    => 'sometimes|required|string',
            'province_id' => 'sometimes|required|exists:provinces,id',
            'file'        => 'sometimes|file|max:10240',
        ]);

        if ($vld->fails()) {
            return response()->json([
                'message' => 'Invalid field',
                'errors'  => $vld->messages(),
            ], 422);
        }

        if ($request->hasFile('file')) {
            if ($item->file_url) {
                $oldPath = str_replace('/storage/', '', $item->file_url);
                Storage::disk('public')->delete($oldPath);
            }

            $file     = $request->file('file');
            $path     = $file->store('library_items', 'public');
            $fileUrl  = Storage::url($path);
            $fileType = $file->getClientMimeType();

            $item->file_url = $fileUrl;
            $item->metadata = json_encode(['file_type' => $fileType]);
        }

        $item->fill($request->only([
            'title',
            'description',
            'category',
            'province_id',
        ]));

        $item->save();

        return response()->json([
            'message' => 'item updated successfully!',
            'item'    => $item,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $user = $request->user();
        $item = LibraryItem::find($id);
        if (!$item) {
            return response()->json([
                'message' => 'Post not found'
            ], 404);
        }
        if (!$item->user_id == $user->id || !$user->role == 'admin') {
            return response()->json([
                'message' => 'Forbidden access'
            ], 403);
        }
        $item->delete();
    }
}
