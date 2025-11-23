<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grammar extends Model
{
    //
    use HasFactory;
    protected $fillable=["lesson_id","language_id","title","description","sentence_en","sentence_tr","note","image"];
    public function lesson(){
        return $this->belongsTo(Lesson::class);
    }

     public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
