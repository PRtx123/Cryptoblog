<nav class="navbar navbar-dark navbar-expand-lg navigation-clean-search" style="background: rgb(40,45,50);">
    <div class="container"><a class="navbar-brand" href="{{ route('index') }}">CRYPTOSID</a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-2"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navcol-2">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="{{ route('index') }}">Лента</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">Обратная связь</a></li>
            </ul>
            <form class="me-auto" target="_self">
                <div class="d-flex align-items-center"><label class="form-label d-flex mb-0" for="search-field"></label></div>
            </form>
            @if(!Auth::guard('web')->check())
                <span class="navbar-text me-2">
            <a class="login text-decoration-none me-2" href="{{ route('auth') }}">Войти</a></span>
                <a class="btn btn-primary action-button rounded-pill" role="button" href="{{ route('registration') }}" style="background: rgb(32, 143, 143);border-style: none;">Регистрация</a>
            @endif

            @auth('web')
                <a href="{{ route('user.profile') }}" style="color: white" class="login text-decoration-none me-2">Профиль</a>
                <a href="#" class="btn btn-primary action-button rounded-pill" style="background: rgb(32, 143, 143);border-style: none;" onclick="return document.getElementById('logoutForm').submit();">Выход</a>
                <form id="logoutForm" action="{{ route('logoutUser') }}" method="POST">@csrf</form>
            @endauth
        </div>
    </div>
</nav>

<script type="text/javascript">


</script>

