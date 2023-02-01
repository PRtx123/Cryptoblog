<?php

namespace App\Http\Controllers\CRUD;

use App\Http\Controllers\Controller;
use App\Models\Likes;
use Illuminate\Http\Request;

class LikesController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $like = new Likes();
        $like->user = $request->user()->id;
        $like->post = $request->post;

        if (!$like->save()) {
            return back()->with('error', 'Не удалось поставить лайк');
        }

        return back()->with('success', 'Вы успешно поставили лайк');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Likes  $likes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Likes $like)
    {
        if (!$like) {
            return back()->with('error', 'Не удалось удалить лайк');
        }

        if (!$like->delete()) {
            return back()->with('error', 'Не удалось удалить лайк');
        }

        return back()->with('success', 'Лайк удалён');
    }
}
