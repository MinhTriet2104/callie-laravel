@php
use App\User;

$username = $_GET['username'];

$result = User::where('user_name', $username)->count();
echo $result;
@endphp