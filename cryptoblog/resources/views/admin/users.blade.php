@extends('admin.layouts.app')
@section('title', 'Пользователи')

@section('content')

    <div class="row mt-3">
        <div class="col">

            <table class="table">
                <thead>
                <th>#</th>
                <th>Email</th>
                <th>Никнейм</th>
                <th>Доступ к комментариям</th>
                <th>Дата регистрации</th>
                <th></th>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td class="align-middle">{{ $loop->index+1 }}</td>
                        <td class="align-middle">{{ $user->email }}</td>
                        <td class="align-middle">{{ $user->nickname }}</td>
                        <td class="align-middle">{{ $user->is_banned ? 'Нет' : 'Да' }}</td>
                        <td class="align-middle">{{ $user->created_at->format('d.m.Y / H:i') }}</td>
                        <td>
                            @if(!$user->is_banned)
                                <form method="POST" action="{{ route('users.ban', $user) }}">
                                    @method('PUT')
                                    @csrf
                                    <button class="btn btn-danger">
                                        Забанить
                                    </button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('users.unban', $user) }}">
                                    @method('PUT')
                                    @csrf
                                    <button class="btn btn-warning">
                                        Разбанить
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $users->links() }}
        </div>
    </div>

@endsection
