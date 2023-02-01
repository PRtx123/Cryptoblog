<?php

namespace App\Http\Controllers\CRUD;

use App\Http\Controllers\Controller;
use App\Models\Admin\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validation = Validator::make($data, [
            'caption' => 'required',
            'content' => 'required',
            'url' => 'required'
        ], [
            'caption.required' => 'Заголовок не может быть пустым',
            'content.required' => 'Содержание статьи не может быть пустым',
            'url.required' => 'Ссылка на изображение не может быть пустой'
        ]);

        if ($validation->fails()) {
            return back()->withErrors($validation->errors());
        }

        $post = new Posts();
        $post->caption = $data['caption'];
        $post->content = $data['content'];
        $post->url = $data['url'];

        if (!$post->save()) {
            return back()->with('error', 'Не удалось создать пост');
        }

        return back()->with('success', 'Пост успешно создан');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Posts  $posts
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Posts $post)
    {
        return view('admin.posts.show', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Posts  $posts
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Posts $post)
    {
        return view('admin.posts.edit', [
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Posts $post)
    {
        if (!$post) {
            return back()->with('error', 'Не удалось изменить пост');
        }

        $data = $request->all();

        //validation

        $post->caption = $data['caption'];
        $post->content = $data['content'];


        if (!$post->update()) {
            return back()->with('error', 'Не удалось изменить пост');
        }

        return back()->with('success', 'Пост изменён');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Posts $post)
    {
        if (!$post) {
            return back()->with('error', 'Не удалось удалить пост');
        }

        if (!$post->delete()) {
            return back()->with('error', 'Не удалось удалить пост');
        }

        return back()->with('success', 'Пост удалён');
    }
}
