@extends('admin.layouts.app')
@section('title', 'Панель управления')

@section('content')

    <div class="row mt-3">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    Обратная связь с пользователями
                </div>
                <div class="card-body">
                    @foreach($feedbacks as $feedback)
                        <div class="toast fade show w-100 mb-2">
                            <div class="toast-header">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle me-2" viewBox="0 0 16 16">
                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                </svg>

                                <strong class="me-auto">{{ $feedback->email }}</strong>
                                <small>{{ $feedback->created_at->format('d.m.Y. / H:i') }}</small>
                            </div>
                            <div class="toast-body">
                                {{ $feedback->feedback }}
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="card-footer">
                    {{ $feedbacks->links() }}
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card mb-3">
                <div class="card-header">
                    Статистика
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <figure class="text-center m-0">
                        <blockquote class="blockquote m-0">
                            <p>{{ $postsCount }}</p>
                        </blockquote>
                        <figcaption class="blockquote m-0">
                            <h4>Постов</h4>
                        </figcaption>
                    </figure>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <figure class="text-center m-0">
                        <blockquote class="blockquote m-0">
                            <p>{{ $usersCount }}</p>
                        </blockquote>
                        <figcaption class="blockquote m-0">
                            <h4>Читателей</h4>
                        </figcaption>
                    </figure>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <figure class="text-center m-0">
                        <blockquote class="blockquote m-0">
                            <p>{{ $likesCount }}</p>
                        </blockquote>
                        <figcaption class="blockquote m-0">
                            <h4>Лайков</h4>
                        </figcaption>
                    </figure>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <figure class="text-center m-0">
                        <blockquote class="blockquote m-0">
                            <p>{{ $commentsCount }}</p>
                        </blockquote>
                        <figcaption class="blockquote m-0">
                            <h4>Комментариев</h4>
                        </figcaption>
                    </figure>
                </div>
            </div>
        </div>
    </div>

@endsection
