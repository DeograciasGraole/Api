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

    // Routes accessible by all authenticated users (User & Admin)
    Route::post('/progress', [UserProgressController::class, 'store']);
    Route::get('/progress', [UserProgressController::class, 'index']);
    Route::put('/progress/{id}', [UserProgressController::class, 'update']);

    // Units & Lessons for all users
    Route::apiResource('units', UnitController::class)->only(['index', 'show']);
    Route::apiResource('units.lessons', LessonController::class)->only(['index', 'show']);

    Route::scopeBindings()->group(function () {
        Route::apiResource('units.lessons.vocabularies', VocabularyController::class)->only(['index', 'show']);
        Route::apiResource('units.lessons.grammars', GrammarController::class)->only(['index', 'show']);
        Route::apiResource('units.lessons.quizzes', QuizController::class)->only(['index', 'show']);
    });

    // Admin-only routes (CRUD, but admins still inherit index/show)
    Route::middleware('isAdmin')->group(function () {
        Route::apiResource('units', UnitController::class)->only(['store', 'update', 'destroy']);
        Route::apiResource('units.lessons', LessonController::class)->only(['store', 'update', 'destroy']);

        Route::scopeBindings()->group(function () {
            Route::apiResource('units.lessons.vocabularies', VocabularyController::class)->only(['store', 'update', 'destroy']);
            Route::apiResource('units.lessons.grammars', GrammarController::class)->only(['store', 'update', 'destroy']);
            Route::apiResource('units.lessons.quizzes', QuizController::class)->only(['store', 'update', 'destroy']);
        });
    });

});
