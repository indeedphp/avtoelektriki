@extends('layouts/main')



@section('posts')
    <nav class="navbar navbar-expand-lg  p-0 pe-2">

        <a class="navbar-brand">Кабинет пользователя:</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ps-2">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cabinet_settings') }}">Настройки</a>
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
                    <a class="nav-link" href="{{ route('site_index', Auth::user()->id) }}">Сайт</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-danger" href="{{ route('cabinet_statistic') }}">Статистика</a>
                </li>
            </ul>
        </div>

    </nav>

<div class="p-3" >
   <b>Всего размещенно постов на портале: </b> {{$post_count}}
</div>

<div class="p-3" >
    <b>Всего комментариев на портале: </b> {{$comments_count}}
 </div>







@endsection
