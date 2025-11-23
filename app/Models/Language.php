<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    //
   use HasFactory; // ✅ important
   
    protected $fillable = ['name', 'code'];
    public function units()
{
    return $this->hasMany(Unit::class);
}

public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function vocabularies()
    {
        return $this->hasMany(Vocabulary::class);
    }

    public function grammars()
    {
        return $this->hasMany(Grammar::class);
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }
}
