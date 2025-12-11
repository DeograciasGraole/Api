<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class UnitFactory extends Factory
{
     private  $titles=[ "Beginner A1","Elementary A2","Intermediate B1","Intermediate B1","Advanced C1"];
     private $images=["https://miro.medium.com/v2/resize:fit:1400/1*BmrptsFddF5F46ye3-dRXw.jpeg","https://miro.medium.com/v2/resize:fit:1400/1*BmrptsFddF5F46ye3-dRXw.jpeg","https://miro.medium.com/v2/resize:fit:1400/1*BmrptsFddF5F46ye3-dRXw.jpeg","https://miro.medium.com/v2/resize:fit:1400/1*BmrptsFddF5F46ye3-dRXw.jpeg","https://miro.medium.com/v2/resize:fit:1400/1*BmrptsFddF5F46ye3-dRXw.jpeg"];
     public static $index1 = 0;
     public static $index2=0;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

         $title = $this->titles[self::$index1 % count($this->titles)];
        self::$index1++;

        $image=$this->images[self::$index2%count($this->images)];
        self::$index2++;

        return [
            //
            "title"=>$title,
            "description"=>fake()->sentence(),
            "image"=>$image
        
        ];
    }
}
