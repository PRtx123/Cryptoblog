@extends('layouts.app')
@section('title', 'Обратная связь')

@section('header')
    <header class="header-dark header-dark-about">
        <div class="container hero mt-0">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <h1 class="text-center mt-5 pt-5">О блоге</h1>
                    <p class="ps-5 pe-5 mb-5" style="color: rgb(222,222,222);font-size: 18px;text-align: center;"><br>Топовый блог<br><br><br><br><br><br><br><br></p>
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
                <div class="col item social"><a href="https://vk.com/"><i class="fab fa-vk"></i></a><a href="https://www.youtube.com/"><i class="fab fa-youtube"></i></a><a href="https://web.telegram.org/z/"><i class="fab fa-telegram-plane"></i></a></div>
            </div>
            <p class="copyright">CRYPTOSID © 2022</p>
        </div>
    </footer>
@endsection
@section('content')

    <section class="contact-clean" style="background: rgba(255,255,255,0);">
        <form method="POST" action="{{ route('feedbacks.store') }}">
            @csrf
            <h2 class="text-center">Обратная связь</h2>
            <div class="mb-3"><input class="form-control" type="email" name="email" placeholder="Почта" inputmode="email"></div>
            <div class="mb-3"><textarea class="form-control" name="feedback" placeholder="Сообщение" rows="14"></textarea></div>
            <div class="mb-3 d-grid"><button class="btn btn-primary" type="submit" style="background: rgb(32,143,143);">Отправить</button></div>
        </form>
    </section>

@endsection
