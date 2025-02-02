@extends('layouts/main')



@section('posts')
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('cabinet_index') }}">Статистика</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('cabinet_edit_post') }}">Редактируем пост</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Все посты</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Сайт</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Новый пост</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Настройки</a>
        </li>
    </ul>
@endsection
