@extends('admin.layouts.app')
@section('title', 'Посты')

@section('content')

    <div class="container">
        <div class="row mt-3">
            <form method="POST" action="{{ route('posts.store') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Заголовок</label>
                    <input class="form-control @error('caption') is-invalid @enderror" @error('caption') placeholder="{{ $message }}" @enderror type="text" name="caption">
                </div>
                <div class="mb-3">
                    <label class="form-label">Ссылка на изображение</label>
                    <input class="form-control @error('url') is-invalid @enderror" @error('url') placeholder="{{ $message }}" @enderror type="url" name="url">
                </div>
                <div class="mb-3">
                    <label class="form-label">Содержание</label>
                    <textarea class="form-control @error('content') is-invalid @enderror" rows="5" name="content" @error('content') placeholder="{{ $message }}" @enderror></textarea>
                </div>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary" type="submit">
                        Создать
                    </button>
                </div>
            </form>
        </div>
        <div class="row mt-3">
            <div class="col">
                <table class="table">
                    <thead>
                        <th>#</th>
                        <th>Название статьи</th>
                        <th>Краткое описание</th>
                        <th>Лайков</th>
                        <th>Комментариев</th>
                        <th>Дата публикации</th>
                        <th>Дата изменения</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td class="align-middle">{{ $loop->index+1 }}</td>
                                <td class="align-middle">{{ $post->caption }}</td>
                                <td class="align-middle">{{ $post->getDescription() }}</td>
                                <td class="align-middle">{{ count($post->getLikes()) }}</td>
                                <td class="align-middle">{{ count($post->getComments()) }}</td>
                                <td class="align-middle">{{ $post->created_at->format('d.m.Y / H:i') }}</td>
                                <td class="align-middle">{{ $post->updated_at->format('d.m.Y / H:i') }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a title="Изменить пост" class="btn p-0 m-0 me-2" href="{{ route('posts.edit', $post) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#0d6efd" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                            </svg>
                                        </a>
                                        <form class="m-0 p-0" method="POST" action="{{ route('posts.destroy', $post) }}">
                                            @method('DELETE')
                                            @csrf
                                            <button title="Удалить пост" class="btn p-0 m-0 m-lg-2" type="submit" onclick="return confirm('Удалить пост?')">
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
                </table>
                {{ $posts->links() }}
            </div>
        </div>
    </div>

@endsection
