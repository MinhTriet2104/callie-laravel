<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      $role = "";
      // Neu la admin
      if (session_status() == PHP_SESSION_NONE) {
        session_start();
      }

      if (isset($_SESSION['user_role'])) $role = $_SESSION['user_role'];

      if($role == "admin")
      {
        //Tiep tuc truy cap
        return $next($request);
      }
      // Neu la customer
      elseif ($role == "member")
      {
        return redirect('/');
      }
      else {
        // Chuyen toi dang nhap
        return redirect('user/login');
      }
    }
}
