<?php

namespace App\Http\Controllers\CRUD;

use App\Http\Controllers\Controller;
use App\Models\Comments;
use Illuminate\Http\Request;

class CommentsController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $comment = new Comments();
        $comment->user = $request->user()->id;
        $comment->post = $request->post;
        $comment->comment = $request->comment;

        if (!$comment->save()) {
            return back()->with('error', 'Не удалось оставить комментарий');
        }

        return back()->with('success', 'Комментарий успешно опубликован');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comments  $comments
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comments $comment)
    {
        if (!$comment) {
            return back()->with('error', 'Не удалось удалить комментарий');
        }

        if (!$comment->delete()) {
            return back()->with('error', 'Не удалось удалить комментарий');
        }

        return back()->with('success', 'Комментарий удалён');
    }
}
