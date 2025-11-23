<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lesson>
 */
class LessonFactory extends Factory
{
    private $type = ["grammar", "vocabulary"];
    private $index = 0;
    private $lessons = ["Numbers 1-10", "Numbers 11-20", "Counting Everyday Objects", "Simple Math Phrases", "Ordinal Numbers"]; // start empty

    public function setLessons(array $lessons): self
    {
        $this->lessons = $lessons;
        $this->index = 0;
        return $this;
    }

    public function definition(): array
    {
        if (empty($this->lessons)) {
            throw new \Exception("LessonFactory: lessons array is empty! Call setLessons() first.");
        }

        $lesson = $this->lessons[$this->index % count($this->lessons)];
        $this->index++;

        return [
            'name' => $lesson,
            'type' => fake()->randomElement($this->type),
            'content' => fake()->sentence(4),
            'order' => $this->index,
        ];
    }
}
