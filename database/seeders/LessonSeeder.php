<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Unit;

class LessonSeeder extends Seeder
{
    public function run(): void
    {
         $units = Unit::all();

foreach ($units as $unit) {
    $lessonsForUnit = match($unit->id) {
        1 => ["Greetings & Introductions", "Common Objects", "Days of the Week", "Simple Actions", "Basic Feelings & Emotions"],
        2 => ["Numbers 1-10", "Numbers 11-20", "Counting Everyday Objects", "Simple Math Phrases", "Ordinal Numbers"],
        3 => ["At Home Objects", "At School Objects", "At Office Objects", "Kitchen & Food Items", "Clothing & Accessories"],
        4 => ["Morning Routine", "Going to Work/School", "Eating & Cooking", "Shopping & Errands", "Leisure & Hobbies"],
        5 => ["Family Members", "Friends & Acquaintances", "Talking About People", "Expressing Feelings", "Simple Conversations"],
        default => ["General Lesson 1", "General Lesson 2"]
    };

    foreach ($lessonsForUnit as $index => $lessonName) {
        Lesson::factory()->create([
            'unit_id' => $unit->id,
            'language_id'=>1,
            'name' => $lessonName,
            'type' => fake()->randomElement(['grammar', 'vocabulary']),
            'content' => fake()->sentence(4),
            'order' => $index + 1,
        ]);
    }
}

    }
}
