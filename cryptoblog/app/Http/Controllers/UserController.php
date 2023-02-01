<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
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

        $user = new User();
        $user->nickname = $data['nickname'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
//        $user->updateTimestamps();

        try {
            if (!$user->save()) {
                throw new \Exception('Не удалось зарегестрировать пользователя');
            }
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
                return back()->with('error', 'Такой пользователь уже зарегестрирован');
            }

            return back()->with('error', 'Возникла неизвестная ошибка');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect(route('index'))->with('success', 'Вы успешно зарегистрированы!');
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'password' => ['required']
        ], [
            'password.required' => 'Поле пароля не может быть пустым'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        $user->password = Hash::make($data['password']);

        if (!$user->update()) {
            return back()->with('error', 'Не удалось изменить пароль');
        }

        return back()->with('success', 'Пароль изменён');
    }

    public function ban(User $user)
    {
        if (!$user) {
            return back()->with('error', 'Не удалось забанить читателя');
        }

        $user->is_banned = true;

        if (!$user->update()) {
            return back()->with('error', 'Не удалось забанить читателя');
        }

        return back()->with('success', 'Читатель забанен');
    }

    public function unban(User $user)
    {
        if (!$user) {
            return back()->with('error', 'Не удалось разбанить читателя');
        }

        $user->is_banned = false;

        if (!$user->update()) {
            return back()->with('error', 'Не удалось разбанить читателя');
        }

        return back()->with('success', 'Читатель разбанен');
    }


}
