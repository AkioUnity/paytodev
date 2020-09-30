<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
      'welcome_txt',
      'logo',
      'favicon'
    ];
}
