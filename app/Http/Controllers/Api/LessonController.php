<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LessonResource;
use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\Unit;
class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Unit $unit)
    {
           $unit->load(['lessons.progress']);

    return LessonResource::collection($unit->lessons);

    // return LessonResource::collection($unit->lessons);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Restrict to user ID 19 only
        if ($request->user()->id !== 1) {
            return response()->json(['error' => 'Unauthorized. Only super user can create lessons.'], 403);
        }

        $validated=$request->validate([
            "name"=>"required",
            "type"=>"required",
            "content"=>"sometimes",
            "order"=>"required"

        ]);

       $lesson= Lesson::create(
        [
            'language_id'=>3,
            'unit_id'=>7,
           ...$validated
        ]    
     );
        return $lesson;
    }

    /**
     * Display the specified resource.
     */
    public function show(Unit $unit  ,Lesson $lesson)
    {
        
        $lesson = Lesson::with(['vocabularies', 'grammars', 'quizzes', 'progress'])
        ->findOrFail($lesson->id);
         return new LessonResource($lesson);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Unit $unit,Lesson $lesson)
    {
        // Restrict to user ID 19 only
        if ($request->user()->id !== 1) {
            return response()->json(['error' => 'Unauthorized. Only super user can update lessons.'], 403);
        }

         $validated=$request->validate([
            "name"=>"sometimes",
            "type"=>"sometimes",
            "content"=>"sometimes",
            "order"=>"somtimes"
            
     
        ]);
        

        // Ensure that the lesson belongs to this unit
    if ($lesson->unit_id !== $unit->id) {
        return response()->json(['error' => 'Lesson does not belong to this unit'], 403);
    }

    // Update the lesson
    $lesson->update($validated);

        return $lesson;

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Unit $unit,Lesson $lesson)
    {
        // Restrict to user ID 19 only
        if ($request->user()->id !== 1) {
            return response()->json(['error' => 'Unauthorized. Only super user can delete lessons.'], 403);
        }

      $lesson->delete();
      return response('lesson delete',status:204);
    }
}
