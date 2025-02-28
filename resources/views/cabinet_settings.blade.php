@extends('layouts/main')



@section('posts')
    <nav class="navbar navbar-expand-lg  p-0 pe-2">

        <a class="navbar-brand ms-2">Кабинет пользователя:</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ps-2">
                <li class="nav-item">
                    <a class="link-danger nav-link" href="{{ route('cabinet_settings') }}">Настройки</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cabinet_new_post') }}">Новый пост</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cabinet_all_post') }}">Все посты</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cabinet_edit_post') }}">Редактируем пост</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('site_index') }}">Сайт</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cabinet_statistic') }}">Статистика</a>
                </li>
            </ul>
        </div>

    </nav>
<div class="row px-1">
    <div class="m-2">
        <b>Ваше имя пользователя: {{ $user->name }}</b>
    </div>
    <hr>
    <form action="{{ route('cabinet_settings_edit_name') }}" method="POST">
        @csrf
        @method ('PUT')
        <label class="form-label ms-2 my-2">Вы можете изменить свое имя пользователя тут, минимум 4 символа и максимум 20</label>
        <input class="form-control my-2" type="text" name="new_name" placeholder = "Введите новое имя">
        @error('new_name')
            <b class="link-danger ms-2">Ошибка: {{ $message }}</b>
        @enderror
        <input class="form-control btn btn-primary my-2" type="submit">
    </form>

    <hr>


    <form action="{{ route('cabinet_settings_edit_login') }}" method="POST">
        @csrf
        @method ('PUT')
        <label class="form-label ms-2 my-2">Вы можете изменить свой логин, минимум 8 символов и максимум 20</label>
        <input class="form-control my-2 " type="text" name="new_login" placeholder = "Введите новый логин">
        @error('new_login')
            <b class="link-danger ms-2">Ошибка: {{ $message }}</b>
        @enderror
        <input class="form-control btn btn-primary my-2" type="submit">
    </form>
    <hr>
    <form action="{{ route('cabinet_settings_edit_password') }}" method="POST">
        @csrf
        @method ('PUT')
        <label class="form-label ms-2 my-2">Вы можете изменить свой пароль, минимум 8 символов и максимум 20</label>
        <input class="form-control my-2" type="text" name="new_password" placeholder = "Введите новый пароль">
        @error('new_password')
            <b class="link-danger ms-2">Ошибка: {{ $message }}</b>
        @enderror
        <input class="form-control btn btn-primary my-2" type="submit">
    </form>


    <p>Запретить боту выдачу одноразовых ссылок для входа</p>
    <P>Запретить боту возможность cмены пароля на сайте</P>

</div>
@endsection
