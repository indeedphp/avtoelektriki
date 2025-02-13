
@extends('layouts/admin')



@section('posts')

<nav class="navbar navbar-expand-lg  p-0 pe-2">

    <a class="navbar-brand ps-2 m-0">Админка:</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ps-1">
            <li class="nav-item">
                <a class="nav-link link-danger" href="{{ route('admin_index')}}">Начальная</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin_users')}}">Все пользователи</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin_posts')}}">Все посты</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin_comments')}}">Все комментарии</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin_replys')}}">Все ответы на комментарии</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin_sites')}}">Все сайты</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin_settings')}}">Настройки</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin_statistics')}}">Статистика</a>
            </li>
        </ul>
    </div>
</nav>


{{-- {{ route('cabinet_statistic') }} --}}





<p>Вы в админке портала "автоэлектрики" на странице настроек</p>

@endsection