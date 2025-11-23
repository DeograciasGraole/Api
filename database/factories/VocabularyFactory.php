<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vocabulary>
 */
class VocabularyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

  private  $greetingsLesson = [
    ['word_en' => 'Hello', 'word_tr' => 'Merhaba', 'example_en' => 'Hello, how are you?', 'example_tr' => 'Merhaba, nasılsın?'],
    ['word_en' => 'Hi', 'word_tr' => 'Selam', 'example_en' => 'Hi! Nice to see you again.', 'example_tr' => 'Selam! Seni tekrar görmek güzel.'],
    ['word_en' => 'Good morning', 'word_tr' => 'Günaydın', 'example_en' => 'Good morning, everyone!', 'example_tr' => 'Günaydın, herkes!'],
    ['word_en' => 'Good afternoon', 'word_tr' => 'Tünaydın', 'example_en' => 'Good afternoon, teacher.', 'example_tr' => 'Tünaydın, öğretmenim.'],
    ['word_en' => 'Good evening', 'word_tr' => 'İyi akşamlar', 'example_en' => 'Good evening, sir.', 'example_tr' => 'İyi akşamlar, efendim.'],
    ['word_en' => 'Good night', 'word_tr' => 'İyi geceler', 'example_en' => 'Good night and sweet dreams.', 'example_tr' => 'İyi geceler ve tatlı rüyalar.'],
    ['word_en' => 'How are you?', 'word_tr' => 'Nasılsın?', 'example_en' => 'How are you today?', 'example_tr' => 'Bugün nasılsın?'],
    ['word_en' => 'I’m fine, thank you.', 'word_tr' => 'İyiyim, teşekkür ederim.', 'example_en' => 'I’m fine, thank you. And you?', 'example_tr' => 'İyiyim, teşekkür ederim. Ya sen?'],
    ['word_en' => 'What’s your name?', 'word_tr' => 'Adın ne?', 'example_en' => 'What’s your name, please?', 'example_tr' => 'Lütfen adın ne?'],
    ['word_en' => 'My name is…', 'word_tr' => 'Benim adım…', 'example_en' => 'My name is Alex.', 'example_tr' => 'Benim adım Alex.'],
    ['word_en' => 'Nice to meet you', 'word_tr' => 'Tanıştığıma memnun oldum', 'example_en' => 'Nice to meet you, John.', 'example_tr' => 'Tanıştığıma memnun oldum, John.'],
    ['word_en' => 'See you later', 'word_tr' => 'Görüşürüz', 'example_en' => 'See you later at the park.', 'example_tr' => 'Parkta sonra görüşürüz.'],
    ['word_en' => 'Goodbye', 'word_tr' => 'Hoşça kal', 'example_en' => 'Goodbye! Have a nice day.', 'example_tr' => 'Hoşça kal! İyi günler.'],
    ['word_en' => 'Welcome', 'word_tr' => 'Hoş geldin', 'example_en' => 'Welcome to our home.', 'example_tr' => 'Evimize hoş geldin.'],
    ['word_en' => 'How’s it going?', 'word_tr' => 'Nasıl gidiyor?', 'example_en' => 'Hey, how’s it going?', 'example_tr' => 'Hey, nasıl gidiyor?'],
    ['word_en' => 'Long time no see', 'word_tr' => 'Uzun zamandır görüşmedik', 'example_en' => 'Long time no see! How have you been?', 'example_tr' => 'Uzun zamandır görüşmedik! Nasıldın?'],
    ['word_en' => 'Take care', 'word_tr' => 'Kendine iyi bak', 'example_en' => 'Take care and see you soon.', 'example_tr' => 'Kendine iyi bak, yakında görüşürüz.'],
    ['word_en' => 'Have a nice day', 'word_tr' => 'İyi günler', 'example_en' => 'Have a nice day at work!', 'example_tr' => 'İşte iyi günler!'],
    ['word_en' => 'Please', 'word_tr' => 'Lütfen', 'example_en' => 'Please close the door.', 'example_tr' => 'Lütfen kapıyı kapat.'],
    ['word_en' => 'Thank you', 'word_tr' => 'Teşekkür ederim', 'example_en' => 'Thank you for your help.', 'example_tr' => 'Yardımın için teşekkür ederim.'],
    ['word_en' => 'You’re welcome', 'word_tr' => 'Rica ederim', 'example_en' => '“Thank you!” – “You’re welcome!”', 'example_tr' => '“Teşekkür ederim!” – “Rica ederim!”'],
    ['word_en' => 'Excuse me', 'word_tr' => 'Affedersiniz', 'example_en' => 'Excuse me, where is the toilet?', 'example_tr' => 'Affedersiniz, tuvalet nerede?'],
    ['word_en' => 'Sorry', 'word_tr' => 'Üzgünüm', 'example_en' => 'Sorry, I’m late.', 'example_tr' => 'Üzgünüm, geç kaldım.'],
];

 private static $countIndex = 0;


    public function definition(): array
    {
         $item = $this->greetingsLesson[self::$countIndex];

        // Move to next index, loop back to 0 if needed
        self::$countIndex = (self::$countIndex + 1) % count($this->greetingsLesson);

       return [
            'word_en' => $item['word_en'],
            'word_tr' => $item['word_tr'],
            'example_en' => $item['example_en'],
            'example_tr' => $item['example_tr'],
            'image' => null, // You can replace this with a path or URL if needed
            'lesson_id' => 1, // replace with actual lesson_id
            'language_id' => 1, // replace with actual language_id
        ];

    }
}
