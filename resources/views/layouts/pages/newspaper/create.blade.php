<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Create Newspaper</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">
  <!-- <link
    href="https://unpkg.com/filepond/dist/filepond.css"
    rel="stylesheet"
  />
  <link
    href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
    rel="stylesheet"
  />
  <script
    defer
    src="https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.js"
  ></script>
  <script
    defer
    src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"
  ></script>
  <script defer src="https://unpkg.com/filepond/dist/filepond.js"></script> -->
  <!-- <script defer src="{{ asset('js/fileUpload.js') }}"></script> -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css" />
  <script defer src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script> -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.js"></script>
</head>
<body>
<div class="container">
  <h1 class="text-center my-3 mt-3">Create Newspaper</h1>
  <!-- Success -->
  @if (session()->get('success'))
  <div class="alert alert-success">
      {{ session()->get('success') }}
  </div>
  @endif
  <!-- Errors -->
  @if ($errors->any())
  <div class="alert alert-danger">
      <ul>
      @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
      @endforeach
      </ul>
  </div>
  @endif
  <!-- Form -->
  <form action="{{ route('newspaper.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="title">News Title</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Title">
      </div>
      <div class="form-group col-md-6">
        <label for="author">Author</label>
        <select id="author" name="author" class="form-control">
          @foreach ($authors as $author)
          <option value="{{ $author->id }}">{{ $author->author_name }}</option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="author">Category</label>
        <select id="category" name="category" class="form-control">
          @foreach ($categories as $category)
          <option value="{{ $category->id }}">{{ $category->category_name }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group col-md-6">
        <label for="news_image" class="col-form-label">News Image</label>
        <input type="file" class="form-control-file" name="news_img">
      </div>
    </div>

    <div class="form-row">
      <div class="from-group col-md-12">
        <label for="content">News Content</label>
        <textarea class="form-control" id="summernote" name="content"></textarea>
      </div>
    </div>
    <button type="submit" class="btn btn-primary btn-block py-2 mt-4">Create</button>
  </form>
</div>
<script>
  $('#summernote').summernote({
    placeholder: 'Newspaper content...',
    height: '250'
  });
</script>
</body>
</html>