<nav class="navbar navbar-expand-lg  p-0 pe-2 user-select-none">

    <a class="navbar-brand p-0 m-0">Админка:</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ps-2">
            <li class="nav-item">
                <a class="nav-link {{Route::is('admin_index') ? 'link-danger' : 'text-black' }}" href="{{ route('admin_index')}}">Начальная</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{Route::is('admin_complaints') ? 'link-danger' : 'text-black' }}" href="{{ route('admin_complaints')}}">Жалобы</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{Route::is('admin_users') ? 'link-danger' : 'text-black' }}" href="{{ route('admin_users')}}">Все пользователи</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{Route::is('admin_posts') ? 'link-danger' : 'text-black' }}" href="{{ route('admin_posts')}}">Все посты</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{Route::is('admin_comments') ? 'link-danger' : 'text-black' }}" href="{{ route('admin_comments')}}">Все комментарии</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{Route::is('admin_replys') ? 'link-danger' : 'text-black' }}" href="{{ route('admin_replys')}}">Все ответы на комментарии</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{Route::is('admin_sites') ? 'link-danger' : 'text-black' }}" href="{{ route('admin_sites')}}">Все сайты</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{Route::is('admin_settings') ? 'link-danger' : 'text-black' }}" href="{{ route('admin_settings')}}">Настройки</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{Route::is('admin_statistics') ? 'link-danger' : 'text-black' }}" href="{{ route('admin_statistics')}}">Статистика</a>
            </li>
        </ul>
    </div>
</nav>