<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quiz>
 */
class QuizFactory extends Factory
{
    private $greetingsQuiz = [
        [
            'question' => 'What is the Turkish translation of "Hello"?',
            'option_a' => 'Selam',
            'option_b' => 'Merhaba',
            'option_c' => 'Günaydın',
            'option_d' => 'Hoşça kal',
            'correct_option' => 'Merhaba',
        ],
        [
            'question' => 'How do you say "Good morning" in Turkish?',
            'option_a' => 'İyi geceler',
            'option_b' => 'Hoş geldin',
            'option_c' => 'Günaydın',
            'option_d' => 'Tünaydın',
            'correct_option' => 'Günaydın',
        ],
        [
            'question' => 'Translate "Thank you" to Turkish.',
            'option_a' => 'Affedersiniz',
            'option_b' => 'Rica ederim',
            'option_c' => 'Teşekkür ederim',
            'option_d' => 'Lütfen',
            'correct_option' => 'Teşekkür ederim',
        ],
        [
            'question' => 'What does "Nasılsın?" mean in English?',
            'option_a' => 'How are you?',
            'option_b' => 'What is your name?',
            'option_c' => 'Nice to meet you',
            'option_d' => 'Goodbye',
            'correct_option' => 'How are you?',
        ],
    ];

    public $grammarQuizzes = [
        [
            'question' => 'What is the Turkish word for "Hello"?',
            'option_a' => 'Nasılsın?',
            'option_b' => 'Benim adım Alex.',
            'option_c' => 'Merhaba!',
            'option_d' => 'Görüşürüz!',
            'correct_option' => 'Merhaba!',
        ],
        [
            'question' => 'How do you say "How are you?" in Turkish?',
            'option_a' => 'Adın ne?',
            'option_b' => 'Nasılsın?',
            'option_c' => 'İyiyim, teşekkür ederim.',
            'option_d' => 'Hoşça kal.',
            'correct_option' => 'Nasılsın?',
        ],
    ];

    private static $countQuiz = 0;
    private static $countQuizG = 0;

    public function definition(): array
    {
        $item = $this->greetingsQuiz[self::$countQuiz];
        self::$countQuiz = (self::$countQuiz + 1) % count($this->greetingsQuiz);

        return [
            "question" => $item['question'],
            "option_a" => $item['option_a'],
            "option_b" => $item['option_b'],
            "option_c" => $item['option_c'],
            "option_d" => $item['option_d'],
            "correct_option" => $item['correct_option'],
            "image" => $item['question']
        ];
    }

    public function GrammarQuestion()
    {
        return $this->state(function () {
            $item = $this->grammarQuizzes[self::$countQuizG];
            self::$countQuizG = (self::$countQuizG + 1) % count($this->grammarQuizzes);

            return [
                "question" => $item['question'],
                "option_a" => $item['option_a'],
                "option_b" => $item['option_b'],
                "option_c" => $item['option_c'],
                "option_d" => $item['option_d'],
                "correct_option" => $item['correct_option'],
                "image" => $item['question']
            ];
        });
    }
}
