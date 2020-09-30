<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
      'topic_id', 'user_id', 'question_id', 'user_answer', 'answer'
    ];

    public function user(){
      return $this->belongsTo('App\User');
    }

    public function question(){
      return $this->belongsTo('App\Question');
    }

    public function topic() {
      return $this->belongsTo('App\Topic');
    }

    public function answer()
    {
      return $this->belongsTo('App\Answer');
    }

    

}
