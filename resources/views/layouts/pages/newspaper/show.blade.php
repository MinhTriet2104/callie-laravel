@extends('layouts.default')
@section('content')
@php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
@endphp
<!-- post share -->
<div class="section-row">
  <div class="post-share">
    <a href="#" class="social-facebook"><i class="fa fa-facebook"></i><span>Share</span></a>
    <a href="#" class="social-twitter"><i class="fa fa-twitter"></i><span>Tweet</span></a>
    <a href="#" class="social-pinterest"><i class="fa fa-pinterest"></i><span>Pin</span></a>
    <a href="#" ><i class="fa fa-envelope"></i><span>Email</span></a>
  </div>
</div>
<!-- /post share -->

<!-- post content -->
<div class="section-row">
  <h1 class="title-lg">{{ strip_tags($newspaper['newspaper_title']) }}</h1>
  <figure>
    <img src="{{ $newspaper['newspaper_imgae'] }}" alt="">
  </figure>
  {!! $newspaper['newspaper_content'] !!}
</div>
<!-- /post content -->

<!-- post tags -->
<div class="section-row">
  <div class="post-tags">
    <ul>
      <li>TAGS:</li>
      <li><a href="{{ route('category.show', $newspaper->category->id) }}">{{ $newspaper->category->category_name }}</a></li>
    </ul>
  </div>
</div>
<!-- /post tags -->

<!-- /related post -->
<div>
  <div class="section-title">
    <h3 class="title">Related Posts</h3>
  </div>
  <div class="row">
    <!-- post -->
    @foreach ($relative as $news)
    <div class="col-md-4">
      <div class="post post-sm">
        <a class="post-img" href="{{ route('newspaper.show', ['slug' => Str::slug(strip_tags($news->newspaper_title)), 'id' => $news->id]) }}" alt="news-img">
          <img src="{{ $news->newspaper_imgae }}" alt="news-img">
        </a>
        <div class="post-body">
          <div class="post-category">
            <a href="{{ route('category.show', $news->category->id) }}">{{ $news->category->category_name }}</a>
          </div>
          <h3 class="post-title title-sm"><a href="{{ route('newspaper.show', ['slug' => Str::slug(strip_tags($news->newspaper_title)), 'id' => $news->id]) }}">{{ strip_tags($news['newspaper_title']) }}</a></h3>
          <ul class="post-meta">
            <li><a href="#">{{ $news->author->author_name }}</a></li>
            @php
            $date = new DateTime($news['newspaper_date']);
            $date = $date->format('d M Y, H:i');
            @endphp
            <li>{{ $date }}</li>
          </ul>
        </div>
      </div>
    </div>
    @endforeach
    <!-- /post -->
  </div>
</div>
<!-- /related post -->

<!-- post comments -->
<div class="section-row">
  <div class="post-comments" id="comment">
    <input type="hidden" id="newsId" value="{{ $newspaper->id }}">
  </div>
</div>
<!-- /post comments -->

<!-- post reply -->
<div class="section-row">
  @if (isset($_SESSION['user_id']))
  <input type='hidden' id='user-id' value="{{ $_SESSION['user_id'] }}">
  <div class="section-title">
    <h3 class="title">Leave a comment</h3>
  </div>
  <form class="post-reply">
    @csrf
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <textarea class="input" name="message" placeholder="Message" id="message"></textarea>
        </div>
      </div>
      <div class="col-md-12">
        <input class="primary-button" type="button" value="Send" id="send">
      </div>
    </div>
  </form>
  @else
    <h3>Hãy <a href="{{ url('/user/login') }}" style='color: #ee4266;'>Đăng nhập</a> để Comment</h3>
  @endif
</div>
<!-- /post reply -->
@endsection