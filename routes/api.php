<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LessonController;
use App\Http\Controllers\Api\QuizController;
use App\Http\Controllers\Api\VocabularyController;
use App\Http\Controllers\Api\GrammarController;
use App\Http\Controllers\Api\UnitController;
use App\Http\Controllers\Api\UserProgressController;
use App\Http\Controllers\Api\GoogleController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




// Route::apiResource('units.lessons.vocabularies', VocabularyController::class);
// Route::apiResource('units.lessons.grammars', GrammarController::class);


//use App\Http\Controllers\Api\AuthController;
//use App\Http\Controllers\Api\LessonController;
//use App\Http\Controllers\Api\QuizController;
//use App\Http\Controllers\Api\VocabularyController;
//use App\Http\Controllers\Api\GrammarController;
//use App\Http\Controllers\Api\UnitController;
//use App\Http\Controllers\Api\UserProgressController;

//use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Route;

// Auth
Route::post('login', [AuthController::class,'login']);
Route::post('register', [AuthController::class,'register']);
Route::post('logout', [AuthController::class,'logout'])->middleware('auth:sanctum');

// Get logged-in user
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    // User progress
    Route::post('/progress', [UserProgressController::class, 'store']); // mark progress
    Route::get('/progress', [UserProgressController::class, 'index']); // fetch logged-in user progress
    Route::put('/progress/{id}', [UserProgressController::class, 'update']); // update progress

    // Units & Lessons
    Route::apiResource('units', UnitController::class);
    Route::apiResource('units.lessons', LessonController::class);

    // Nested resources
    Route::scopeBindings()->group(function () {
        Route::apiResource('units.lessons.vocabularies', VocabularyController::class);
        Route::apiResource('units.lessons.grammars', GrammarController::class);
        Route::apiResource('units.lessons.quizzes', QuizController::class);
    });
});




Route::post('/google-login', [GoogleController::class, 'googleLogin']);


