<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Administration</title>
  <!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700%7CMuli:400,700" rel="stylesheet">

  <!-- Bootstrap -->
  <link type="text/css" rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />

  <!-- Font Awesome Icon -->
  <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">

  <!-- Custom stlylesheet -->
  <link type="text/css" rel="stylesheet" href="{{ asset('css/style.css') }}" />
</head>
<body>
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
                  @if (isset($_SESSION['user_id']))
                  <li><a href="{{ url('/user/show/' . $_SESSION['user_id']) }}">Profile</a></li>
                  @if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == "admin")
                  <li><a href="{{ url('/newspaper/manage') }}">Administration</a></li>
                  @endif
                  <li><a href="{{ url('/user/logout') }}">Logout</a></li>
                  @else
                  <li><a href="{{ url('/user/login') }}">Login</a></li>
                  <li><a href="{{ url('/user/signup') }}">Register</a></li>
                  @endif
                </ul>
              </div>
            </div>
          </li>
          <!-- Categories -->
          <li><a role="button" class="category-btn" id="0">Tất cả</a></li>
          @for ($i = 1; $i <= count($categories); $i++)
          <li><a role="button" class="category-btn" id="{{ $i }}">{{ $categories[$i - 1]['category_name'] }}</a></li>
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

          @for ($i = 1; $i <= count($categories); $i++)
          <li><a role="button" class="category-btn" id="{{ $i }}">{{ $categories[$i - 1]['category_name'] }}</a></li>
          @endfor
          
          </ul>
        </li>
        </li>
        @if (isset($_SESSION['user_id']))
        <li><a href="{{ url('/user/show/' . $_SESSION['user_id']) }}">Profile</a></li>
        @if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == "admin")
        <li><a href="{{ url('/newspaper/manage') }}">Administration</a></li>
        @endif
        <li><a href="{{ url('/user/logout') }}">Logout</a></li>
        @else
        <li><a href="{{ url('/user/login') }}">Login</a></li>
        <li><a href="{{ url('/user/signup') }}">Register</a></li>
        @endif
      </ul>
      <button class="nav-close nav-aside-close"><span></span></button>
    </div>
    <!-- /Aside Nav -->
  </div>
  <!-- /NAV -->
</header>

<!-- Content -->
<!-- SECTION -->
<div class="section">
  <!-- container -->
  <div class="container">
      <!-- post -->
      <a class="btn btn-success" href="{{ route('newspaper.create') }}" role="button" style="font-size: 2rem; padding: 1rem 2rem;">Write a new article</a>
      <hr style="border-top: 1px solid #ee4266;">
      <div id="content"></div>
      <div class="section-row loadmore text-center">
        <input type="button" class="primary-button" id="load-more" value="load more">
        <input type="hidden" id="category-id" value="">
      </div>
      <!-- /post -->
  </div>
  <!-- /Container -->
</div>
<!-- /SECTION -->
<!-- /Content -->

@include('layouts.partials.footer')
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/jquery.stellar.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/loadmoreAdmin.js') }}"></script>
</body>
</html>