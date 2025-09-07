<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\LibraryItem;
use App\Models\Mail;
use App\Models\Province;
use App\Models\Quiz;
use App\Models\Region;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function dashboard() {
        return view('admin.dashboard')->with([
            'contents' => Content::all(),
            'items' => LibraryItem::latest()->get(),
        ]);
    }

    public function content() {
        $contents = Content::latest()->paginate(10);
        $total = Content::all()->count();
        $article = Content::where('type', 'artikel')->count();
        $quiz = Content::where('type', 'quiz')->count();
        $event = Content::where('type', 'event')->count();
        return view('admin.content', compact('contents'))->with([
            'total' => $total,
            'article' => $article,
            'quiz' => $quiz,
            'event' => $event,
            'items' => LibraryItem::latest()->get(),
        ]);
    }

    public function item() {
        $items = LibraryItem::latest()->get();
        $prov = Province::all()->sortBy('name');
        return view('admin.item')->with([
            'items' => $items,
            'provinces' => $prov,
            'contents' => Content::all(),
        ]);
    }

    public function quiz() {
        $quizzes = Quiz::latest()->get();
        $quiz = Content::where('type', 'quiz')->get();
        return view('admin.quiz')->with([
            'quiz' => $quiz,
            'quizzes' => $quizzes,
            'items' => LibraryItem::latest()->get(),
            'contents' => Content::where('type', 'quiz')->get()
        ]);
    }

    public function mail() {
        $mails = Mail::latest()->get();

        return view('admin.mail', compact('mails'))->with([
            'items' => LibraryItem::latest()->get(),
            'contents' => Content::all(),
        ]);
    }

    public function stories() {
        $items = LibraryItem::where('category', 'cerita_rakyat')->get();
        $prov = Province::all()->sortBy('name');
        return view('admin.story')->with([
            'story' => $items,
            'items' => LibraryItem::latest()->get(),
            'provinces' => $prov,
            'contents' => Content::all(),
        ]);
    }

    public function prov() {
        $prov = Province::all();

        return response()->json($prov);
    }

    public function reg() {
        $reg = Region::with('provinces')->get();

        return response()->json($reg);
    }
}
