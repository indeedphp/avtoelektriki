@extends('layouts/main')



@section('posts')
    <nav class="navbar navbar-expand-lg  p-0 pe-2">

        <a class="navbar-brand ms-1">Кабинет пользователя:</a>
        <button class="navbar-toggler me-1" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
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
                    <a class="nav-link link-danger" href="{{ route('site_index') }}">Сайт</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cabinet_statistic') }}">Статистика</a>
                </li>
            </ul>
        </div>

    </nav>
    <hr>
    <div class="row px-1">


    <p> Ваш сайт уже создан, только укажите свой номер телефона, посмотреть как выглядит сайт можно <a class=""
            href="{{ route('site_show', Auth::user()->id) }}" target="_blank">нажав тут</a>
    </p>
    <hr>
    <h2>настройки сайта</h2>
    <hr>
    <form method="POST" action="{{ route('site_create') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="site_id" value="{{ $site->id }}">
        
        <div>
            <span class="px-lg-4" style="width: 20px; height: 40px; display: inline-block; background-color: #776300;">
                <input type="radio" name="color_head" value="776300"
                    @if ($site->color_head == '776300') checked @endif></span>  {{-- отмечаем точкой если выбран цвет --}}
                    
            <span class="px-lg-4" style="width: 20px; height: 40px; display: inline-block; background-color: #3B0056;">
                <input type="radio" name="color_head" value="3B0056"
                    @if ($site->color_head == '3B0056') checked @endif></span>

            <span class="px-lg-4" style="width: 20px; height: 40px; display: inline-block; background-color: #002655;">
                <input type="radio" name="color_head" value="002655"
                    @if ($site->color_head == '002655') checked @endif></span>

            <span class="px-lg-4"  style="width: 20px; height: 40px; display: inline-block; background-color: #001699;">
                <input type="radio" name="color_head" value="001699"
                    @if ($site->color_head == '001699') checked @endif></span>

            <span class="px-lg-4"  style="width: 20px; height: 40px; display: inline-block; background-color: #425EFF;">
                <input type="radio" name="color_head" value="425EFF"
                    @if ($site->color_head == '425EFF') checked @endif></span>

            <span class="px-lg-4"  style="width: 20px; height: 40px; display: inline-block; background-color: #003F06;">
                <input type="radio" name="color_head" value="003F06"
                    @if ($site->color_head == '003F06') checked @endif></span>

            <span class="px-lg-4"  style="width: 20px; height: 40px; display: inline-block; background-color: #00770D;">
                <input type="radio" name="color_head" value="00770D"
                    @if ($site->color_head == '00770D') checked @endif></span>

            <span class="px-lg-4"  style="width: 20px; height: 40px; display: inline-block; background-color: #00BC12;">
                <input type="radio" name="color_head" value="00BC12"
                    @if ($site->color_head == '00BC12') checked @endif></span>

            <span class="px-lg-4"  style="width: 20px; height: 40px; display: inline-block; background-color: #FF4949;">
                <input type="radio" name="color_head" value="FF4949"
                    @if ($site->color_head == 'FF4949') checked @endif></span>

            <span class="px-lg-4"  style="width: 20px; height: 40px; display: inline-block; background-color: #820000;">
                <input type="radio" name="color_head" value="820000"
                    @if ($site->color_head == '820000') checked @endif></span>

            <span class="px-lg-4"  style="width: 20px; height: 40px; display: inline-block; background-color: #560000;">
                <input type="radio" name="color_head" value="560000"
                    @if ($site->color_head == '560000') checked @endif></span>

            <span class="px-lg-4"  style="width: 20px; height: 40px; display: inline-block; background-color: #9E9E9E;">
                <input type="radio" name="color_head" value="9E9E9E"
                    @if ($site->color_head == '9E9E9E') checked @endif></span>

            <span class="px-lg-4"  style="width: 20px; height: 40px; display: inline-block; background-color: #444444;">
                <input type="radio" name="color_head" value="444444"
                    @if ($site->color_head == '444444') checked @endif></span>

            <span class="px-lg-4"  style="width: 20px; height: 40px; display: inline-block; background-color: #000000;">
                <input type="radio" name="color_head" value="000000"
                    @if ($site->color_head == '000000') checked @endif></span>

            <p class="link-danger">Выберите цвет верхней полосы сайта</p>
        </div>
        <h2>текст в самом верху страницы</h2>


        <textarea class="form-control" name="heading">{{$site->heading}}</textarea>
            @error('heading')
            <b class="link-danger ms-2">Ошибка: {{ $message }}</b>
            @enderror
  <p class="link-danger">Напишите чем занимаетесь и где, в два-три слова например"Автоэлектрики Алматы", максимум 25 символов</p>
        <p></p>

        {{-- <div class="card card-body p-1 " id="heading" contenteditable="true">{{ $site->heading }}</div> --}}
      
        <input type="tel" class="form-control" name="phone_1" value="{{$site->phone_1}}" >
        {{-- <textarea class="form-control" name="phone_1">{{$site->phone_1}}</textarea> --}}
        @error('phone_1')
        <b class="link-danger ms-2">Ошибка: {{ $message }}</b>
        @enderror
        {{-- <div class="card card-body p-1 " id="phone_1" contenteditable="true">{{ $site->phone_1 }} --}}
        {{-- </div> --}}
        <p class="link-danger">Напишите один номер телефона для контактов, без пробелов, точек и тире, пример +70000000000</p>
        <p></p>
        <hr>
    
        <div>
            
            <span class="px-lg-4" style="width: 20px; height: 40px; display: inline-block; background-color: #FFF9DD;">
                <input type="radio" name="color_body" value="FFF9DD"
                    @if ($site->color_body == 'FFF9DD') checked @endif></span>

            <span class="px-lg-4" style="width: 20px; height: 40px; display: inline-block; background-color: #F4DDFF;">
                <input type="radio" name="color_body" value="F4DDFF"
                    @if ($site->color_body == 'F4DDFF') checked @endif></span>

            <span class="px-lg-4" style="width: 20px; height: 40px; display: inline-block; background-color: #96A9FF;">
                <input type="radio" name="color_body" value="96A9FF"
                    @if ($site->color_body == '96A9FF') checked @endif></span>

            <span class="px-lg-4" style="width: 20px; height: 40px; display: inline-block; background-color: #BAC4FF;">
                <input type="radio" name="color_body" value="BAC4FF"
                    @if ($site->color_body == 'BAC4FF') checked @endif></span>

            <span class="px-lg-4" style="width: 20px; height: 40px; display: inline-block; background-color: #DDE2FF;">
                <input type="radio" name="color_body" value="DDE2FF"
                    @if ($site->color_body == 'DDE2FF') checked @endif></span>

            <span class="px-lg-4" style="width: 20px; height: 40px; display: inline-block; background-color: #8CFF99;">
                <input type="radio" name="color_body" value="8CFF99"
                    @if ($site->color_body == '8CFF99') checked @endif></span>

            <span class="px-lg-4" style="width: 20px; height: 40px; display: inline-block; background-color: #C1FFC8;">
                <input type="radio" name="color_body" value="C1FFC8"
                    @if ($site->color_body == 'C1FFC8') checked @endif></span>

            <span class="px-lg-4" style="width: 20px; height: 40px; display: inline-block; background-color: #DDFFE1;">
                <input type="radio" name="color_body" value="DDFFE1"
                    @if ($site->color_body == 'DDFFE1') checked @endif></span>

            <span class="px-lg-4" style="width: 20px; height: 40px; display: inline-block; background-color: #FFA8A8;">
                <input type="radio" name="color_body" value="FFA8A8"
                    @if ($site->color_body == 'FFA8A8') checked @endif></span>

            <span class="px-lg-4" style="width: 20px; height: 40px; display: inline-block; background-color: #FFC9C9;">
                <input type="radio" name="color_body" value="FFC9C9"
                    @if ($site->color_body == 'FFC9C9') checked @endif></span>

            <span class="px-lg-4" style="width: 20px; height: 40px; display: inline-block; background-color: #FFDDDD;">
                <input type="radio" name="color_body" value="FFDDDD"
                    @if ($site->color_body == 'FFDDDD') checked @endif></span>

            <span class="px-lg-4" style="width: 20px; height: 40px; display: inline-block; background-color: #FFFFFF;">
                <input type="radio" name="color_body" value="FFFFFF"
                    @if ($site->color_body == 'FFFFFF') checked @endif></span>

            <span class="px-lg-4" style="width: 20px; height: 40px; display: inline-block; background-color: #D8D8D8;">
                <input type="radio" name="color_body" value="D8D8D8"
                    @if ($site->color_body == 'D8D8D8') checked @endif></span>

            <span class="px-lg-4" style="width: 20px; height: 40px; display: inline-block; background-color: #C4C4C4;">
                <input type="radio" name="color_body" value="C4C4C4"
                    @if ($site->color_body == 'C4C4C4') checked @endif></span>

            <p class="link-danger">Выберите цвет заднего фона сайта</p>
        </div>
        <h2>текст сверху карточек</h2>
        <textarea class="form-control" name="top_text">{{$site->top_text}}</textarea>
        @error('top_text')
        <b class="link-danger ms-2">Ошибка: {{ $message }}</b>
        @enderror
        {{-- <div id="top_text" class="card card-body p-1 " contenteditable="true">{{ $site->top_text }} </div> --}}
        <p class="link-danger">Напишите коротко главные направления деятельности например "Срочный выезд для запуска
            автомобиля, диагностика на выезде, заправка и ремонт кондиционера"</p>
        <p></p>
        <hr>
        <div>
            <span class="px-lg-4" style="width: 20px; height: 40px; display: inline-block; background-color: #776300;">
                <input type="radio" name="color_card" value="776300"
                    @if ($site->color_card == '776300') checked @endif></span>

            <span class="px-lg-4" style="width: 20px; height: 40px; display: inline-block; background-color: #3B0056;">
                <input type="radio" name="color_card" value="3B0056"
                    @if ($site->color_card == '3B0056') checked @endif></span>

            <span class="px-lg-4" style="width: 20px; height: 40px; display: inline-block; background-color: #002655;">
                <input type="radio" name="color_card" value="002655"
                    @if ($site->color_card == '002655') checked @endif></span>

            <span class="px-lg-4" style="width: 20px; height: 40px; display: inline-block; background-color: #001699;">
                <input type="radio" name="color_card" value="001699"
                    @if ($site->color_card == '001699') checked @endif></span>

            <span class="px-lg-4" style="width: 20px; height: 40px; display: inline-block; background-color: #425EFF;">
                <input type="radio" name="color_card" value="425EFF"
                    @if ($site->color_card == '425EFF') checked @endif></span>

            <span class="px-lg-4" style="width: 20px; height: 40px; display: inline-block; background-color: #003F06;">
                <input type="radio" name="color_card" value="003F06"
                    @if ($site->color_card == '003F06') checked @endif></span>

            <span class="px-lg-4" style="width: 20px; height: 40px; display: inline-block; background-color: #00770D;">
                <input type="radio" name="color_card" value="00770D"
                    @if ($site->color_card == '00770D') checked @endif></span>

            <span class="px-lg-4" style="width: 20px; height: 40px; display: inline-block; background-color: #00BC12;">
                <input type="radio" name="color_card" value="00BC12"
                    @if ($site->color_card == '00BC12') checked @endif></span>

            <span class="px-lg-4" style="width: 20px; height: 40px; display: inline-block; background-color: #FF4949;">
                <input type="radio" name="color_card" value="FF4949"
                    @if ($site->color_card == 'FF4949') checked @endif></span>

            <span class="px-lg-4" style="width: 20px; height: 40px; display: inline-block; background-color: #820000;">
                <input type="radio" name="color_card" value="820000"
                    @if ($site->color_card == '820000') checked @endif></span>

            <span class="px-lg-4" style="width: 20px; height: 40px; display: inline-block; background-color: #560000;">
                <input type="radio" name="color_card" value="560000"
                    @if ($site->color_card == '560000') checked @endif></span>

            <span class="px-lg-4" style="width: 20px; height: 40px; display: inline-block; background-color: #9E9E9E;">
                <input type="radio" name="color_card" value="9E9E9E"
                    @if ($site->color_card == '9E9E9E') checked @endif></span>

            <span class="px-lg-4" style="width: 20px; height: 40px; display: inline-block; background-color: #444444;">
                <input type="radio" name="color_card" value="444444"
                    @if ($site->color_card == '444444') checked @endif></span>

            <span class="px-lg-4" style="width: 20px; height: 40px; display: inline-block; background-color: #000000;">
                <input type="radio" name="color_card" value="000000"
                    @if ($site->color_card == '000000') checked @endif></span>

            <p class="link-danger">Выберите цвет верхней полосы карточек</p>
        </div>
        <h2>1 карточка</h2>
        <textarea class="form-control" name="text_1_a">{{$site->text_1_a}}</textarea>
        @error('text_1_a')
        <b class="link-danger ms-2">Ошибка: {{ $message }}</b>
        @enderror
        {{-- <div id="text_1_a" class="card card-body p-1" contenteditable="true"> {{ $site->text_1_a }}</div> --}}
        <p class="link-danger">Напишите заголовок карточки вида работ</p>
        <p></p>
        <div>
            <span class="px-lg-4" style="width: 20px; height: 40px; display: inline-block; background-color: #FFF9DD;">
                <input type="radio" name="color_back" value="FFF9DD"
                    @if ($site->color_back == 'FFF9DD') checked @endif></span>

            <span class="px-lg-4" style="width: 20px; height: 40px; display: inline-block; background-color: #F4DDFF;">
                <input type="radio" name="color_back" value="F4DDFF"
                    @if ($site->color_back == 'F4DDFF') checked @endif></span>

            <span class="px-lg-4" style="width: 20px; height: 40px; display: inline-block; background-color: #96A9FF;">
                <input type="radio" name="color_back" value="96A9FF"
                    @if ($site->color_back == '96A9FF') checked @endif></span>

            <span class="px-lg-4" style="width: 20px; height: 40px; display: inline-block; background-color: #BAC4FF;">
                <input type="radio" name="color_back" value="BAC4FF"
                    @if ($site->color_back == 'BAC4FF') checked @endif></span>

            <span class="px-lg-4" style="width: 20px; height: 40px; display: inline-block; background-color: #DDE2FF;">
                <input type="radio" name="color_back" value="DDE2FF"
                    @if ($site->color_back == 'DDE2FF') checked @endif></span>

            <span class="px-lg-4" style="width: 20px; height: 40px; display: inline-block; background-color: #8CFF99;">
                <input type="radio" name="color_back" value="8CFF99"
                    @if ($site->color_back == '8CFF99') checked @endif></span>

            <span class="px-lg-4" style="width: 20px; height: 40px; display: inline-block; background-color: #C1FFC8;">
                <input type="radio" name="color_back" value="C1FFC8"
                    @if ($site->color_back == 'C1FFC8') checked @endif></span>

            <span class="px-lg-4" style="width: 20px; height: 40px; display: inline-block; background-color: #DDFFE1;">
                <input type="radio" name="color_back" value="DDFFE1"
                    @if ($site->color_back == 'DDFFE1') checked @endif></span>

            <span class="px-lg-4" style="width: 20px; height: 40px; display: inline-block; background-color: #FFA8A8;">
                <input type="radio" name="color_back" value="FFA8A8"
                    @if ($site->color_back == 'FFA8A8') checked @endif></span>

            <span class="px-lg-4" style="width: 20px; height: 40px; display: inline-block; background-color: #FFC9C9;">
                <input type="radio" name="color_back" value="FFC9C9"
                    @if ($site->color_back == 'FFC9C9') checked @endif></span>

            <span class="px-lg-4" style="width: 20px; height: 40px; display: inline-block; background-color: #FFDDDD;">
                <input type="radio" name="color_back" value="FFDDDD"
                    @if ($site->color_back == 'FFDDDD') checked @endif></span>

            <span class="px-lg-4" style="width: 20px; height: 40px; display: inline-block; background-color: #FFFFFF;">
                <input type="radio" name="color_back" value="FFFFFF"
                    @if ($site->color_back == 'FFFFFF') checked @endif></span>

            <span class="px-lg-4" style="width: 20px; height: 40px; display: inline-block; background-color: #D8D8D8;">
                <input type="radio" name="color_back" value="D8D8D8"
                    @if ($site->color_back == 'D8D8D8') checked @endif></span>

            <span class="px-lg-4" style="width: 20px; height: 40px; display: inline-block; background-color: #C4C4C4;">
                <input type="radio" name="color_back" value="C4C4C4"
                    @if ($site->color_back == 'C4C4C4') checked @endif></span>

            <p class="link-danger">Выберите цвет заднего фона карточек</p>
        </div>


        <img id="preview" class=" img-fluid shadow p-lg-5" src="{{ url($site->foto_1) }}" alt="Фото потерялось">
        <br> <br>
        <input class="form-control" type="file" id="fileInput" name="foto_1" value="plug.jpg">
        <p class="link-danger">Выберите свое фото</p>
        <p id="error_foto_size_1" class="link-danger"></p>
       
        <br>
        <textarea class="form-control" name="text_1_b" style="height: 150px">{{$site->text_1_b}}</textarea>
        @error('text_1_b')
        <b class="link-danger ms-2">Ошибка: {{ $message }}</b>
        @enderror
        {{-- <div class="card card-body p-1 " id="text_1_b" contenteditable="true" data-placeholder=" Напишите комментарий"> --}}
            {{-- {{ $site->text_1_b }}</div> --}}
        <p class="link-danger">Напишите текст под фото, минимум 10 и максимум 1000 символов</p>
        <p></p>
        <hr>
        <br><br>
        <h2>2 карточка</h2>
        {{-- ========================================================================== --}}
        <textarea class="form-control" name="text_2_a">{{$site->text_2_a}}</textarea>
        @error('text_2_a')
        <b class="link-danger ms-2">Ошибка: {{ $message }}</b>
        @enderror
        {{-- <div id="text_2_a" class="card card-body p-1" contenteditable="true"> {{ $site->text_2_a }}</div> --}}
        <p class="link-danger">Напишите заголовок карточки вида работ</p>
        <p></p>
        <img id="preview2" class=" img-fluid shadow p-lg-5" src="{{ url($site->foto_2) }}" alt="Фото потерялось">
        <br> <br>

        <input class="form-control" type="file" id="fileInput2" name="foto_2">
        <p class="link-danger">Выберите свое фото</p>
        <p id="error_foto_size_2" class="link-danger"></p>
        
        <br>
        <textarea class="form-control" name="text_2_b" style="height: 150px">{{$site->text_2_b}}</textarea>
        @error('text_2_b')
        <b class="link-danger ms-2">Ошибка: {{ $message }}</b>
        @enderror
        {{-- <div class="card card-body p-1 " id="text_2_b" contenteditable="true" data-placeholder=" Напишите комментарий">
            {{ $site->text_2_b }}</div> --}}
        <p class="link-danger">Напишите текст под фото</p>
        <p></p>
        <hr>
        <br><br>
        <h2>3 карточка</h2>
        {{-- ========================================================================== --}}
        <textarea class="form-control" name="text_3_a">{{$site->text_3_a}}</textarea>
        @error('text_3_a')
        <b class="link-danger ms-2">Ошибка: {{ $message }}</b>
        @enderror
        {{-- <div id="text_3_a" class="card card-body p-1" contenteditable="true"> {{ $site->text_3_a }}</div> --}}
        <p class="link-danger">Напишите заголовок карточки вида работ</p>
        <p></p>
        <img id="preview3" class=" img-fluid shadow p-lg-5" src="{{ url($site->foto_3) }}" alt="Фото потерялось">
        <br> <br>

        <input class="form-control" type="file" id="fileInput3" name="foto_3">
        <p class="link-danger">Выберите свое фото</p>
        <p id="error_foto_size_3" class="link-danger"></p>
        <br>
        <textarea class="form-control" name="text_3_b" style="height: 150px">{{$site->text_3_b}}</textarea>
        @error('text_3_b')
        <b class="link-danger ms-2">Ошибка: {{ $message }}</b>
        @enderror
        {{-- <div class="card card-body p-1 " id="text_3_b" contenteditable="true" data-placeholder=" Напишите комментарий">
            {{ $site->text_3_b }}</div> --}}
        <p class="link-danger">Напишите текст под фото</p>
        <p></p>
        <hr>
        <br><br>
        <h2>4 карточка</h2>
        {{-- ========================================================================== --}}
        <textarea class="form-control" name="text_4_a">{{$site->text_4_a}}</textarea>
        @error('text_4_a')
        <b class="link-danger ms-2">Ошибка: {{ $message }}</b>
        @enderror
        {{-- <div id="text_4_a" class="card card-body p-1" contenteditable="true"> {{ $site->text_4_a }}</div> --}}
        <p class="link-danger">Напишите заголовок карточки вида работ</p>
        <p></p>
        <img id="preview4" class=" img-fluid shadow p-lg-5" src="{{ url($site->foto_4) }}" alt="Фото потерялось">
        <br> <br>

        <input class="form-control" type="file" id="fileInput4" name="foto_4">
        <p class="link-danger">Выберите свое фото</p>
        <p id="error_foto_size_4" class="link-danger"></p>
       
        <br>
        <textarea class="form-control" name="text_4_b" style="height: 150px">{{$site->text_4_b}}</textarea>
        @error('text_4_b')
        <b class="link-danger ms-2">Ошибка: {{ $message }}</b>
        @enderror
        {{-- <div class="card card-body p-1 " id="text_4_b" contenteditable="true" data-placeholder=" Напишите комментарий">
            {{ $site->text_4_b }}</div> --}}
        <p class="link-danger">Напишите текст под фото</p>
        <p></p>
        <hr>
        <br><br>
        <h2>5 карточка</h2>
        {{-- ========================================================================== --}}
        <textarea class="form-control" name="text_5_a">{{$site->text_5_a}}</textarea>
        @error('text_5_a')
        <b class="link-danger ms-2">Ошибка: {{ $message }}</b>
        @enderror
        {{-- <div id="text_5_a" class="card card-body p-1" contenteditable="true"> {{ $site->text_5_a }}</div> --}}
        <p class="link-danger">Напишите заголовок карточки вида работ</p>
        <p></p>
        <img id="preview5" class=" img-fluid shadow p-lg-5" src="{{ url($site->foto_5) }}" alt="Фото потерялось">
        <br> <br>

        <input class="form-control" type="file" id="fileInput5" name="foto_5">
        <p class="link-danger">Выберите свое фото</p>
        <p id="error_foto_size_5" class="link-danger"></p>
        

        <textarea class="form-control" name="text_5_b" style="height: 150px">{{$site->text_5_b}}</textarea>
        @error('text_5_b')
        <b class="link-danger ms-2">Ошибка: {{ $message }}</b>
        @enderror
        {{-- <div class="card card-body p-1 " id="text_5_b" contenteditable="true" data-placeholder=" Напишите комментарий">
            {{ $site->text_5_b }}</div> --}}
        <p class="link-danger">Напишите текст под фото</p>
        <p></p>
        <hr>

        <h2>нижний текст</h2>

        <textarea class="form-control" name="bottom_text">{{$site->bottom_text}}</textarea>
        @error('bottom_text')
        <b class="link-danger ms-2">Ошибка: {{ $message }}</b>
        @enderror

        {{-- <div id="bottom_text" class="card card-body p-1 " contenteditable="true">{{ $site->bottom_text }} </div> --}}
        <p class="link-danger">Подведите итоги, напишите доп контакты и пр.</p>
        <p></p>
        <hr>

        <h2>мета тег сайта</h2>

        <textarea class="form-control" name="meta_1">{{$site->meta_1}}</textarea>
        @error('meta_1')
        <b class="link-danger ms-2">Ошибка: {{ $message }}</b>
        @enderror

        {{-- <div id="meta_1" class="card card-body p-1 " contenteditable="true">{{ $site->meta_1 }} </div> --}}
        <p class="link-danger">Метатег сайта, не отображается на странице, но виден например в ссылке телеграмм</p>
        <p></p>
        <hr>
        <p id="message" hidden class="link-danger p-2">ВАШИ ИЗМЕНЕНИЯ СОХРАНЕНЫ!</p>
        <p id="message2" hidden class="link-danger p-2">ИЗМЕНЕНИЯ НЕ ПРОШЛИ </p>
        <button class="btn btn-primary " title="Отправить" type="submit">Сохранить сайт</button>
      
    </form>
    <hr>
    <p> Посмотреть как выглядит сайт можно <a class="" href="{{ route('site_show', Auth::user()->id) }}"
            target="_blank">нажав тут</a>
    </p>
    <hr>
    <form action="{{ route('reset_site') }}" method="POST">
        @csrf
        @method ('PUT')
        <input type="hidden" name="site_id" value="{{ $site->id }}">
        <button class="btn btn-primary " title="Отправить" type="submit">Сброс сайта на начальные настройки</button>
        <hr>
    </form>
    <div>
    <footer class=" " ;>
        <div class="p-2">
            <span class=" ">© 2024 Company, Inc</span>
        </div>
    </footer>

    <script>
        //=======предпросмотр фото 1=========================================================================
        const maxSize = 1048576; // Максимальный размер файла: 1MB
        const fileInput = document.getElementById('fileInput');
        const preview = document.getElementById('preview');

        fileInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const error_foto_size_1 = document.getElementById('error_foto_size_1');
                if (file.size > maxSize) error_foto_size_1.textContent = 'Фото не подходит, размер фото не более — 1MB.';
                else {
                    error_foto_size_1.textContent = '';
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                    };
                    reader.readAsDataURL(file); // Читаем файл как DataURL
                }
            }
        });
        //----------предпросмотр фото 2------------------------------------------------------------------------
        const fileInput2 = document.getElementById('fileInput2');
        const preview2 = document.getElementById('preview2');

        fileInput2.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const error_foto_size_2 = document.getElementById('error_foto_size_2');
                if (file.size > maxSize) error_foto_size_2.textContent = 'Максимальный размер фото — 1MB.';
                else {
                    error_foto_size_2.textContent = '';
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview2.src = e.target.result;
                    };
                    reader.readAsDataURL(file); // Читаем файл как DataURL
                }
            }
        });
        //----------предпросмотр фото 3--------------------------------------------------------------------
        const fileInput3 = document.getElementById('fileInput3');
        const preview3 = document.getElementById('preview3');

        fileInput3.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const error_foto_size_3 = document.getElementById('error_foto_size_3');
                if (file.size > maxSize) error_foto_size_3.textContent = 'Максимальный размер фото — 1MB.';
                else {
                    error_foto_size_3.textContent = '';
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview3.src = e.target.result;
                    };
                    reader.readAsDataURL(file); // Читаем файл как DataURL
                }
            }
        });
        //----------предпросмотр фото 4--------------------------------------------------------------------
        const fileInput4 = document.getElementById('fileInput4');
        const preview4 = document.getElementById('preview4');

        fileInput4.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const error_foto_size_4 = document.getElementById('error_foto_size_4');
                if (file.size > maxSize) error_foto_size_4.textContent = 'Максимальный размер фото — 1MB.';
                else {
                    error_foto_size_4.textContent = '';
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview4.src = e.target.result;
                    };
                    reader.readAsDataURL(file); // Читаем файл как DataURL
                }
            }
        });
        //----------предпросмотр фото 5--------------------------------------------------------------------
        const fileInput5 = document.getElementById('fileInput5');
        const preview5 = document.getElementById('preview5');

        fileInput5.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const error_foto_size_5 = document.getElementById('error_foto_size_5');
                if (file.size > maxSize) error_foto_size_5.textContent = 'Максимальный размер фото — 1MB.';
                else {
                    error_foto_size_5.textContent = '';
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview5.src = e.target.result;
                    };
                    reader.readAsDataURL(file); // Читаем файл как DataURL
                }
            }
        });
    </script>
@endsection
