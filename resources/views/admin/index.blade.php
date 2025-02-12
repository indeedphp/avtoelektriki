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
                <a class="nav-link" href="{{ route('admin_all_users')}}">Все пользователи</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="">Все посты</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="">Все комментарии</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="">Все ответы на комментарии</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="">Все сайты</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="">Настройки</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="">Статистика</a>
            </li>
        </ul>
    </div>
</nav>


{{-- {{ route('cabinet_statistic') }} --}}







@endsection