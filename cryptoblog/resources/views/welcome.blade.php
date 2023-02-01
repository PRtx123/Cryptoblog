@extends('layouts.app')
@section('title', 'Главная')

@section('header')
    <header class="header-dark">
        <div class="container hero mt-0">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <h1 class="text-center mt-5 pt-5">The Revolution is Here.</h1>
                    <p class="ps-5 pe-5 mb-5" style="color: rgb(222,222,222);font-size: 18px;text-align: center;"><br><br><br></p>
                </div>
            </div>
        </div>
    </header>
@endsection
@section('footer')
    <footer class="footer-dark mt-4">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-3 item">
                    <h3>Навигация</h3>
                    <ul>
                        <li><a href="{{route('index')}}">Лента</a></li>
                        <li><a href="{{route('about')}}">Обратная связь</a></li>
                        <li><a href="{{route('auth')}}">Вход</a></li>
                        <li><a href="{{route('registration')}}">Регистрация</a></li>
                        <li></li>
                    </ul>
                </div>
                <div class="col-sm-6 col-md-3 item"></div>
                <div class="col-md-6 item text">
                    <h3>CRYTPOSID</h3>
                    <p>Личный блог Вадима Сидорова о крипте</p>
                </div>
                <div class="col item social"><a href="https://vk.com"><i class="fab fa-vk"></i></a><a href="https://www.youtube.com/"><i class="fab fa-youtube"></i></a><a href="https://web.telegram.org/z/"><i class="fab fa-telegram-plane"></i></a></div>
            </div>
            <p class="copyright">CRYPTOSID © 2022</p>
        </div>
    </footer>
@endsection
@section('content')

    <div class="container">
        <h1 class="text-center mt-5 mb-4 pt-3 pb-4" id="lenta" style="font-weight: bold;">Лента</h1>
    </div>
    @foreach($posts as $post)
        <div class="container mb-4 rounded ps-0 pe-0" style="box-shadow: 0px 0px 10px rgba(33,37,41,0.15);">
            <div class="row">
                <div class="col-lg-6 col-xl-6 col-xxl-5 offset-xl-0 p-0" style="background: #fbfbfb;"><img class="img-fluid rounded-start" src="{{ $post->url }}"></div>
                <div class="col position-relative"><button class="btn disabled link-dark p-0 mt-2 border-0" type="button" disabled="" style="color: rgb(23,23,23);"><i class="far fa-calendar-alt me-2 ms-2"></i>{{ $post->created_at->format('d.m.Y / H:i') }}</button>
                    <h2 class="text-start mt-2 ms-2">{{ $post->caption }}</h2>
                    <p class="mt-1 ms-2" style="font-size: 18px;">{{ $post->getDescription() }}<br></p>
                    <div class="row position-absolute fixed-bottom mb-3 m-0">
                        <div class="col-lg-7 col-xl-7 col-xxl-7 offset-xl-0 offset-xxl-0 d-grid gap-2 d-md-flex justify-content-md-start p-0"><button class="btn disabled link-dark p-0 me-3 ms-3 border-0" type="button" style="color: rgb(160,160,160);" disabled=""><i class="far fa-heart me-1" style="color: rgb(160,160,160);"></i>{{ $post->getLikes()->count() }}</button><button class="btn disabled link-dark p-0 me-3 border-0" type="button" style="color: rgb(160,160,160);" disabled=""><i class="far fa-comments me-1" style="color: rgb(160,160,160);"></i>{{ $post->getComments()->count() }}</button>
                            <div class="btn-group" role="group"></div>
                        </div>
                        <div class="col-lg-5 col-xl-5 offset-xl-0 d-grid gap-2 d-md-flex justify-content-md-end p-0"><a class="btn btn-primary rounded me-4 border-0" type="button" href="{{ route('posts.show', $post) }}" style="background: rgb(32,143,143);width: 226.641px;">Читать далее</a></div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{$posts->links()}}


@endsection

