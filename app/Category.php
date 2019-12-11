<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Newspaper;


class Category extends Model
{
  public function newspapers() {
    return $this->hasMany('App\Newspaper');
  }

  public function getLimitRecentByCategoryId($limit) {
    return $this->newspapers()->limit($limit)->orderBy('newspaper_date', 'desc')->get();
  }

  public static function getHotNewsByCategory($id, $limit) {
    $category = Category::find($id);
    return $category->newspapers()
    ->whereRaw('DATEDIFF(CURDATE(), newspaper_date) <= 600', [$limit])
    ->orderBy('newspaper_view', 'desc')
    ->limit($limit)
    ->get();
  }
}
