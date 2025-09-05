<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\LibraryItem;
use App\Models\Province;
use App\Models\Quiz;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function dashboard() {
        return view('admin.dashboard');
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
            'event' => $event
        ]);
    }

    public function item() {
        $items = LibraryItem::latest()->get();
        $prov = Province::all()->sortBy('name');
        return view('admin.item')->with([
            'items' => $items,
            'provinces' => $prov
        ]);
    }

    public function quiz() {
        $quizzes = Quiz::latest()->get();
        $quiz = Content::where('type', 'quiz')->get();
        return view('admin.quiz')->with([
            'quiz' => $quiz,
            'quizzes' => $quizzes,
            'contents' => Content::where('type', 'quiz')->get()
        ]);
    }
}
