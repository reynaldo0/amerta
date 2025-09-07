<?php

namespace App\Http\Controllers;

use App\Events\NewChatMessage;
use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ChatMessageController extends Controller
{
    private function generateAnonymousName()
    {
        $adjectives = ['Misterius', 'Lincah', 'Ganteng', 'Keren', 'Cepat', 'Bijaksana'];
        $animals = ['Panda', 'Harimau', 'Serigala', 'Burung', 'Kelinci', 'Kucing'];

        return $adjectives[array_rand($adjectives)] . ' ' . $animals[array_rand($animals)];
    }

    public function index()
    {
        $messages = ChatMessage::latest()->take(50)->get();

        return response()->json($messages);
    }

    public function store(Request $request)
    {
        $request->validate(['message' => 'required|string']);

        if (!session()->has('username')) {
            session(['username' => $this->generateAnonymousName()]);
        }

        $username = session('username');

        $message = ChatMessage::create([
            'username' => $username,
            'message' => $request->message,
        ]);

        NewChatMessage::dispatch($message);

        return response()->json($message);
    }
}