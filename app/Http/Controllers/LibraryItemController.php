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
        $items = LibraryItem::all();
        return response()->json([
            'items' => $items
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $vld = Validator::make($request->all(), [
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'category'    => 'required|string',
            'province_id' => 'required|exists:provinces,id',
            'file'        => 'nullable|file|mimes:jpg,jpeg,png,pdf,mp3,mp4,mov,webm|max:51200',
            'file_url'    => 'nullable|url',
            'metadata'    => 'nullable|json'
        ]);

        if ($vld->fails()) {
            return redirect()->back()->withErrors($vld)->withInput();
        }

        $filePath = null;
        $metadata = [];

        // Metadata manual dari textarea
        if ($request->metadata) {
            $metadata = json_decode($request->metadata, true) ?? [];
        }

        // Upload file
        if ($request->hasFile('file')) {
            $file     = $request->file('file');
            $path     = $file->store('library_items', 'public');
            $filePath = Storage::url($path);

            $metadata['file_name']   = $file->getClientOriginalName();
            $metadata['mime']        = $file->getClientMimeType();
            $metadata['file_size']   = $file->getSize();
            $metadata['file_type']   = $file->getClientOriginalExtension();
            $metadata['uploaded_at'] = now()->toDateTimeString();
        } elseif ($request->file_url) {
            $filePath = $request->file_url;

            $metadata['file_name']   = basename($filePath);
            $metadata['mime']        = 'external_url';
            $metadata['file_type']   = pathinfo($filePath, PATHINFO_EXTENSION) ?: 'url';
            $metadata['uploaded_at'] = now()->toDateTimeString();
        }

        LibraryItem::create([
            'title'       => $request->title,
            'description' => $request->description,
            'category'    => $request->category,
            'province_id' => $request->province_id,
            'file_url'        => $filePath,
            'metadata'    => json_encode($metadata),
            'uploaded_by' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Item berhasil ditambahkan!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = LibraryItem::findOrFail($id);

        $vld = Validator::make($request->all(), [
            'title'       => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'category'    => 'sometimes|required|string',
            'province_id' => 'sometimes|required|exists:provinces,id',
            'file'        => 'nullable|file|mimes:jpg,jpeg,png,pdf,mp3,mp4,mov,webm|max:51200',
            'file_url'    => 'nullable|url',
            'metadata'    => 'nullable|json'
        ]);

        if ($vld->fails()) {
            return redirect()->back()->withErrors($vld)->withInput();
        }

        $metadata = $item->metadata ? json_decode($item->metadata, true) : [];

        // Merge metadata manual
        if ($request->metadata) {
            $metadata = array_merge($metadata, json_decode($request->metadata, true) ?? []);
        }

        // Upload file baru
        if ($request->hasFile('file')) {
            if ($item->file && str_starts_with($item->file, '/storage/')) {
                $oldPath = str_replace('/storage/', '', $item->file);
                Storage::disk('public')->delete($oldPath);
            }

            $file     = $request->file('file');
            $path     = $file->store('library_items', 'public');
            $filePath = Storage::url($path);

            $metadata['file_name']   = $file->getClientOriginalName();
            $metadata['mime']        = $file->getClientMimeType();
            $metadata['file_size']   = $file->getSize();
            $metadata['file_type']   = $file->getClientOriginalExtension();
            $metadata['updated_at']  = now()->toDateTimeString();

            $item->file = $filePath;
        } elseif ($request->file_url) {
            $item->file = $request->file_url;

            $metadata['file_name']   = basename($request->file_url);
            $metadata['mime']        = 'external_url';
            $metadata['file_type']   = pathinfo($request->file_url, PATHINFO_EXTENSION) ?: 'url';
            $metadata['updated_at']  = now()->toDateTimeString();
        }

        $item->fill($request->only(['title', 'description', 'category', 'province_id']));
        $item->metadata = json_encode($metadata);

        $item->save();

        return redirect()->back()->with('success', 'Item berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = LibraryItem::find($id);

        if (!$item) {
            return redirect()->back()->with('error', 'Item tidak ditemukan!');
        }

        $user = auth()->user();
        if ($item->uploaded_by !== $user->id && $user->role !== 'admin') {
            return redirect()->back()->with('error', 'Tidak punya akses untuk menghapus!');
        }

        // Hapus file fisik jika ada
        if ($item->file && str_starts_with($item->file, '/storage/')) {
            $oldPath = str_replace('/storage/', '', $item->file);
            Storage::disk('public')->delete($oldPath);
        }

        // Simpan metadata deleted_at sebelum dihapus
        $metadata = $item->metadata ? json_decode($item->metadata, true) : [];
        $metadata['deleted_at'] = now()->toDateTimeString();
        $item->metadata = json_encode($metadata);

        // Jika soft delete aktif
        $item->save();
        $item->delete();

        // Jika hard delete
        // $item->delete();

        return redirect()->back()->with('success', 'Item berhasil dihapus!');
    }
}
