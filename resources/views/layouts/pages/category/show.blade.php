@extends('layouts.default')
@section('content')
<div class="post post-thumb">
  <a class="post-img" href="{{ route('newspaper.show', ['slug' => Str::slug(strip_tags($hotNewsByCategory[0]->newspaper_title)), 'id' => $hotNewsByCategory[0]->id]) }}"><img src="{{ $hotNewsByCategory[0]->newspaper_imgae }}" alt="news-img"></a>
  <div class="post-body">
    <div class="post-category">								
      <a href="{{ route('category.show', $hotNewsByCategory[0]->category->id) }}">{{ $hotNewsByCategory[0]->category->category_name }}</a>
    </div>
    <h3 class="post-title title-lg"><a href="{{ route('newspaper.show', ['slug' => Str::slug(strip_tags($hotNewsByCategory[0]->newspaper_title)), 'id' => $hotNewsByCategory[0]->id]) }}">{{ strip_tags($hotNewsByCategory[0]["newspaper_title"]) }}</a></h3>
    <ul class="post-meta">
      <li><a href="">{{ $hotNewsByCategory[0]->author->author_name }}</a></li>
      @php
      $date = new DateTime($hotNewsByCategory[0]['newspaper_date']);
      $date = $date->format('d M Y, H:i');
      @endphp
      <li>{{ $date }}</li>
    </ul>
  </div>
</div>

<div class="row">
  @for ($i = 1; $i < 5; $i++)
  <div class="col-md-6">
    <div class="post">
      <a class="post-img" href="{{ route('newspaper.show', ['slug' => Str::slug(strip_tags($hotNewsByCategory[$i]->newspaper_title)), 'id' => $hotNewsByCategory[$i]->id]) }}"><img src="{{ $hotNewsByCategory[$i]->newspaper_imgae }}" alt=""></a>
      <div class="post-body">
        <div class="post-category">
          <a href="{{ route('category.show', $hotNewsByCategory[$i]->category->id) }}">{{ $hotNewsByCategory[$i]->category->category_name }}</a>
        </div>
        <h3 class="post-title"><a href="{{ route('newspaper.show', ['slug' => Str::slug(strip_tags($hotNewsByCategory[$i]->newspaper_title)), 'id' => $hotNewsByCategory[$i]->id]) }}">{{ strip_tags($hotNewsByCategory[$i]["newspaper_title"]) }}</a></h3>
        <ul class="post-meta">
          <li><a href="">{{ $hotNewsByCategory[$i]->author->author_name }}</a><li>
          @php
          $date = new DateTime($hotNewsByCategory[$i]['newspaper_date']);
          $date = $date->format('d M Y, H:i');
          @endphp
          <li>{{ $date }}</li>
        </ul>
      </div>
    </div>
  </div>
  @if ($i == 2)
  <div class="clearfix visible-md visible-lg"></div>
  @endif
  @endfor
</div>
@endsection