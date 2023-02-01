@extends('admin.layouts.app')
@section('title', 'Редактирование поста')

@section('content')
    <div class="container">
        <div class="row mt-3 mb-3">
            <div class="col">
                <form method="POST" action="{{ route('posts.update', $post) }}">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Заголовок</label>
                        <input class="form-control" type="text" name="caption" value="{{ $post->caption }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Содержание</label>
                        <textarea class="form-control" rows="15" name="content">{{ $post->content }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Дата публикации</label>
                        <input type="text" class="form-control" readonly value="{{ $post->created_at->format('d.m.Y / H:i') }}">
                    </div>
                    <div class="d-flex justify-content-end">
                        <a class="btn btn-outline-primary me-2" href="{{ route('admin.posts') }}">
                            Назад
                        </a>
                        <button class="btn btn-primary" type="submit">
                            Сохранить
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h1>
                    Комментарии к посту
                </h1>
                @php $comments = $post->getPaginateComments() @endphp
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Пользователь</th>
                            <th>Комментарий</th>
                            <th>Дата комментария</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($comments as $comment)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $comment->getUser()->nickname }}</td>
                                <td>{{ $comment->comment }}</td>
                                <td>{{ $comment->created_at->format('d.m.Y / H:i') }}</td>
                                <td>
                                    <div class="d-flex justify-content-end">
                                        <form method="POST" action="{{ route('comments.destroy', $comment) }}">
                                            @method('DELETE')
                                            @csrf
                                            <button title="Удалить комментарий" type="submit" class="btn p-0 m-0" onclick="return confirm('Удалить комментарий?')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#dc3545" class="bi bi-trash3" viewBox="0 0 16 16">
                                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5">{{ $comments->links() }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h1>
                    Лайки к посту
                </h1>
                @php $likes = $post->getPaginateLikes() @endphp
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Пользователь</th>
                        <th>Дата лайка</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($likes as $like)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ $like->getUser()->nickname }}</td>
                            <td>{{ $like->created_at->format('d.m.Y / H:i') }}</td>
                            <td>
                                <div class="d-flex justify-content-end">
                                    <form method="POST" action="{{ route('likes.destroy', $like) }}">
                                        @method('DELETE')
                                        @csrf
                                        <button title="Удалить лайк" type="submit" class="btn p-0 m-0" onclick="return confirm('Удалить лайк?')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#dc3545" class="bi bi-trash3" viewBox="0 0 16 16">
                                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="4">{{ $likes->links() }}</td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

@endsection
