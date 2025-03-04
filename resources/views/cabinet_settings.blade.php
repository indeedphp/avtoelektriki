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


        <form action="{{ route('cabinet_settings_edit_color_channel') }}" method="POST">
            @csrf
            @method ('PUT')
            <label class="form-label ">Вы можете изменить цвет полосы канала</label>
        <div>
            <span class="px-lg-4" style="width: 20px; height: 40px; display: inline-block; background-color: #776300;">
                <input type="radio" name="color_channel" value="776300"
                    @if ($user_data->color_channel == '776300') checked @endif></span>  {{-- отмечаем точкой если выбран цвет --}}
                    
            <span class="px-lg-4" style="width: 20px; height: 40px; display: inline-block; background-color: #3B0056;">
                <input type="radio" name="color_channel" value="3B0056"
                    @if ($user_data->color_channel == '3B0056') checked @endif></span>

            <span class="px-lg-4" style="width: 20px; height: 40px; display: inline-block; background-color: #002655;">
                <input type="radio" name="color_channel" value="002655"
                    @if ($user_data->color_channel == '002655') checked @endif></span>

            <span class="px-lg-4"  style="width: 20px; height: 40px; display: inline-block; background-color: #001699;">
                <input type="radio" name="color_channel" value="001699"
                    @if ($user_data->color_channel == '001699') checked @endif></span>

            <span class="px-lg-4"  style="width: 20px; height: 40px; display: inline-block; background-color: #425EFF;">
                <input type="radio" name="color_channel" value="425EFF"
                    @if ($user_data->color_channel == '425EFF') checked @endif></span>

            <span class="px-lg-4"  style="width: 20px; height: 40px; display: inline-block; background-color: #003F06;">
                <input type="radio" name="color_channel" value="003F06"
                    @if ($user_data->color_channel == '003F06') checked @endif></span>

            <span class="px-lg-4"  style="width: 20px; height: 40px; display: inline-block; background-color: #00770D;">
                <input type="radio" name="color_channel" value="00770D"
                    @if ($user_data->color_channel == '00770D') checked @endif></span>

            <span class="px-lg-4"  style="width: 20px; height: 40px; display: inline-block; background-color: #00BC12;">
                <input type="radio" name="color_channel" value="00BC12"
                    @if ($user_data->color_channel == '00BC12') checked @endif></span>

            <span class="px-lg-4"  style="width: 20px; height: 40px; display: inline-block; background-color: #FF4949;">
                <input type="radio" name="color_channel" value="FF4949"
                    @if ($user_data->color_channel == 'FF4949') checked @endif></span>

            <span class="px-lg-4"  style="width: 20px; height: 40px; display: inline-block; background-color: #820000;">
                <input type="radio" name="color_channel" value="820000"
                    @if ($user_data->color_channel == '820000') checked @endif></span>

            <span class="px-lg-4"  style="width: 20px; height: 40px; display: inline-block; background-color: #560000;">
                <input type="radio" name="color_channel" value="560000"
                    @if ($user_data->color_channel == '560000') checked @endif></span>

            <span class="px-lg-4"  style="width: 20px; height: 40px; display: inline-block; background-color: #9E9E9E;">
                <input type="radio" name="color_channel" value="9E9E9E"
                    @if ($user_data->color_channel == '9E9E9E') checked @endif></span>

            <span class="px-lg-4"  style="width: 20px; height: 40px; display: inline-block; background-color: #444444;">
                <input type="radio" name="color_channel" value="444444"
                    @if ($user_data->color_channel == '444444') checked @endif></span>

            <span class="px-lg-4"  style="width: 20px; height: 40px; display: inline-block; background-color: #000000;">
                <input type="radio" name="color_channel" value="000000"
                    @if ($user_data->color_channel == '000000') checked @endif></span>

            <p class="link-danger">Выберите цвет верхней полосы канала</p>
        </div>
 
    <input class="form-control btn btn-primary my-1" type="submit">
</form>

<hr>
<form action="{{ route('cabinet_settings_edit_definition_channel') }}" method="POST">
    @csrf
    @method ('PUT')
    <label class="form-label ">Вы можете поменять описание канала, максимальная длина 100 символов</label>
    <input class="form-control my-1" type="text" name="definition_channel" placeholder = "Введите описание">
    @error('definition_channel')
        <b class="link-danger ">Ошибка: {{ $message }}</b>
    @enderror
    <input class="form-control btn btn-primary my-1" type="submit">
</form>

<hr>
<form action="{{ route('cabinet_settings_edit_name_channel') }}" method="POST">
    @csrf
    @method ('PUT')
    <label class="form-label ">Вы можете поменять название канала, максимальная длина 40 символов</label>
    <input class="form-control my-1" type="text" name="name_channel" placeholder = "Введите описание" value="{{old('name_channel')}}">
    @error('name_channel')
        <b class="link-danger ">Ошибка: {{ $message }}</b>
    @enderror
    <input class="form-control btn btn-primary my-1" type="submit">
</form>


    </div>
@endsection
