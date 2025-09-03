<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Content;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Optional: filter by type or author
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
        ]);

        if ($vld->fails()) {
            return redirect()->back()
                ->withErrors($vld)
                ->withInput();
        }

        $user_id = Auth::user()->id;

        // Generate unique slug
        $slug = Str::slug($request->title);
        $originalSlug = $slug;
        $i = 1;
        while (\App\Models\Content::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $i++;
        }
        
        Content::create([
            'title' => $request->title,
            'body' => $request->body,
            'type' => $request->type,
            'slug' => $slug,
            'author_id' => $user_id
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
            while (\App\Models\Content::where('slug', $slug)->where('id', '!=', $content->id)->exists()) {
                $slug = $originalSlug . '-' . $i++;
            }
            $data['slug'] = $slug;
        }

        $content->update($data);

        return view('admin.content')
            ->with('success', 'Content updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Content $content)
    {
        $content->delete();

        return redirect()->back()
            ->with('success', 'Content deleted successfully!');
    }
}
