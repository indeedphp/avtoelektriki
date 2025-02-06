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
                    <a class="nav-link" href="{{ route('cabinet_index') }}">Настройки</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cabinet_new_post') }}">Новый пост</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Все посты</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cabinet_edit_post') }}">Редактируем пост</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-danger" href="{{ route('site_index') }}">Сайт</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Статистика</a>
                </li>
            </ul>
        </div>

    </nav>
    <hr>




    <p> Ваш сайт уже создан, только укажите свой номер телефона, посмотреть как выглядит сайт можно <a class=""
            href="{{ route('site_show') }}" target="_blank">нажав тут</a>
    </p>
    <hr>
    <form method="POST">
        @csrf

        <div>
            <span class="color-box" style="width: 30px; height: 30px; display: inline-block; background-color: #776300;">
                <input type="radio" name="color_head" value="776300"
                    @if ($site->color_head == '776300') checked @endif></span>

            <span class="color-box" style="width: 30px; height: 30px; display: inline-block; background-color: #3B0056;">
                <input type="radio" name="color_head" value="3B0056"
                    @if ($site->color_head == '3B0056') checked @endif></span>

            <span class="color-box" style="width: 30px; height: 30px; display: inline-block; background-color: #002655;">
                <input type="radio" name="color_head" value="002655"
                    @if ($site->color_head == '002655') checked @endif></span>

            <span class="color-box" style="width: 30px; height: 30px; display: inline-block; background-color: #001699;">
                <input type="radio" name="color_head" value="001699"
                    @if ($site->color_head == '001699') checked @endif></span>

            <span class="color-box" style="width: 30px; height: 30px; display: inline-block; background-color: #003F06;">
                <input type="radio" name="color_head" value="003F06"
                    @if ($site->color_head == '003F06') checked @endif></span>

            <span class="color-box" style="width: 30px; height: 30px; display: inline-block; background-color: #00770D;">
                <input type="radio" name="color_head" value="00770D"
                    @if ($site->color_head == '00770D') checked @endif></span>

            <span class="color-box" style="width: 30px; height: 30px; display: inline-block; background-color: #820000;">
                <input type="radio" name="color_head" value="820000"
                    @if ($site->color_head == '820000') checked @endif></span>

            <span class="color-box" style="width: 30px; height: 30px; display: inline-block; background-color: #560000;">
                <input type="radio" name="color_head" value="560000"
                    @if ($site->color_head == '560000') checked @endif></span>

            <span class="color-box" style="width: 30px; height: 30px; display: inline-block; background-color: #444444;">
                <input type="radio" name="color_head" value="444444"
                    @if ($site->color_head == '444444') checked @endif></span>

            <span class="color-box" style="width: 30px; height: 30px; display: inline-block; background-color: #000000;">
                <input type="radio" name="color_head" value="000000"
                    @if ($site->color_head == '000000') checked @endif></span>

            <p class="link-danger">Выберите цвет верхней полосы сайта</p>
        </div>

        <div class="card card-body p-1 " id="heading" contenteditable="true">{{ $site->heading }}</div>
        <p class="link-danger">Напишите чем занимаетесь и где, в два-три слова например"Автоэлектрики Алматы"</p>
        <p></p>

        <div class="card card-body p-1 " id="phone_1" contenteditable="true">{{ $site->phone_1 }}
        </div>
        <p class="link-danger">Напишите номер телефона для контактов, пример +70000000000</p>
        <p></p>
        <hr>

        <div>
            <span class="color-box" style="width: 30px; height: 30px; display: inline-block; background-color: #FFF9DD;">
                <input type="radio" name="color_body" value="FFF9DD"
                    @if ($site->color_body == 'FFF9DD') checked @endif></span>

            <span class="color-box" style="width: 30px; height: 30px; display: inline-block; background-color: #F4DDFF;">
                <input type="radio" name="color_body" value="F4DDFF"
                    @if ($site->color_body == 'F4DDFF') checked @endif></span>

            <span class="color-box" style="width: 30px; height: 30px; display: inline-block; background-color: #BAC4FF;">
                <input type="radio" name="color_body" value="BAC4FF"
                    @if ($site->color_body == 'BAC4FF') checked @endif></span>

            <span class="color-box" style="width: 30px; height: 30px; display: inline-block; background-color: #DDE2FF;">
                <input type="radio" name="color_body" value="DDE2FF"
                    @if ($site->color_body == 'DDE2FF') checked @endif></span>

            <span class="color-box" style="width: 30px; height: 30px; display: inline-block; background-color: #C1FFC8;">
                <input type="radio" name="color_body" value="C1FFC8"
                    @if ($site->color_body == 'C1FFC8') checked @endif></span>

            <span class="color-box" style="width: 30px; height: 30px; display: inline-block; background-color: #DDFFE1;">
                <input type="radio" name="color_body" value="DDFFE1"
                    @if ($site->color_body == 'DDFFE1') checked @endif></span>

            <span class="color-box" style="width: 30px; height: 30px; display: inline-block; background-color: #FFC9C9;">
                <input type="radio" name="color_body" value="FFC9C9"
                    @if ($site->color_body == 'FFC9C9') checked @endif></span>

            <span class="color-box" style="width: 30px; height: 30px; display: inline-block; background-color: #FFDDDD;">
                <input type="radio" name="color_body" value="FFDDDD"
                    @if ($site->color_body == 'FFDDDD') checked @endif></span>

            <span class="color-box" style="width: 30px; height: 30px; display: inline-block; background-color: #FFFFFF;">
                <input type="radio" name="color_body" value="FFFFFF"
                    @if ($site->color_body == 'FFFFFF') checked @endif></span>

            <span class="color-box" style="width: 30px; height: 30px; display: inline-block; background-color: #D8D8D8;">
                <input type="radio" name="color_body" value="D8D8D8"
                    @if ($site->color_body == 'D8D8D8') checked @endif></span>

            <p class="link-danger">Выберите цвет заднего фона сайта</p>
        </div>

        <div id="top_text" class="card card-body p-1 " contenteditable="true">{{ $site->top_text }} </div>
        <p class="link-danger">Напишите коротко главные направления деятельности например "Срочный выезд для запуска
            автомобиля, диагностика на выезде, заправка и ремонт кондиционера"</p>
        <p></p>
        <hr>
        <div>
            <span class="color-box" style="width: 30px; height: 30px; display: inline-block; background-color: #776300;">
                <input type="radio" name="color_card" value="776300"
                    @if ($site->color_card == '776300') checked @endif></span>

            <span class="color-box" style="width: 30px; height: 30px; display: inline-block; background-color: #3B0056;">
                <input type="radio" name="color_card" value="3B0056"
                    @if ($site->color_card == '3B0056') checked @endif></span>

            <span class="color-box" style="width: 30px; height: 30px; display: inline-block; background-color: #002655;">
                <input type="radio" name="color_card" value="002655"
                    @if ($site->color_card == '002655') checked @endif></span>

            <span class="color-box" style="width: 30px; height: 30px; display: inline-block; background-color: #001699;">
                <input type="radio" name="color_card" value="001699"
                    @if ($site->color_card == '001699') checked @endif></span>

            <span class="color-box" style="width: 30px; height: 30px; display: inline-block; background-color: #003F06;">
                <input type="radio" name="color_card" value="003F06"
                    @if ($site->color_card == '003F06') checked @endif></span>

            <span class="color-box" style="width: 30px; height: 30px; display: inline-block; background-color: #00770D;">
                <input type="radio" name="color_card" value="00770D"
                    @if ($site->color_card == '00770D') checked @endif></span>

            <span class="color-box" style="width: 30px; height: 30px; display: inline-block; background-color: #820000;">
                <input type="radio" name="color_card" value="820000"
                    @if ($site->color_card == '820000') checked @endif></span>

            <span class="color-box" style="width: 30px; height: 30px; display: inline-block; background-color: #560000;">
                <input type="radio" name="color_card" value="560000"
                    @if ($site->color_card == '560000') checked @endif></span>

            <span class="color-box" style="width: 30px; height: 30px; display: inline-block; background-color: #444444;">
                <input type="radio" name="color_card" value="444444"
                    @if ($site->color_card == '444444') checked @endif></span>

            <span class="color-box" style="width: 30px; height: 30px; display: inline-block; background-color: #000000;">
                <input type="radio" name="color_card" value="000000"
                    @if ($site->color_card == '000000') checked @endif></span>

            <p class="link-danger">Выберите цвет верхней полосы карточек</p>
        </div>
        <div id="text_1_a" class="card card-body p-1" contenteditable="true"> {{ $site->text_1_a }}</div>
        <p class="link-danger">Напишите заголовок карточки вида работ</p>
        <p></p>
        <img id="preview" class=" img-fluid shadow " src="{{ $site->foto_1 }}" alt="Фото потерялось">
        <br> <br>


        <input class="form-control" type="file" id="fileInput" name="foto_1" value="plug.jpg">
        <p class="link-danger">Выберите свое фото</p>
        <br>
        <div class="card card-body p-1 " id="text_1_b" contenteditable="true" data-placeholder=" Напишите комментарий">
            {{ $site->text_1_b }}</div>
        <p class="link-danger">Напишите текст под фото</p>
        <p></p>
        <hr>
        <br><br>
        {{-- ========================================================================== --}}
        <div id="text_2_a" class="card card-body p-1" contenteditable="true"> {{ $site->text_2_a }}</div>
        <p class="link-danger">Напишите заголовок карточки вида работ</p>
        <p></p>
        <img id="preview2" class=" img-fluid shadow " src="{{ $site->foto_2 }}" alt="Фото потерялось">
        <br> <br>

        <input class="form-control" type="file" id="fileInput2" name="foto_2">
        <p class="link-danger">Выберите свое фото</p>
        <br>
        <div class="card card-body p-1 " id="text_2_b" contenteditable="true" data-placeholder=" Напишите комментарий">
            {{ $site->text_2_b }}</div>
        <p class="link-danger">Напишите текст под фото</p>
        <p></p>
        <hr>
        <br><br>

        {{-- ========================================================================== --}}
        <div id="text_3_a" class="card card-body p-1" contenteditable="true"> {{ $site->text_3_a }}</div>
        <p class="link-danger">Напишите заголовок карточки вида работ</p>
        <p></p>
        <img id="preview3" class=" img-fluid shadow " src="{{ $site->foto_3 }}" alt="Фото потерялось">
        <br> <br>

        <input class="form-control" type="file" id="fileInput3" name="foto_3">
        <p class="link-danger">Выберите свое фото</p>
        <br>
        <div class="card card-body p-1 " id="text_3_b" contenteditable="true" data-placeholder=" Напишите комментарий">
            {{ $site->text_3_b }}</div>
        <p class="link-danger">Напишите текст под фото</p>
        <p></p>
        <hr>
        <br><br>
        {{-- ========================================================================== --}}
        <div id="text_4_a" class="card card-body p-1" contenteditable="true"> {{ $site->text_4_a }}</div>
        <p class="link-danger">Напишите заголовок карточки вида работ</p>
        <p></p>
        <img id="preview4" class=" img-fluid shadow " src="{{ $site->foto_4 }}" alt="Фото потерялось">
        <br> <br>

        <input class="form-control" type="file" id="fileInput4" name="foto_4">
        <p class="link-danger">Выберите свое фото</p>
        <br>
        <div class="card card-body p-1 " id="text_4_b" contenteditable="true" data-placeholder=" Напишите комментарий">
            {{ $site->text_4_b }}</div>
        <p class="link-danger">Напишите текст под фото</p>
        <p></p>
        <hr>
        <br><br>
        {{-- ========================================================================== --}}
        <div id="text_5_a" class="card card-body p-1" contenteditable="true"> {{ $site->text_5_a }}</div>
        <p class="link-danger">Напишите заголовок карточки вида работ</p>
        <p></p>
        <img id="preview5" class=" img-fluid shadow " src="{{ $site->foto_5 }}" alt="Фото потерялось">
        <br> <br>

        <input class="form-control" type="file" id="fileInput5" name="foto_5">
        <p class="link-danger">Выберите свое фото</p>
        <br>
        <div class="card card-body p-1 " id="text_5_b" contenteditable="true" data-placeholder=" Напишите комментарий">
            {{ $site->text_5_b }}</div>
        <p class="link-danger">Напишите текст под фото</p>
        <p></p>
        <hr>
        <br><br>

        <div id="bottom_text" class="card card-body p-1 " contenteditable="true">{{ $site->bottom_text }} </div>
        <p class="link-danger">Подведите итоги, напишите доп контакты и пр.</p>
        <p></p>
        <hr>



        <button class="btn btn-primary " title="Отправить" type="submit">Сохранить сайт</button>
    </form>
    <hr>



    <script>
        //================================================================================
        const fileInput = document.getElementById('fileInput');
        const preview = document.getElementById('preview');

        fileInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    // preview.style.display = 'block'; // Показываем изображение
                };

                reader.readAsDataURL(file); // Читаем файл как DataURL
            }
        });


        //=======================================================================================
        document.addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(event.target);

            formData.append("heading", event.target.querySelector('#heading').textContent);
            formData.append("phone_1", event.target.querySelector('#phone_1').textContent);
            formData.append("top_text", event.target.querySelector('#top_text').textContent);
            formData.append("text_1_a", event.target.querySelector('#text_1_a').textContent);
            formData.append("text_1_b", event.target.querySelector('#text_1_b').textContent);
            formData.append("text_2_a", event.target.querySelector('#text_2_a').textContent);
            formData.append("text_2_b", event.target.querySelector('#text_2_b').textContent);
            formData.append("text_3_a", event.target.querySelector('#text_3_a').textContent);
            formData.append("text_3_b", event.target.querySelector('#text_3_b').textContent);
            formData.append("text_4_a", event.target.querySelector('#text_4_a').textContent);
            formData.append("text_4_b", event.target.querySelector('#text_4_b').textContent);
            formData.append("text_5_a", event.target.querySelector('#text_5_a').textContent);
            formData.append("text_5_b", event.target.querySelector('#text_5_b').textContent);

            fetch('/site', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrf_token
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(commits => {});
        });
    </script>
@endsection
