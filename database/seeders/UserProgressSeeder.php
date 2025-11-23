<?php

namespace Database\Seeders;

use App\Models\UserProgress;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Lesson;
class UserProgressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $users=User::all();
        $lessons=Lesson::all();

        foreach($users as $user){
            foreach($lessons as $lesson){
                UserProgress::factory()->create(
                    [
                        "user_id"=>$user->id,
                        "lesson_id"=>$lesson->id
                    ]
                );
            }
        }
        


    }
}
