@extends('layouts.app')
@section('title')
    {{ $post->caption }}
@endsection

@section('content')

    <div class="row mt-3 mb-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Главная</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $post->caption }}</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col">
            <h1>{{ $post->caption }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">
                        <b>Лайков: </b> {{ count($post->getLikes()) }}
                    </li>
                    <li class="breadcrumb-item active">
                        <b>Комментариев: </b> {{ count($post->getComments()) }}
                    </li>
                    <li class="breadcrumb-item active"><b>Дата публикации:</b> {{ $post->created_at->format('d.m.Y, H:i') }}</li>
                </ol>
            </nav>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <textarea class="form-control content-textarea" rows="25" readonly style="border: 0; resize: none;">{{ $post->content }}</textarea>
            @auth('web')
                <div class="d-flex justify-content-end">
                    @if(!$post->isLiked($post, Auth::user()))
                        <form method="POST" action="{{ route('likes.store') }}">
                            @csrf
                            <input type="hidden" name="post" value="{{ $post->id }}">
                            <button title="Посавить лайк" class="btn btn-outline-danger me-2" type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                                </svg>
                            </button>
                        </form>
                    @else
                        @php $likes = $post->getPaginateLikes() @endphp
                        @foreach($likes as $like)
                        <form method="POST" action="{{ route('likes.destroy', $like) }}">
                            @method('DELETE')
                            @csrf
                        <button class="btn btn-outline-danger me-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                            </svg>
                        </button>
                        </form>
                        @endforeach
                    @endif
                    @if(!Auth::user()->is_banned)
                        <button class="btn btn-outline-primary green-hover"  data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Комментарий!
                        </button>
                    @endif
                </div>
                @if(!Auth::user()->is_banned)
                    <div class="accordion mt-3 m-0">
                        <div class="accordion-item" style="border: 0">
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body p-0">
                                    <form method="POST" action="{{ route('comments.store') }}">
                                        @csrf
                                        <input type="hidden" name="post" value="{{ $post->id }}">
                                        <div class="mb-3">
                                            <label class="form-label">Ваше мнение</label>
                                            <textarea class="form-control" rows="4" name="comment"></textarea>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button class="btn btn-primary border-0" style="background: rgb(32,143,143);" type="submit">
                                                Оставить комментарий
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endauth
        </div>
    </div>
    <div class="row mt-3 mb-3">
        <div class="col">
            <h4>Комментарии</h4>
            <hr>
            @php $comments = $post->getPaginateComments() @endphp
            {{ $comments->links() }}
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-1">
                    @foreach($comments as $comment)
                        <div class="toast fade show w-100 mb-2">
                            <div class="toast-header">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle me-2" viewBox="0 0 16 16">
                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                </svg>

                                <strong class="me-auto">{{ $comment->getUser()->nickname }}</strong>
                                <small>{{ $comment->created_at->format('d.m.Y. / H:i') }}</small>
                            </div>
                            <div class="toast-body">
                                {{ $comment->comment }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
