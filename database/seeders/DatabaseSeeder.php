<?php

namespace Database\Seeders;

use App\Models\Grammar;
use App\Models\User;
use App\Models\Language;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
// use Carbon\Language;
use App\Models\UserProgress;
use App\Models\Vocabulary;
use App\Models\Quiz;
use Illuminate\Database\Seeder;

// ...existing code...
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
         ]);
        User::factory(10)->create();
        // $this->call(Language::class);
        Language::factory(3)->create();
        $this->call(UnitSeeder::class);
        $this->call(LessonSeeder::class);

         Vocabulary::factory(10)->create([
             'lesson_id' => 1, // replace with actual lesson_id
            'language_id' => 1, //
         ]);
         Grammar::factory(8)->create([
            'lesson_id' => 2,
         'language_id' => 1, // English as reference
         ]);
         Quiz::factory(10)->create([
            'lesson_id' => 1,
            'language_id' => 1, 
         ]);
         
         Quiz::factory(8)->GrammarQuestion()->create([
             'lesson_id' => 2,
             'language_id' => 1, 
         ]);

         // Use the factory to create user progress records (don't call the model as a seeder)
        //  UserProgress::factory(20)->create();

    }
}
// ...existing code...