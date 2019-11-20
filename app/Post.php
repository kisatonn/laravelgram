<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    Public function user()
  {
    return $this->belongsTo('App\User');
  }
}
