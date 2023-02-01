@extends('admin.layouts.app')
@section('title', 'Вход в панель администратора')

@section('content')

    <div class="container">
        @if(\Illuminate\Support\Facades\Session::exists('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ \Illuminate\Support\Facades\Session::get('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <section class="register-photo" style="background: rgb(255,255,255);">
            <div class="form-container">
                <div class="image-holder"></div>
                <form action="{{ route('loginAdmin') }}" method="POST">
                    @csrf
                    <h2 class="text-center"><strong>Вход в панель управления</strong></h2>
                    <div class="mb-3">
                        <input type="email" name="email" placeholder="email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password" placeholder="Пароль" class="form-control">
                    </div>
                    <div class="mb-3"><button class="btn btn-primary d-block w-100" type="submit" style="background: rgb(32, 143, 143);">Войти</button></div>
                </form>
            </div>
        </section>

@endsection

