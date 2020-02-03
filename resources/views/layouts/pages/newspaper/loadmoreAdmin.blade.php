@php
use App\Newspaper;
use App\Category;

$page = Request::get("page");
$limit = 6;
$start = ($page - 1) * $limit;
if (Request::get("category")) {
  $category = Category::find(Request::get("category"));
  $limit = 4;
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
<div class="row">
  <div class="col-md-8">
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
  </div>
  <div class="col-md-4">
    <div class="row">
      <div class="col-md-6">
        <a href="{{ route('newspaper.edit', $news->id) }}" class="btn btn-primary py-5" style="width: 100%; font-size: 2rem;" role="button">Edit</a>
      </div>
      <div class="col-md-6">
        <form action="{{ route('newspaper.destroy', $news->id) }}" method="post" onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài báo này ?')">
          @csrf
          @method('DELETE')
          <button class="btn btn-danger" style="width: 100%; font-size: 2rem;" type="submit">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>
<hr style="border-top: 1px solid #ee4266;">
@endforeach
