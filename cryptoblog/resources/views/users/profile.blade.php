@extends('layouts.app')
@section('title', 'Профиль')

@section('content')

    <div class="row mt-3 mb-3">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    Информация
                </div>
                <div class="card-body">
                    <table class="table m-0">
                        <tbody>
                            <tr>
                                <td>Email</td>
                                <td>{{ Auth::user()->email }}</td>
                            </tr>
                            <tr>
                                <td>Никнейм</td>
                                <td>{{ Auth::user()->nickname }}</td>
                            </tr>
                            <tr>
                                <td>
                                    <span title="Мои комментарии">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-chat-left-dots" viewBox="0 0 16 16">
                                            <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                            <path d="M5 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                        </svg>
                                    </span>
                                </td>
                                <td>
                                    {{ Auth::user()->commentsCount() }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span title="Мои лайки">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#dc3545" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                                        </svg>
                                    </span>
                                </td>
                                <td>
                                    {{ Auth::user()->likesCount() }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    Сменить пароль
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('users.update', Auth::user()) }}">
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Новый пароль</label>
                            <input class="form-control @error('password') is-invalid @enderror" @error('password') placeholder="{{ $message }}" @enderror type="password" name="password">
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary" style="background: rgb(32, 143, 143);" type="submit">
                                Сменить
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Избарнные статьи
                </div>
                <div class="card-body">
                    @if(count($likedPosts) > 0)
                        <table class="table m-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Заголовок</th>
                                <th>Дата публикации</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($likedPosts as $likedPost)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $likedPost->caption }}</td>
                                    <td>{{ $likedPost->created_at->format('d.m.Y / H:i') }}</td>
                                    <td>
                                        <a href="{{ route('posts.show', $likedPost->id) }}" target="_blank">Перейти</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>Здесь появятся статьи, которые вы лайкнули</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
