<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
  public function newspapers() {
    return $this->hasMany('App\Newspaper');
  }
}
