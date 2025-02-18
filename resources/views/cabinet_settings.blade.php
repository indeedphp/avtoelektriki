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
                    <a class="nav-link" href="{{ route('site_index', Auth::user()->id) }}">Сайт</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cabinet_statistic') }}">Статистика</a>
                </li>
            </ul>
        </div>

    </nav>
   
    <div class="m-2" >
        <b>Ваше имя пользователя: {{$user->user_name}}</b> 
     </div>

     <form action="{{route('cabinet_settings_edit')}}" method="POST">
        @csrf
        @method ('PUT')
        <label  class="form-label m-2">Вы можете изменить свое имя пользователя тут</label>
        <input class="form-control m-2" type="text" name="new_name" placeholder = "введите новое имя ">
        <input class="form-control btn btn-primary m-2" type="submit">
      </form>
<p>Запретить боту выдачу одноразовых ссылок для входа</p>
<P>Запретить боту возможность чмены пароля на сайте</P>
    @endsection

    