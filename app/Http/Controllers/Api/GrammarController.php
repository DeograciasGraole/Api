<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Grammar;
use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\Unit;
use App\Models\Vocabulary;
class GrammarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Unit $unit,Lesson $lesson)
    {
        //
        $lesson->load('grammars');
        return $lesson;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,Unit $unit,Lesson $lesson,Grammar $grammar)
    {


        // if ($request->user()->id !== 19) {
        //     return response()->json(['error' => 'Unauthorized. Only super user can update quizzes.'], 403);
        // }
        //


            

            
         $validated = $request->validate([
             "title" => "required",
             "description" => "required",
             "sentence_en" => "required",
             "sentence_tr" => "required",
             "note" => "required",
             "image" => "required"
    ]);


  $grammar=Grammar::create([
     "lesson_id"=>$lesson->id,
    "language_id"=>$lesson->language_id,
    ...$validated,
  ]);

    return $grammar;




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
    public function update(Request $request,Unit $unit,Lesson $lesson,Grammar $grammar)
    {
       
    //    if ($request->user()->id !== 19) {
    //         return response()->json(['error' => 'Unauthorized. Only super user can update quizzes.'], 403);
    //     }
       
       
        //
         $validated = $request->validate([
             "title" => "sometimes",
             "description" => "sometimes",
             "sentence_en" => "sometimes",
             "sentence_tr" => "sometimes",
             "note" => "sometimes",
             "image" => "sometimes"
    ]);


    $grammar->update($validated);


    return $grammar;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,Unit $unit,Lesson $lesson,Grammar $grammar)
    {

        // if ($request->user()->id !== 19) {
        //     return response()->json(['error' => 'Unauthorized. Only super user can update quizzes.'], 403);
        // }
        //
        $grammar->delete();
        return response()->noContent();

    }
}
