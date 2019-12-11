<div id="post-header" class="page-header">
  <div class="page-header-bg" style="background-image: url({{ asset('img/header-1.jpg') }});" data-stellar-background-ratio="0.5"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-10">
        <div class="post-category">
          <a href="{{ route('category.show', $newspaper->category->id) }}">{{ $newspaper->category->category_name }}</a>
        </div>
        <h1>{{ strip_tags($newspaper['newspaper_title']) }}</h1>
        <ul class="post-meta">
          <li><a href="author.html">{{ $newspaper->author->author_name }}</a></li>
          @php
          $date = new DateTime($newspaper['newspaper_date']);
          $date = $date->format('d M Y, H:i');
          @endphp
          <li>{{ $date }}</li>
          <li><i class="fa fa-comments"></i> 3</li>
          <li><i class="fa fa-eye"></i>{{ $newspaper['newspaper_view'] }}</li>
        </ul>
      </div>
    </div>
  </div>
</div>