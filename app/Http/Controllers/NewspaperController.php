<?php

namespace App\Http\Controllers;

use App\Newspaper;
use App\Category;
use Illuminate\Http\Request;

class NewspaperController extends Controller
{
  public function manage() {
    return view('layouts.pages.newspaper.index');
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $newspapers = Newspaper::all();
    $home = true;
    $newsRecent = Newspaper::getLimitRecent(9);
    return view('layouts.pages.home', compact('newspapers', 'home', 'newsRecent'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      return view('layouts.pages.newspaper.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //1 Kiem tra du lieu
    $request->validate([
      'title' => 'required',
      'author' => 'required',
      'category' => 'required',
      'content' => 'required',
      'news_img' => 'required'
    ]);
    
    // Upload Image with Imgur API
    $client_id = '081600e309f2612';

    $filename = $request->file('news_img');

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
    

    //2 Tao Product Model, gan gia tri tu form len cac thuoc tinh cua Product model
    $newspaper = new Newspaper([
      'newspaper_title' => $request->get('title'),
      'author_id' => $request->get('author'),
      'category_id' => $request->get('category'),
      'newspaper_content' => $request->get('content'),
      'newspaper_imgae' => $url,
      'newspaper_date' => gmdate('Y-m-d H:i:s', time() + 7 * 3600),
      'newspaper_view' => 0
    ]);

    $newspaper->save();
    return redirect('/newspaper/create')->with('success', 'Newspaper added.');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Newspaper  $newspaper
   * @return \Illuminate\Http\Response
   */
  public function show($id, $slug = "")
  {
    $newspaper = Newspaper::find($id);
    $relative = Category::find($newspaper->category->id)->newspapers()->inRandomOrder()->limit(3)->get();
    $isPost = true;
    return view('layouts.pages.newspaper.show', compact('newspaper', 'isPost', 'relative'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Newspaper  $newspaper
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $newspaper = Newspaper::find($id);
    return view('layouts.pages.newspaper.edit', compact('newspaper'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Newspaper  $newspaper
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //1 Kiem tra du lieu
    $request->validate([
      'title' => 'required',
      'author' => 'required',
      'category' => 'required',
      'content' => 'required'
    ]);
    
    // Upload Image with Imgur API
    $url = $request->get('old_news_img');
    if ($request->file('news_img')) {
      $client_id = '081600e309f2612';

      $filename = $request->file('news_img');

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
    }

    //2 Tao Product Model, gan gia tri tu form len cac thuoc tinh cua Product model
    $newspaper = Newspaper::find($id);
    $newspaper->newspaper_title = $request->get('title');
    $newspaper->author_id = $request->get('author');
    $newspaper->category_id = $request->get('category');
    $newspaper->newspaper_content = $request->get('content');
    $newspaper->newspaper_imgae = $url;
    $newspaper->newspaper_date = gmdate('Y-m-d H:i:s', time() + 7 * 3600);
    $newspaper->newspaper_view = 0;
    // ]);

    $newspaper->save();
    return back()->with('success', 'Newspaper Updated.');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Newspaper  $newspaper
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $newspaper = Newspaper::find($id);
    $newspaper->delete();
    return back()->with('success', 'Newspaper Deleted.');
  }
}
