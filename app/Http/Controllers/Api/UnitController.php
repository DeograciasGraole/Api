<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unit;
use App\Models\UserProgress;
class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $userId = $request->user()->id; // get current logged user
        $units = Unit::with('lessons')->get();

        $data = $units->map(function ($unit) use ($userId) {
            $lessonIds = $unit->lessons->pluck('id');

            $progress = UserProgress::whereIn('lesson_id', $lessonIds)
                ->where('user_id', $userId)
                ->get();

            $totalLessons = $lessonIds->count();
            $totalPercentage = $totalLessons > 0
                ? round($progress->sum('progress_percentage') / $totalLessons, 2)
                : 0;

            $completedLessons = $progress->where('completed', true)->count();

            return [
                'id' => $unit->id,
                'language_id' => $unit->language_id,
                'title' => $unit->title,
                'description' => $unit->description,
                'image' => $unit->image,
                'total_lessons' => $totalLessons,
                'completed_lessons' => $completedLessons,
                'total_percentage' => $totalPercentage,
            ];
        });

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        // if ($request->user()->id !== 1) {
        //     return response()->json(['error' => 'Unauthorized. Only super user can create units.'], 403);
        // }

        $validated=$request->validate([
            "language_id"=>"required",
            "title"=>"required",
            "description"=>"required",
            "image"=>"sometimes",
        ]);

        $Unit=Unit::create($validated);
        return $Unit;
    }

    /**
     * Display the specified resource.
     */
    public function show( Unit $unit)
    {
        //
     $resultOfUnit=$unit->load('lessons');

     return $resultOfUnit;

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Unit $unit)
    {
        //
      
         $validated=$request->validate([
            "language_id"=>"sometimes",
            "title"=>"sometimes",
            "description"=>"sometimes",
            "image"=>"sometimes",
        ]);

        $unit->update($validated);
        return $unit;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Unit $unit)
    {
        //
        // if ($request->user()->id !== 1) {
        //     return response()->json(['error' => 'Unauthorized. Only super user can delete units.'], 403);
        // }
        $unit->delete();
        return response()->noContent();
    }
}
