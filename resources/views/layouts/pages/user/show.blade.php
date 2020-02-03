<!DOCTYPE html>
<html lang="en">
	<head>
			<meta charset="UTF-8" />
			<meta name="viewport" content="width=device-width, initial-scale=1.0" />
			<meta http-equiv="X-UA-Compatible" content="ie=edge" />
			<title>Profile</title>
			<!-- Google font -->
			<link
					href="https://fonts.googleapis.com/css?family=Montserrat:400,700%7CMuli:400,700"
					rel="stylesheet"
			/>

			<!-- Bootstrap -->
			<link
					type="text/css"
					rel="stylesheet"
					href="{{ asset('css/bootstrap.min.css') }}"
			/>

			<!-- Font Awesome Icon -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" />
      <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">

			<!-- Custom stlylesheet -->
			<link
					type="text/css"
					rel="stylesheet"
					href="{{ asset('css/style.css') }}"
			/>
	</head>
	<body>
    @include('layouts.partials.header')
    <div class="container" style="margin-top: 1rem;">
        <div class="row">
          @if (session()->get('success'))
          <div class="alert alert-success">
              {{ session()->get('success') }}
          </div>
          @endif
          @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
              @foreach ($errors->all() as $error)
                  <li>Chưa chọn avatar mới: {{ $error }}</li>
              @endforeach
              </ul>
          </div>
          @endif
            <div class="panel panel-default">
              <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{ method_field('PATCH') }}
                <div class="panel-heading"><h2><i class="fas fa-address-card"></i><span style="margin-left: 1rem;">Profile<span></h2></div>
                <div class="panel-body">
                    <div class="col-md-4 col-xs-12 col-sm-6 col-lg-4">
                      <img
                        alt="User Pic"
                        src="{{ $user->user_avatar }}"
                        id="avatar"
                        class="img-circle img-responsive img-fluid"
                        style="border: 1px solid #333; border-radius: 50%;"
                      />
                      <p>
                        <i class="far fa-image"></i>
                        <span style="margin-left: 1rem">New avatar: <input type="file" name="user_avatar" onchange="readURL(this)"><span>
                      </p>
                    </div>
                    <div class="col-md-8 col-xs-12 col-sm-6 col-lg-8">
                        <div class="container">
                            <h2>{{ $user->user_name }}</h2>
                        </div>
                        <hr />
                        <ul class="container details">
                            <li>
                                <p>
                                  <i class="fas fa-user"></i>
                                  <span style="margin-left: 1rem">Username: {{ $user->user_name }}</span>
                                </p>
                            </li>
                            <li>
                              <p>
                                <i class="fas fa-envelope"></i>
                                <span style="margin-left: 1rem">Username: {{ $user->user_email }}</span>
                              </p>
                            </li>
                        </ul>
                        <hr />
                        <div class="col-sm-5 col-xs-6 tital ">
                          <i class="fas fa-calendar-check"></i>
                          @php
                          $date = new DateTime($user->created_at);
                          $date = $date->format('d M Y, H:i');
                          @endphp
                          <span style="margin-left: 1rem">Date Join: {{ $date }}</span>
                        </div>
                        <br>
                        <button class="btn btn-success" type="submit" style="padding: 1rem 2rem; margin-left: 1rem; margin-top: 2rem; font-size: 1.8rem;"><i class="far fa-save"></i><span style="margin-left: 0.5rem;">Save</span></button>
                    </div>
                </div>
              </form>
            </div>
        </div>
    </div>
	</body>
	<script src="{{ asset('js/jquery.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/jquery.stellar.min.js') }}"></script>
  <script src="{{ asset('js/main.js') }}"></script>
  <script type="text/javascript">
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
          $('#avatar').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>
</html>
