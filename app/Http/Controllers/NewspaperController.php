<?php

namespace App\Http\Controllers;

use App\Newspaper;
use App\Category;
use Illuminate\Http\Request;

class NewspaperController extends Controller
{
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Newspaper  $newspaper
     * @return \Illuminate\Http\Response
     */
    public function show($id, $slug)
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
    public function edit(Newspaper $newspaper)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Newspaper  $newspaper
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Newspaper $newspaper)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Newspaper  $newspaper
     * @return \Illuminate\Http\Response
     */
    public function destroy(Newspaper $newspaper)
    {
        //
    }
}
