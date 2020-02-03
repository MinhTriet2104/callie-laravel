<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Category;

class Newspaper extends Model
{
  public $timestamps = false;

  protected $fillable = [
    'newspaper_title',
    'author_id',
    'category_id',
    'newspaper_content',
    'newspaper_imgae',
    'newspaper_date',
    'newspaper_view'
  ];

  public function category() {
    return $this->belongsTo('App\Category', 'category_id');
  }

  public function author() {
    return $this->belongsTo('App\Author', 'author_id');
  }

  public function comments() {
    return $this->hasMany('App\Comment');
  }

  public static function getHotNews($limit) {
    return Newspaper::whereRaw('DATEDIFF(CURDATE(), newspaper_date) <= 180', [$limit])
    ->orderBy('newspaper_view', 'desc')
    ->limit($limit)
    ->get();
  }

  public static function getLimitRecent($limit) {
    return Newspaper::orderBy('newspaper_date', 'desc')
    ->limit($limit)
    ->get();
  }

  public static function loadMore($page, $limit) {
    $start = ($page - 1) * $limit;
    return Newspaper::all()
    ->orderBy('newspaper_date', 'desc')
    ->skip($start)
    ->take($limit)
    ->get();
  }
}
