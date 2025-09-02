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
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'category'    => 'required|string',
            'province_id' => 'required|exists:provinces,id',
            'file'        => 'nullable|file|mimes:jpg,jpeg,png,mp4,mov,webm|max:51200', // support image & video
            'file_url'    => 'nullable|url',
            'metadata'    => 'nullable|json'
        ]);

        if ($vld->fails()) {
            return redirect()->back()->withErrors($vld)->withInput();
        }

        $fileUrl = null ?? 'none';
        $metadata = [];

        // Ambil metadata manual dari textarea
        if ($request->metadata) {
            $metadata = json_decode($request->metadata, true) ?? [];
        }

        // Jika upload file
        if ($request->hasFile('file')) {
            $file     = $request->file('file');
            $path     = $file->store('library_items', 'public');
            $fileUrl  = Storage::url($path);

            // Tambahkan metadata otomatis
            $metadata['file_name']   = $file->getClientOriginalName();
            $metadata['file_type']   = $file->getClientMimeType();
            $metadata['file_size']   = $file->getSize();
            $metadata['uploaded_at'] = now()->toDateTimeString();
        } elseif ($request->file_url) {
            $fileUrl = $request->file_url;

            // Tambahkan metadata otomatis untuk URL
            $metadata['file_name']   = basename($fileUrl);
            $metadata['file_type']   = 'external_url';
            $metadata['uploaded_at'] = now()->toDateTimeString();
        }


        LibraryItem::create([
            'title'       => $request->title,
            'description' => $request->description,
            'category'    => $request->category,
            'province_id' => $request->province_id,
            'file_url'    => $fileUrl,
            'metadata'    => json_encode($metadata),
            'uploaded_by' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Item berhasil ditambahkan!');
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
            'title'       => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'category'    => 'sometimes|required|string',
            'province_id' => 'sometimes|required|exists:provinces,id',
            'file'        => 'nullable|file|mimes:jpg,jpeg,png,mp4,mov,webm|max:51200', // support image & video
            'file_url'    => 'nullable|url',
            'metadata'    => 'nullable|json'
        ]);

        if ($vld->fails()) {
            return redirect()->back()->withErrors($vld)->withInput();
        }

        // Ambil metadata lama
        $metadata = $item->metadata ? json_decode($item->metadata, true) : [];

        // Merge metadata manual dari textarea
        if ($request->metadata) {
            $metadata = array_merge($metadata, json_decode($request->metadata, true) ?? []);
        }

        // Jika upload file baru
        if ($request->hasFile('file')) {
            if ($item->file_url && str_starts_with($item->file_url, '/storage/')) {
                $oldPath = str_replace('/storage/', '', $item->file_url);
                Storage::disk('public')->delete($oldPath);
            }

            $file     = $request->file('file');
            $path     = $file->store('library_items', 'public');
            $fileUrl  = Storage::url($path);

            $metadata['file_name']   = $file->getClientOriginalName();
            $metadata['file_type']   = $file->getClientMimeType();
            $metadata['file_size']   = $file->getSize();
            $metadata['updated_at']  = now()->toDateTimeString();

            $item->file_url = $fileUrl;
        } elseif ($request->file_url) {
            $item->file_url = $request->file_url;

            $metadata['file_name']   = basename($request->file_url);
            $metadata['file_type']   = 'external_url';
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

        // Hapus file dari storage jika memang file upload lokal
        if ($item->file_url && str_starts_with($item->file_url, '/storage/')) {
            $oldPath = str_replace('/storage/', '', $item->file_url);
            Storage::disk('public')->delete($oldPath);
        }

        // Update metadata sebelum dihapus (opsional, jika soft delete)
        $metadata = $item->metadata ? json_decode($item->metadata, true) : [];
        $metadata['deleted_at'] = now()->toDateTimeString();
        $item->metadata = json_encode($metadata);

        // Kalau pakai soft delete
        $item->save();
        $item->delete();

        // Kalau hard delete
        // $item->delete();

        return redirect()->back()->with('success', 'Item berhasil dihapus!');
    }
}
