<nav class="navbar navbar-expand-lg  p-0 pe-2 user-select-none">
    <a class="navbar-brand ms-1">Кабинет пользователя:</a>
    <button class="navbar-toggler me-1" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ps-2">
            <li class="nav-item">
                <a class="nav-link {{Route::is('cabinet_settings') ? 'link-danger' : 'text-black' }}" href="{{ route('cabinet_settings') }}">Настройки</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{Route::is('cabinet_new_post') ? 'link-danger' : 'text-black' }}" href="{{ route('cabinet_new_post') }}">Новый пост</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{Route::is('cabinet_all_post') ? 'link-danger' : 'text-black' }}" href="{{ route('cabinet_all_post') }}">Все посты</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{Route::is('cabinet_edit_post') ? 'link-danger' : 'text-black' }}" href="{{ route('cabinet_edit_post') }}">Редактируем пост</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{Route::is('site_index') ? 'link-danger' : 'text-black' }}" href="{{ route('site_index') }}">Сайт</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{Route::is('cabinet_statistic') ? 'link-danger' : 'text-black' }}" href="{{ route('cabinet_statistic') }}">Статистика</a>
            </li>
        </ul>
    </div>
</nav>