<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Category;

class Newspaper extends Model
{
  public function category() {
    return $this->belongsTo('App\Category', 'category_id');
  }

  public function author() {
    return $this->belongsTo('App\Author', 'author_id');
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
}
