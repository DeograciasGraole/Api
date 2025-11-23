<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserProgress;
use App\Models\Lesson;
class UserProgressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index($userId)
    {
         $lessons = Lesson::with(['progress' => function($q) use ($userId) {
        $q->where('user_id', $userId);
    }])->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'lesson_id' => 'required|exists:lessons,id',
        'completed' => 'required|boolean',
        'progress_percentage' => 'nullable|integer|min:0|max:100',
    ]);

    $progress = UserProgress::updateOrCreate(
        [
            'user_id' => $request->user()->id,
            'lesson_id' => $request->lesson_id,
        ],
        [
            'completed' => $request->completed,
            'progress_percentage' => $request->progress_percentage ?? 0, // <- fixed
        ]
    );

    return response()->json($progress);
}


    /**
     * Display the specified resource.
     */
     

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, $id)
    // {
    //     $progress = UserProgress::findOrFail($id);

    //     $request->validate([
    //         'completed' => 'sometimes|boolean',
    //         'user_progress' => 'sometimes|integer|min:0|max:100',
    //     ]);

    //     $progress->update($request->only(['completed', 'user_progress']));

    //     return response()->json($progress);
    // }

    /**
     * Remove the specified resource from storage.
     */


    
    // public function destroy(string $id)
    // {
    //     //
    // }
}
