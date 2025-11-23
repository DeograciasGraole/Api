<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Grammar>
 */
class GrammarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

  private   $grammars = [
    [
        'title' => 'Greeting Someone',
        'description' => 'Use simple phrases to greet someone in Turkish.',
        'sentence_en' => 'Hello!',
        'sentence_tr' => 'Merhaba!',
        'note' => '“Merhaba” can be used any time of the day.',
        'image' => null
    ],
    [
        'title' => 'Asking How Someone Is',
        'description' => 'Ask about someone’s well-being politely.',
        'sentence_en' => 'How are you?',
        'sentence_tr' => 'Nasılsın?',
        'note' => '"Nasılsın?" is informal. For formal situations use "Nasılsınız?"',
        'image' => null
    ],
    [
        'title' => 'Responding to Greetings',
        'description' => 'Answer greetings politely and mention your well-being.',
        'sentence_en' => 'I’m fine, thank you.',
        'sentence_tr' => 'İyiyim, teşekkür ederim.',
        'note' => 'Always include "teşekkür ederim" to be polite.',
        'image' => null
    ],
    [
        'title' => 'Introducing Yourself',
        'description' => 'Say your name to introduce yourself.',
        'sentence_en' => 'My name is Alex.',
        'sentence_tr' => 'Benim adım Alex.',
        'note' => '"Benim adım ..." is the standard way to introduce yourself in Turkish.',
        'image' => null
    ],
    [
        'title' => 'Asking Someone’s Name',
        'description' => 'Politely ask for someone’s name.',
        'sentence_en' => 'What’s your name?',
        'sentence_tr' => 'Adın ne?',
        'note' => '"Adın ne?" is informal. Use "Adınız ne?" for formal.',
        'image' => null
    ],
    [
        'title' => 'Saying Goodbye',
        'description' => 'Part politely using simple expressions.',
        'sentence_en' => 'See you later!',
        'sentence_tr' => 'Görüşürüz!',
        'note' => '"Görüşürüz" is casual. For formal: "Hoşça kalın"',
        'image' => null
    ],
    [
        'title' => 'Polite Expressions',
        'description' => 'Use "Please", "Thank you", and "You’re welcome".',
        'sentence_en' => 'Thank you for your help.',
        'sentence_tr' => 'Yardımın için teşekkür ederim.',
        'note' => 'Always use polite phrases to show respect.',
        'image' => null
    ],
    [
        
        'title' => 'Apologizing',
        'description' => 'Use "Sorry" or "Excuse me" to apologize politely.',
        'sentence_en' => 'Sorry, I’m late.',
        'sentence_tr' => 'Üzgünüm, geç kaldım.',
        'note' => '"Affedersiniz" is used to get attention or apologize formally.',
        'image' => null
    ],
];
private static $CounterIndexg=0;
    public function definition(): array
    {
        $grammar = $this->grammars[self::$CounterIndexg];

        // Increment the counter for the next call, loop back if needed
        self::$CounterIndexg = (self::$CounterIndexg + 1) % count($this->grammars);


      return [
            'title' => $grammar['title'],
            'description' => $grammar['description'],
            'sentence_en' => $grammar['sentence_en'],
            'sentence_tr' => $grammar['sentence_tr'],
            'note' => $grammar['note'],
            'image' => $grammar['image'],
        ];
    }
}
