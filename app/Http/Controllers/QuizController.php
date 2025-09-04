<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = Question::with('quiz')->get();

        return response()->json([
            'questions' => $questions
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $vld = Validator::make($request->all(), [
            'content_id'     => 'required|exists:contents,id',
            'question_text'  => 'required|string',
            'options'        => 'required|array|size:4', // harus array dengan 4 elemen
            'options.*'      => 'required|string|max:255',
            'correct_answer' => 'required|string|in:0,1,2,3' // index dari jawaban benar
        ]);

        if ($vld->fails()) {
            return redirect()->back()->withErrors($vld)->withInput();
        }

        $quiz = Quiz::firstOrCreate(
            ['content_id' => $request->content_id],
            ['created_by' => auth()->id()]
        );
        
        Question::create([
            'quiz_id'      => $quiz->id,
            'question_text'  => $request->question_text,
            'options'        => json_encode($request->options),
            'correct_answer' => $request->correct_answer,
        ]);

        return redirect()->back()->with('success', 'Quiz berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $question = Question::with('quiz')->findOrFail($id);

        // decode options jadi array
        $question->options = json_decode($question->options, true);

        return response()->json([
            'question' => $question
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $question = Question::findOrFail($id);

        $vld = Validator::make($request->all(), [
            'question_text'  => 'sometimes|required|string',
            'options'        => 'sometimes|required|array|size:4',
            'options.*'      => 'sometimes|required|string|max:255',
            'correct_answer' => 'sometimes|required|string|in:0,1,2,3'
        ]);

        if ($vld->fails()) {
            return redirect()->back()->withErrors($vld)->withInput();
        }

        if ($request->has('options')) {
            $question->options = json_encode($request->options);
        }

        $question->fill($request->only(['question_text', 'correct_answer']));
        $question->save();

        return redirect()->back()->with('success', 'Quiz berhasil ditambahkan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $question = Question::find($id);

        if (!$question) {
            return response()->json(['error' => 'Question not found!'], 404);
        }

        $question->delete();

        return response()->json([
            'message' => 'Question deleted successfully!'
        ], 200);
    }
}
