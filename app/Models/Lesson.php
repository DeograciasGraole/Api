<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    //
    use HasFactory;

    protected $fillable=[
        'unit_id',
        'language_id',
        'name',
        'type',
        'content',
        'order'
    ];


    
      public function language()
{
    return $this->belongsTo(Language::class);
}

public function unit(){
        return $this->belongsTo(Unit::class);
    }
     public function vocabularies(){
        return $this->hasMany(vocabulary::class);
     }
     public function grammars(){
        return $this->hasMany(Grammar::class);
     }

     public function progress()
{
     return $this->hasOne(UserProgress::class)->where('user_id', auth()->id());
}
     public function quizzes(){
        return $this->hasMany(Quiz::class);
     }
    
}
