<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Newspaper;
use Illuminate\Http\Request;

class CommentController extends Controller
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
      $commentList = [];
      $newsId = $request->get('newsId');
      $newspaper = Newspaper::find($newsId);

      $date = gmdate('Y-m-d H:i:s', time() + 7 * 3600);
      if ($request->get('userId')) {
        $userId = $request->get('userId');
        $content = $request->get('content');
      
        $comment = new Comment([
          'comment_content' => $content,
          'comment_date' => $date,
          'user_id' => $userId,
          'newspaper_id' => $newsId
        ]);

        $newComment = $newspaper->comments()->save($comment);
        array_push($commentList, $newComment);
      } else {
        $commentList = $newspaper->comments()->orderBy('comment_date', 'desc')->get();
      }

      return view('layouts.pages.comment', compact('commentList'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
