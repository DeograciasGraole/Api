<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Unit;
use App\Models\Vocabulary;
use Illuminate\Http\Request;

class VocabularyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Unit $unit,Lesson $lesson)
    {
        //load lesson with it vocabularies
          $lesson->load('vocabularies');
        
           return $lesson;



    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,Unit $unit,Lesson $lesson)
    {
        //

        if ($request->user()->id !== 1) {
            return response()->json(['error' => 'Unauthorized. Only super user can create vocabularies.'], 403);
        }

      
       $validated= $request->validate(
  [
           "image"=>"sometimes",
           "word_en"=>"required",
           "word_tr"=>"required",
           "example_en"=>"required",
           "example_tr"=>"required"

        ]);
       $voca= Vocabulary::create(
            [
                "language_id"=>$lesson->language_id,
                "lesson_id"=>$lesson->id,
                ...$validated,
            ]
            );
            return $voca;
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
    public function update(Request $request, Unit $unit,Lesson $lesson,Vocabulary $vocabulary)
    {
        //


        if ($request->user()->id !== 1) {
            return response()->json(['error' => 'Unauthorized. Only super user can update vocabularies.'], 403);
        }
        $validated= $request->validate(
  [
           "language_id"=>"sometimes",
           "lesson_id"=>"sometimes",
           "image"=>"sometimes",
           "word_en"=>"sometimes",
           "word_tr"=>"sometimes",
           "example_en"=>"sometimes",
           "example_tr"=>"sometimes"

        ]);

      $vocabulary->update(
              $validated
        );

        return $vocabulary;

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( Request $request, Unit $unit,Lesson $lesson,Vocabulary $vocabulary)
    {

         if ($request->user()->id !== 1) {
            return response()->json(['error' => 'Unauthorized. Only super user can update quizzes.'], 403);
        }
        //
        $vocabulary->delete();

       return response()->noContent();

    }
}
