@extends('layouts/main')



@section('posts')
<x-nav-cabinet/> {{-- вставляем навигацию --}}
    <div class="row px-1">
        
        <hr>
       
    <div class="my-2"> <label class="form-label">Выход с сайта</label> <a class="btn btn-primary" href="{{ route('logout') }}">Выход</a>  </div>


        <hr>
        <div class="my-1"> <b >Ваше имя пользователя: {{ $user->name }}</b> </div>
        <form action="{{ route('cabinet_settings_edit_name') }}" method="POST">
            @csrf
            @method ('PUT')
            <label class="form-label ">Вы можете изменить свое имя пользователя тут, минимум 4 символа и максимум
                20</label>
            <input class="form-control my-1" type="text" name="new_name" placeholder = "Введите новое имя">
            @error('new_name')
                <b class="link-danger ">Ошибка: {{ $message }}</b>
            @enderror
             <input class="form-control btn btn-primary my-1" type="submit">
        </form>

        <hr>


        <form action="{{ route('cabinet_settings_edit_login') }}" method="POST">
            @csrf
            @method ('PUT')
            <label class="form-label ">Вы можете изменить свой логин, минимум 8 символов и максимум 20</label>
            <input class="form-control my-1 " type="text" name="new_login" placeholder = "Введите новый логин">
            @error('new_login')
                <b class="link-danger ">Ошибка: {{ $message }}</b>
            @enderror
            <input class="form-control btn btn-primary my-1" type="submit">
        </form>
        <hr>
        <form action="{{ route('cabinet_settings_edit_password') }}" method="POST">
            @csrf
            @method ('PUT')
            <label class="form-label ">Вы можете изменить свой пароль, минимум 8 символов и максимум 20</label>
            <input class="form-control my-1" type="text" name="new_password" placeholder = "Введите новый пароль">
            @error('new_password')
                <b class="link-danger ">Ошибка: {{ $message }}</b>
            @enderror
            <input class="form-control btn btn-primary my-1" type="submit">
        </form>
        <hr>

        {{-- <p>Запретить боту выдачу одноразовых ссылок для входа</p>
        <P>Запретить боту возможность cмены пароля на сайте</P> --}}

    </div>
@endsection
