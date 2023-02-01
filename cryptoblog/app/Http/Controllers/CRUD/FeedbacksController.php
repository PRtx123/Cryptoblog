<?php

namespace App\Http\Controllers\CRUD;

use App\Http\Controllers\Controller;
use App\Models\Feedbacks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FeedbacksController extends Controller
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

        $validator = Validator::make($data, [
            'email' => 'required',
            'feedback' => 'required'
        ], [
            'email.required' => 'Поле email не может быть пустым',
            'feedback.required' => 'Поле сообщения не может быть пустым'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        $feeback = new Feedbacks();
        $feeback->email = $data['email'];
        $feeback->feedback = $data['feedback'];

        if (!$feeback->save()) {
            return back()->with('error', 'Не удалось отправить ваше сообщение');
        }

        return back()->with('success', 'Ваше сообщение отправлено');
    }

}
