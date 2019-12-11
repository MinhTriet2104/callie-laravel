<!DOCTYPE html>
<html lang="en">
<head>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>Callie HTML Template</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700%7CMuli:400,700" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="{{ asset('css/style.css') }}" />
</head>
</head>
<body>
@include('layouts.partials.header')

@if (isset($isCategory))
  @include('layouts.partials.banner')
@elseif (isset($isPost))
  @include('layouts.partials.post')
@endif

<div class="section">
	<div class="container">
  @if (isset($home))
	<div id="hot-post" class="row hot-post">
    <div class="col-md-8 hot-post-left">
			<!-- post -->
			<div class="post post-thumb">
				<a class="post-img" href=""><img src="{{ $hotNews[0]['newspaper_imgae'] }}" alt="news-img"
						style="height: 507px;"></a>
				<div class="post-body">
					<div class="post-category">
						<a href=""> {{$hotNews[0]->category['category_name']}}</a>
					</div>
					<h3 class="post-title title-lg">
						<a href="">{{ strip_tags($hotNews[0]['newspaper_title']) }}</a>
					</h3>
					<ul class="post-meta">
						<li><a href="author.html">{{ 'author' }}</a></li>
						@php
						$date = new DateTime($hotNews[0]['newspaper_date']);
						$date = $date->format('d M Y, H:i');
						@endphp
						<li>{{ $date }}</li>
					</ul>
				</div>
				<!-- /post -->
			</div>
        </div>
		<div class="col-md-4 hot-post-right">
			@for ($i = 1; $i < 3 ; $i++)
			<!-- post -->
			<div class="post post-thumb">
				<a class="post-img" href=""><img src="{{ $hotNews[$i]['newspaper_imgae'] }}" alt="news-img"
						style="height: 250px;"></a>
				<div class="post-body">
					<div class="post-category">
						<a href="">{{$hotNews[$i]->category['category_name']}}</a>
					</div>
					<h3 class="post-title title-lg"><a
							href="">{{ strip_tags($hotNews[$i]['newspaper_title']) }}</a></h3>
					<ul class="post-meta">
						<li><a href="author.html">{{ 'author' }}</a></li>
						@php
						$date = new DateTime($hotNews[$i]['newspaper_date']);
						$date = $date->format('d M Y, H:i');
						@endphp
						<li>{{ $date }}</li>
					</ul>
				</div>
			</div>
			@endfor
		</div>
  </div>
	@endif
	<div class="row">
		<div class="col-md-8">
			@yield('content')
		</div>
		<div class="col-md-4">
			@include('layouts.partials.sidebar')
		</div>
	</div>
	</div>
</div>
@include('layouts.partials.footer')
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/jquery.stellar.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script
src="https://code.jquery.com/jquery-3.4.1.min.js"
integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
crossorigin="anonymous"></script>
<script src="{{ asset('js/loadmore.js') }}"></script>
</body>
</html>