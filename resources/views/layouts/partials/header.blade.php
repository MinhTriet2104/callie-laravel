<!-- HEADER -->
<header id="header">
		<!-- NAV -->
		<div id="nav">
			<!-- Top Nav -->
			<div id="nav-top">
				<div class="container">
					<!-- social -->
					<ul class="nav-social">
						<li><a href="#"><i class="fa fa-facebook"></i></a></li>
						<li><a href="#"><i class="fa fa-twitter"></i></a></li>
						<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
						<li><a href="#"><i class="fa fa-instagram"></i></a></li>
					</ul>
					<!-- /social -->

					<!-- logo -->
					<div class="nav-logo">
						<a href="{{ url('/') }}" class="logo"><img src="{{ asset('img/logo.png') }}" alt=""></a>
					</div>
					<!-- /logo -->

					<!-- search & aside toggle -->
					<div class="nav-btns">
						<button class="aside-btn"><i class="fa fa-bars"></i></button>
						<button class="search-btn"><i class="fa fa-search"></i></button>
						<div id="nav-search">
						<form method="get" action="{{ 'Search' }}" >
								<input class="input" name="keyword" placeholder="Enter your search...">
							</form>
							<button class="nav-close search-close">
								<span></span>
							</button>
						</div>
					</div>
					<!-- /search & aside toggle -->
				</div>
			</div>
			<!-- /Top Nav -->

			<!-- Main Nav -->
			<div id="nav-bottom">
				<div class="container">
					<!-- nav -->
					<ul class="nav-menu">
						<li class="has-dropdown">
							<a href="{{ url('/') }}">Trang chủ</a>
							<div class="dropdown">
								<div class="dropdown-body">
									<ul class="dropdown-list">										
										<li><a href="about.html">About Us</a></li>
										<li><a href="contact.html">Contacts</a></li>
										<li><a href="blank.html">Regular</a></li>
									</ul>
								</div>
							</div>
						</li>
            <!-- Tin moi -->
						<li class="has-dropdown megamenu">
							<a href="#">Tin mới</a>
							<div class="dropdown tab-dropdown">
								<div class="row">
									<div class="col-md-2">
										<ul class="tab-nav">
											
											<li class="active"><a data-toggle="tab" href="#tab1">{{ $categories[0]['category_name'] }}</a></li>
											@for ($i = 1; $i < count($categories); $i++)
											<li><a data-toggle="tab" href="#tab{{ $i + 1 }}">{{ $categories[$i]['category_name'] }}</a></li>
											@endfor

										</ul>
									</div>
									<div class="col-md-10">
										<div class="dropdown-body tab-content">
											<!-- tab1 -->
											<div id="tab1" class="tab-pane fade in active">
												<div class="row">
												@php
												$categoryNews = $categories[0]->getLimitRecentByCategoryId(3);
                        @endphp
												
												@foreach ($categoryNews as $news)
												<!-- post -->
												<div class="col-md-4">
													<div class="post post-sm">
														<a class="post-img" href="blog-post.html"><img src="{{ $news['newspaper_imgae'] }}" alt="news-img"></a>
														<div class="post-body">
															<div class="post-category">
																<a href="{{ route('category.show', ['id' => $categories[0]->id]) }}">{{ $categories[0]['category_name'] }}</a>
															</div>
															<h3 class="post-title title-sm"><a href="">{{ strip_tags($news['newspaper_title']) }}</a></h3>
															<ul class="post-meta">
																<li><a href="author.html">{{ $news->author->author_name }}</a></li>
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
												</div>
											</div>
											<!-- /tab1 -->

											<!-- tab2 -> end -->
											@for ($i=2; $i <= count($categories); $i++)
											<div id="tab{{ $i }}" class="tab-pane fade in">
												<div class="row">
												@php
												$categoryNews = $categories[$i - 1]->getLimitRecentByCategoryId(3);
												@endphp
												@foreach ($categoryNews as $news)
												<!-- post -->
												<div class="col-md-4">
													<div class="post post-sm">
														<a class="post-img" href="{{ route('newspaper.show', ['slug' => Str::slug(strip_tags($news->newspaper_title)), 'id' => $news->id]) }}"><img src="{{ $news['newspaper_imgae'] }}" alt="news-img"></a>
														<div class="post-body">
															<div class="post-category">
																<a href="{{ route('category.show', ['id' => $categories[$i - 1]->id]) }}">{{ $categories[$i - 1]['category_name'] }}</a>
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
												</div>
											</div>
											@endfor
										</div>
									</div>
								</div>
							</div>
						</li>
						<!-- Categories -->
						@for ($i = 0; $i < count($categories); $i++)
						<li><a href="{{ route('category.show', ['id' => $categories[$i]->id]) }}">{{ $categories[$i]['category_name'] }}</a></li>
						@endfor
					<!-- /nav -->
				</div>
			</div>
			<!-- /Main Nav -->

			<!-- Aside Nav -->
			<div id="nav-aside">
				<ul class="nav-aside-menu">
				<li><a href="{{ url('/') }}">Home</a></li>
					<li class="has-dropdown"><a>Categories</a>
						<ul class="dropdown">

						@for ($i = 0; $i < count($categories); $i++)
						<li><a href="{{ route('category.show', ['id' => $categories[$i]->id]) }}">{{ $categories[$i]['category_name'] }}</a></li>
						@endfor
            
						</ul>
					</li>
					</li>
					<li><a href="about.html">About Us</a></li>
					<li><a href="contact.html">Contacts</a></li>
					<li><a href="#">Advertise</a></li>
				</ul>
				<button class="nav-close nav-aside-close"><span></span></button>
			</div>
			<!-- /Aside Nav -->
		</div>
		<!-- /NAV -->
	</header>
	<!-- /HEADER -->