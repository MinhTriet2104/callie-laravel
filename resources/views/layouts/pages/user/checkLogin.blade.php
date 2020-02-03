@php
use App\User;

$username = $_POST['username'];
$password = $_POST['password'];

$result = User::where([
  ['user_name', '=', $username],
  ['password', '=', $password]
]);


@endphp