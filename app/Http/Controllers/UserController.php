<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      //
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $request->validate([
      'username' => 'required',
      'email' => 'required',
      'password' => 'required'
    ]);

    $user = new User([
      'user_name' => $request->get('username'),
      'user_password' => $request->get('password'),
      'user_email' => $request->get('email')
    ]);

    $user->save();
    return redirect('/user/login')->with('success', 'Signup Successful.');;
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $user = User::find($id);
    return view('layouts.pages.user.show', compact('user'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $request->validate([
      'user_avatar' => 'required'
    ]);

    $client_id = '081600e309f2612';

    $filename = $request->file('user_avatar');

    $handle = fopen($filename, "r");
    $data = fread($handle, filesize($filename));
    $pvars   = array('image' => base64_encode($data));
    $timeout = 60;
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'https://api.imgur.com/3/image.json');
    curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id));
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $json_returned = curl_exec($curl); // blank response
    curl_close ($curl);
    $pms = json_decode($json_returned, true);
    $url = $pms['data']['link'];

    $user = User::find($id);
    $user->user_avatar = $url;

    $user->save();
    return back()->with('success', 'Avatar Updated.');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
      //
  }

  public function login() {
    return view('layouts.pages.user.login');
  }

  public function logout() {
    session_start();
    session_destroy();
    return redirect('/');
  }

  public function signup() {
    return view('layouts.pages.user.signup');
  }

  public function checkLogin(Request $request) {
    $previousUrl = $request->get('previous');
    $username = $request->get('username');
    $password = $request->get('password');
  
    $user = User::where([
      ['user_name', '=', $username],
      ['user_password', '=', $password]
    ])->get();

    if (count($user) != 0) {
      session_start();
      $_SESSION['user_id'] = $user[0]->id;
      $_SESSION['user_role'] = $user[0]->user_role;
      return redirect($previousUrl);
    } else {
      return redirect('/user/login')->with('notification', "Wrong Username or Password");
    }
  }
}
