<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    //
    use HasFactory;
   protected $fillable=['language_id','title','description','image'];


      public function language()
{
    return $this->belongsTo(Language::class);
}
    public function lessons(){
        return $this->hasMany(Lesson::class);
    }
    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }
 

}
