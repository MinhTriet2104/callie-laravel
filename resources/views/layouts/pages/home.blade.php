@extends('layouts.default')
@section('content')
<!-- các bài gần đây -->
<div class="row">
  @for ($i = 1; $i < 5; $i++)
  <div class="col-md-6">
    <div class="post">
      <a class="post-img" href="{{ route('newspaper.show', ['slug' => Str::slug(strip_tags($newsRecent[$i]->newspaper_title)), 'id' => $newsRecent[$i]->id]) }}"><img src="{{ $newsRecent[$i]->newspaper_imgae }}" alt="news-img"></a>
      <div class="post-body">
        <div class="post-category">
          <a href="{{ route('category.show', $newsRecent[$i]->category->id) }}">{{ $newsRecent[$i]->category->category_name }}</a>
        </div>
        <h3 class="post-title"><a href="{{ route('newspaper.show', ['slug' => Str::slug(strip_tags($newsRecent[$i]->newspaper_title)), 'id' => $newsRecent[$i]->id]) }}">{{ strip_tags($newsRecent[$i]["newspaper_title"]) }}</a></h3>
        <ul class="post-meta">
          <li><a href="">{{ $newsRecent[$i]->author->author_name }}</a></li>
          @php
          $date = new DateTime($newsRecent[$i]['newspaper_date']);
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
<!-- lấy theo category -->
@foreach ($categories as $category)
@php
$newsCategory = $category->getLimitRecentByCategoryId(3);
@endphp
<div class="row">
    <div class="col-md-12">
        <div class="section-title">
            <h2 class="title">{{ $category['category_name'] }}</h2>
        </div>
    </div>
    <!-- post -->
    @foreach ($newsCategory as $news)
    <div class="col-md-4">
        <div class="post post-sm">
            <a class="post-img" href=""><img src="{{ $news['newspaper_imgae'] }}" alt=""></a>
            <div class="post-body">
                <div class="post-category">
                    <a href="">{{ $category['category_name'] }}</a>
                </div>
                <h3 class="post-title title-sm"><a href="">{{ strip_tags($news['newspaper_title']) }}</a></h3>
                <ul class="post-meta">
                    <li><a href="">{{ $news->author->author_name }}</a></li>
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
@endforeach

<!-- SECTION -->
<div class="section">
  <!-- container -->
  <div class="container">
    <!-- row -->
    <div class="row">
      <!-- ad -->
      <div class="col-md-12 section-row text-center">
        <a href="#" style="display: inline-block;margin: auto;">
          <img class="img-responsive" src="{{ asset('img/ad-2.jpg') }}" alt="ad-img">
        </a>
      </div>
      <!-- /ad -->
    </div>
    <!-- /row -->
  </div>
  <!-- /container -->
</div>
<!-- /SECTION -->

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- for -->

            @for ($i = 0; $i < 3; $i++ )
            <div class="col-md-4">
                <div class="section-title">
                    <h2 class="title">
                        {{ $newsRecent[$i]->category->category_name }}
                    </h2>
                </div>
                <!-- post -->
                <div class="post">
                    <a class="post-img"
                        href="{{  route('newspaper.show', ['slug' => Str::slug(strip_tags($newsRecent[$i]->newspaper_title)), 'id' => $newsRecent[$i]->id]) }}"><img
                            src="{{ $newsRecent[$i]->newspaper_imgae }}" alt="news-img"></a>
                    <div class="post-body">
                        <div class="post-category">
                            <a
                                href="{{ route('category.show', ['id' => $newsRecent[$i]->category->id]) }}">{{ $newsRecent[$i]->category->category_name }}</a>
                        </div>
                        <h3 class="post-title"><a
                                href="{{  route('newspaper.show', ['slug' => Str::slug(strip_tags($newsRecent[$i]->newspaper_title)), 'id' => $newsRecent[$i]->id]) }}">{{ strip_tags($newsRecent[$i]->newspaper_title) }}</a>
                        </h3>
                        <ul class="post-meta">
                          <li><a href="">{{ $newsRecent[$i]->author->author_name }}</a></li>
                          @php
                          $date = new DateTime($newsRecent[$i]['newspaper_date']);
                          $date = $date->format('d M Y, H:i');
                          @endphp
                          <li>{{ $date }}</li>
                        </ul>
                    </div>
                </div>

                <!-- /post -->
            </div>
            @endfor
            <!-- /for -->
        </div>
        <!-- /row -->

        <!-- row -->
        <div class="row">
            <!-- for1 -->
            @php
            $k = 0;
            @endphp
            @for($i = 0; $i < 3; $i++) 
            <div class="col-md-4">
                @php $limit = $k + 3 @endphp
                @for(; $k < $limit; $k++) 
                <div class="post post-widget">
                    <a class="post-img"
                        href="{{  route('newspaper.show', ['slug' => Str::slug(strip_tags($newsRecent[$k]->newspaper_title)), 'id' => $newsRecent[$k]->id]) }}"><img
                            src="{{ $newsRecent[$k]['newspaper_imgae'] }}" alt="news-img"></a>
                    <div class="post-body">
                        <div class="post-category">
                            <a href="{{ route('category.show', ['id' => $newsRecent[$k]->category->id]) }}">{{ $newsRecent[$k]->category['category_name'] }} </a>
                        </div>
                        <h3 class="post-title"><a
                                href="{{  route('newspaper.show', ['slug' => Str::slug(strip_tags($newsRecent[$k]->newspaper_title)), 'id' => $newsRecent[$k]->id]) }}">{{ strip_tags($newsRecent[$k]->newspaper_title) }}</a>
                        </h3>
                    </div>
                </div>
                
                @endfor
            </div>
            @endfor
            <!-- /for1 -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

<!-- SECTION -->
<div class="section">
  <!-- container -->
  <div class="container">
    <div class="row">
      <!-- post -->
      <div class="col-md-8">
        <div id="content"></div>
        <div class="section-row loadmore text-center">
          <input type="button" class="primary-button" id="load-more" value="load more">
        </div>
      </div>
      <div class="col-md-4">
        <!-- galery widget -->
        <div class="aside-widget">
          <div class="section-title">
            <h2 class="title">Instagram</h2>
          </div>
          <div class="galery-widget">
            <ul>
            @for ($i = 0; $i < 6; $i++)
              <li><a href="#"><img src="{{ $newsRecent[$i]['newspaper_imgae'] }}" alt="instagram-img"></a></li>		
            @endfor
            </ul>
          </div>
        </div>
        <!-- /galery widget -->

        <!-- Ad widget -->
        <div class="aside-widget text-center">
          <a href="#" style="display: inline-block;margin: auto;">
            <img class="img-responsive" src="{{ asset('img/ad-1.jpg') }}" alt="ad-img">
          </a>
        </div>
        <!-- /Ad widget -->
      </div>
    </div>
    <!-- /row -->
  </div>
  <!-- /Container -->
</div>
<!-- /SECTION -->
@endsection