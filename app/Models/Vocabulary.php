<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vocabulary extends Model
{
    //
    use HasFactory;


    // $table->string('image')->nullable();
    //         $table->string('word_en');  // English word
    //         $table->string('word_tr');  // Turkish translation
    //         $table->string('example_en')->nullable(); // English example sentence
    //         $table->string('example_tr')->nullable(); 

    protected $fillable=["language_id" ,"lesson_id","image","word_en","word_tr","example_en","example_tr"]; 
    
    
     public function language()
    {
        return $this->belongsTo(Language::class);
    }
            
    public function lesson(){
        return $this->belongsTo(Lesson::class);
    }

}
