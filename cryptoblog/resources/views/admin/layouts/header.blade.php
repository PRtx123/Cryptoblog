<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Панель управления</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('admin.panel') }}">Главная</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('admin.users') }}">Пользователи</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('admin.posts') }}">Посты</a>
                </li>
            </ul>
            <div class="d-flex" role="search">
                @if(Auth::guard('admins')->check())
                    <a href="#" class="btn btn-danger me-2" onclick="return document.getElementById('logoutForm').submit();">Выход</a>
                    <form id="logoutForm" action="{{ route('logoutAdmin') }}" method="POST">@csrf</form>
                @endif
            </div>
        </div>
    </div>
</nav>

<script type="text/javascript">


</script>
