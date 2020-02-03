@php
$time = "";
$date = gmdate('Y-m-d H:i:s', time() + 7 * 3600);
@endphp

@foreach ($commentList as $comment)
@php
$diff = strtotime($date) - strtotime($comment['comment_date']);
if ($diff < 60) {
  $time = "$diff giây trước";
} else if ($diff < 3600) {
  $diff = floor($diff / 60);
  $time = "$diff phút trước";
} else if ($diff < 3600 * 24) {
  $diff = floor($diff / 3600);
  $time = "$diff giờ trước";
} else {
  $diff = floor($diff / (3600 * 24));
  $time = "$diff ngày trước";
}
@endphp
<!-- comment -->
<div class="media">
  <div class="media-left">
    <img class="media-object" src="{{ $comment->user->user_avatar }}" alt="avatar-img">
  </div>
  <div class="media-body">
    <div class="media-heading">
      <h4>{{ $comment->user->user_name }}</h4>
      <span class="time">{{ $time }}</span>
    </div>
    <p>{{ $comment['comment_content'] }}</p>
  </div>
</div>
<!-- /comment -->
@endforeach
