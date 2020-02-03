<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
  protected $fillable = [
    'user_name',
    'user_password',
    'user_email'
  ];

  public function comments() {
    return $this->hasMany('App\Comments');
  }
}
