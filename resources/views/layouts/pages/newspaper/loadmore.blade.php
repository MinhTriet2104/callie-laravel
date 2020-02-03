@php
use App\Newspaper;
use App\Category;

$page = Request::get("page");
$limit = 4;
$start = ($page - 1) * $limit;
if (Request::get("category")) {
  $category = Category::find(Request::get("category"));
  $newspapers = $category->newspapers()
  ->orderBy("newspaper_date", "desc")
  ->skip($start)
  ->take($limit)
  ->get();
} else {
  $newspapers = Newspaper::orderBy("newspaper_date", "desc")
  ->skip($start)
  ->take($limit)
  ->get();
}
@endphp

@foreach ($newspapers as $news)
<div class="post post-row">
  <a class="post-img" href="{{  route('newspaper.show', ['slug' => Str::slug(strip_tags($news->newspaper_title)), 'id' => $news->id]) }}"><img src="{{ $news->newspaper_imgae }}" alt="news-img"></a>
<div class="post-body">
  <div class="post-category">
    <a href="{{ route('category.show', ['id' => $news->category->id]) }}">{{ $news->category->catgory_name }}</a>
    </div>
    <h3 class="post-title"><a href="{{  route('newspaper.show', ['slug' => Str::slug(strip_tags($news->newspaper_title)), 'id' => $news->id]) }}">{{ strip_tags($news->newspaper_title) }}</a></h3>
    <ul class="post-meta">
      <li><a href="#">{{ $news->author->author_name }}</a></li>
      @php
      $date = new DateTime($news['newspaper_date']);
      $date = $date->format('d M Y, H:i');
      @endphp
      <li>{{ $date }}</li>
    </ul>
    <p>{{ strip_tags(mb_substr($news["newspaper_content"],0, 150)) }}...</p>
  </div>
</div>
@endforeach