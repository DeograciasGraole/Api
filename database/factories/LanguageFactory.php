<?php

namespace Database\Factories;
use App\Models\Language;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Language>
 */
class LanguageFactory extends Factory
{
     protected $model = Language::class; // important

     private $languages = [
    ["lang" => "Turkish","code"=>'Tr'],
    ["lang" => "English","code"=>"en"],
    ["lang" => "French","code"=>"fr"]
];
 private static $pick = 0;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
          $language = $this->languages[self::$pick ];
            // Increment the index for next call, loop back to 0 if needed
        self::$pick  = (self::$pick  + 1) % count($this->languages);


        return [
            
            //
            "name"=>$language['lang'],
            "code"=>$language['code']
        ];
    }
}


