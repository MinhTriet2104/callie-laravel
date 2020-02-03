@php
use App\User;

$email = $_GET['email'];

$result = User::where('user_email', $email)->count();
echo $result;
@endphp