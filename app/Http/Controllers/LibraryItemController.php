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
            // File media (image/video)
            'file'        => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4,mov,webm|max:51200',
            // File dokumen PDF
            'file_url'    => 'nullable|file|mimes:pdf|max:51200',
            'metadata'    => 'nullable|json'
        ]);

        if ($vld->fails()) {
            return redirect()->back()->withErrors($vld)->withInput();
        }

        $mediaPath = null;
        $pdfPath   = null;
        $metadata  = [];

        // Metadata manual dari input JSON
        if ($request->metadata) {
            $metadata = json_decode($request->metadata, true) ?? [];
        }

        // Upload media (image / video)
        if ($request->hasFile('file')) {
            $file     = $request->file('file');
            $path     = $file->store('library_items/media', 'public');
            $mediaPath = Storage::url($path);

            $metadata['media_name']   = $file->getClientOriginalName();
            $metadata['media_mime']   = $file->getClientMimeType();
            $metadata['media_size']   = $file->getSize();
            $metadata['media_type']   = $file->getClientOriginalExtension();
            $metadata['media_uploaded_at'] = now()->toDateTimeString();
        }

        // Upload PDF
        if ($request->hasFile('file_url')) {
            $pdf     = $request->file('file_url');
            $path    = $pdf->store('library_items/pdf', 'public');
            $pdfPath = Storage::url($path);

            $metadata['pdf_name']   = $pdf->getClientOriginalName();
            $metadata['pdf_mime']   = $pdf->getClientMimeType();
            $metadata['pdf_size']   = $pdf->getSize();
            $metadata['pdf_type']   = $pdf->getClientOriginalExtension();
            $metadata['pdf_uploaded_at'] = now()->toDateTimeString();
        }

        LibraryItem::create([
            'title'       => $request->title,
            'description' => $request->description,
            'category'    => $request->category,
            'province_id' => $request->province_id,
            'file'        => $mediaPath,
            'file_url'    => $pdfPath,
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
            // File media
            'file'        => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4,mov,webm|max:51200',
            // File pdf
            'file_url'    => 'nullable|file|mimes:pdf|max:51200',
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

        // Upload media baru
        if ($request->hasFile('file')) {
            if ($item->file && str_starts_with($item->file, '/storage/')) {
                $oldPath = str_replace('/storage/', '', $item->file);
                Storage::disk('public')->delete($oldPath);
            }

            $file     = $request->file('file');
            $path     = $file->store('library_items/media', 'public');
            $mediaPath = Storage::url($path);

            $metadata['media_name']   = $file->getClientOriginalName();
            $metadata['media_mime']   = $file->getClientMimeType();
            $metadata['media_size']   = $file->getSize();
            $metadata['media_type']   = $file->getClientOriginalExtension();
            $metadata['media_updated_at']  = now()->toDateTimeString();

            $item->file = $mediaPath;
        }

        // Upload PDF baru
        if ($request->hasFile('file_url')) {
            if ($item->file_url && str_starts_with($item->file_url, '/storage/')) {
                $oldPath = str_replace('/storage/', '', $item->file_url);
                Storage::disk('public')->delete($oldPath);
            }

            $pdf     = $request->file('file_url');
            $path    = $pdf->store('library_items/pdf', 'public');
            $pdfPath = Storage::url($path);

            $metadata['pdf_name']   = $pdf->getClientOriginalName();
            $metadata['pdf_mime']   = $pdf->getClientMimeType();
            $metadata['pdf_size']   = $pdf->getSize();
            $metadata['pdf_type']   = $pdf->getClientOriginalExtension();
            $metadata['pdf_updated_at']  = now()->toDateTimeString();

            $item->file_url = $pdfPath;
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

        // Hapus media file
        if ($item->file && str_starts_with($item->file, '/storage/')) {
            $oldPath = str_replace('/storage/', '', $item->file);
            Storage::disk('public')->delete($oldPath);
        }

        // Hapus pdf file
        if ($item->file_url && str_starts_with($item->file_url, '/storage/')) {
            $oldPath = str_replace('/storage/', '', $item->file_url);
            Storage::disk('public')->delete($oldPath);
        }

        $metadata = $item->metadata ? json_decode($item->metadata, true) : [];
        $metadata['deleted_at'] = now()->toDateTimeString();
        $item->metadata = json_encode($metadata);

        $item->save();
        $item->delete();

        return redirect()->back()->with('success', 'Item berhasil dihapus!');
    }

    public function story() {
        $story = LibraryItem::where('category', 'cerita_rakyat')->latest()->get();
        return response()->json($story);
    }
}