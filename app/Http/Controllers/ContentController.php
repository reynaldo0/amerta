<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Content;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Content::query();

        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        if ($request->has('author_id')) {
            $query->where('author_id', $request->author_id);
        }

        $contents = $query->latest()->paginate(10);

        return response()->json($contents);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $vld = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'type' => 'required|in:artikel,quiz,poster,event,map_asset,submission',
            'media' => 'nullable|file|mimes:jpg,jpeg,png,mp4,mp3,wav,mov,avi|max:20480'
        ]);

        if ($vld->fails()) {
            return redirect()->back()
                ->withErrors($vld)
                ->withInput();
        }

        $user_id = Auth::id();

        // Generate unique slug
        $slug = Str::slug($request->title);
        $originalSlug = $slug;
        $i = 1;
        while (Content::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $i++;
        }

        // handle media upload
        $mediaPath = null;
        $mediaType = null;

        if ($request->hasFile('media')) {
            $file = $request->file('media');
            $mediaPath = $file->store('uploads/media', 'public');
            $ext = strtolower($file->getClientOriginalExtension());

            if (in_array($ext, ['jpg', 'jpeg', 'png'])) {
                $mediaType = 'image';
            } elseif (in_array($ext, ['mp4', 'mov', 'avi'])) {
                $mediaType = 'video';
            } elseif (in_array($ext, ['mp3', 'wav'])) {
                $mediaType = 'audio';
            }
        }

        Content::create([
            'title' => $request->title,
            'body' => $request->body,
            'type' => $request->type,
            'slug' => $slug,
            'author_id' => $user_id,
            'media' => $mediaPath,
        ]);

        return redirect()->back()
            ->with('success', 'Content created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Content $content)
    {
        return response()->json($content);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Content $content)
    {
        $vld = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',
            'body' => 'sometimes|required|string',
            'type' => 'sometimes|required|in:artikel,quiz,poster,event,map_asset,submission',
            'author_id' => 'sometimes|required|exists:users,id',
            'media' => 'nullable|file|mimes:jpg,jpeg,png,mp4,mp3,wav,mov,avi|max:20480'
        ]);

        if ($vld->fails()) {
            return redirect()->back()
                ->withErrors($vld)
                ->withInput();
        }

        $data = $vld->validated();

        if (isset($data['title'])) {
            $slug = Str::slug($data['title']);
            $originalSlug = $slug;
            $i = 1;
            while (Content::where('slug', $slug)->where('id', '!=', $content->id)->exists()) {
                $slug = $originalSlug . '-' . $i++;
            }
            $data['slug'] = $slug;
        }

        // handle new media upload (replace old)
        if ($request->hasFile('media')) {
            // delete old file
            if ($content->media_path) {
                Storage::disk('public')->delete($content->media_path);
            }

            $file = $request->file('media');
            $path = $file->store('uploads/media', 'public');
            $ext = strtolower($file->getClientOriginalExtension());

            if (in_array($ext, ['jpg', 'jpeg', 'png'])) {
                $type = 'image';
            } elseif (in_array($ext, ['mp4', 'mov', 'avi'])) {
                $type = 'video';
            } elseif (in_array($ext, ['mp3', 'wav'])) {
                $type = 'audio';
            } else {
                $type = null;
            }

            $data['media'] = $path;
        }

        $content->update($data);

        return redirect()->back()
            ->with('success', 'Content updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Content $content)
    {
        if ($content->media_path) {
            Storage::disk('public')->delete($content->media_path);
        }

        $content->delete();

        return redirect()->back()
            ->with('success', 'Content deleted successfully!');
    }

    /**
     * Show only contents with type 'artikel'.
     */
    public function articles()
    {
        $articles = Content::where('type', 'artikel')->latest()->get();
        return response()->json($articles);
    }

    public function events()
    {
        $events = Content::where('type', 'event')->latest()->get();
        return response()->json($events);
    }
}
