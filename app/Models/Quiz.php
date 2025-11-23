<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    //
    use HasFactory;
  protected $fillable=["lesson_id","language_id","question","option_a","option_b","option_c","option_d","correct_option","image"];
     public function language()
    {
        return $this->belongsTo(Language::class);
    }
     public function result(){
        return  $this->hasMany(QuizResult::class);
    }
    public function lesson(){
        return $this->belongsTo(Lesson::class);
    }
   
    public function user()
{
    return $this->belongsTo(User::class);
}
}
