<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  public $timestamps = false;

  protected $fillable = [
    'comment_content',
    'comment_date',
    'user_id',
    'newspaper_id'
  ];

  public function newspaper() {
    return $this->belongsTo('App\Newspaper', 'newspaper_id');
  }

  public function user() {
    return $this->belongsTo('App\User', 'user_id');
  }
}
