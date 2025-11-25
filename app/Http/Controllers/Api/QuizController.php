<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Quiz;
use App\Models\Unit;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Unit $unit,Lesson $lesson)
    {
        //
        //   $lesson = Lesson::with('quizzes')->find($lesson->id);
         $lesson->load('quizzes');
         return $lesson;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Unit $unit, Lesson $lesson)
{
    // Restrict to user ID 19 only
    // if ($request->user()->id !== 1) {
    //     return response()->json(['error' => 'Unauthorized. Only super user can create quizzes.'], 403);
    // }

    $validated = $request->validate([
        "language_id" => "required",
        "question" => "required",
        "option_a" => "required",
        "option_b" => "required",
        "option_c" => "required",
        "option_d" => "required",
        "correct_option" => "required",
        "image" => "required",
    ]);

    $question = Quiz::create([
        "lesson_id" => $lesson->id, // lowercase variable name
        ...$validated
    ]);

    return response()->json([
        "message" => "Quiz created successfully",
        "data" => $question
    ]);
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Unit $unit,Lesson $lesson,Quiz $quiz)
    {
        // Restrict to user ID 19 only
        // if ($request->user()->id !== 1) {
        //     return response()->json(['error' => 'Unauthorized. Only super user can update quizzes.'], 403);
        // }

         $validated=$request->validate([
            "question"=>'sometimes',
            "option_a"=>"sometimes",
            "option_b"=>"sometimes",
            "option_c"=>"sometimes",
            "option_d"=>"sometimes",
            "correct_option"=>"sometimes",
            "image"=>"sometimes",
        ]);

        $quiz->update($validated);
        return $quiz;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Unit $unit,Lesson $lesson,Quiz $quiz)
    {
        // Restrict to user ID 19 only
        // if ($request->user()->id !== 1) {
        //     return response()->json(['error' => 'Unauthorized. Only super user can delete quizzes.'], 403);
        // }

        $quiz->delete();
        return response()->noContent();
    }
}
