@extends('layouts/main')



@section('posts')
    <nav class="navbar navbar-expand-lg  p-0 pe-2">

        <a class="navbar-brand ps-3">Кабинет пользователя:</a>
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
                    <a class="link-danger nav-link" href="{{ route('cabinet_edit_post') }}">Редактируем пост</a>
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
    <hr>
    <b class=" mb-3" >На странице показан ваш последний пост, если хотите выбрать другой то пройдите на страницу<a href="{{ route('cabinet_all_post') }}"> все посты</a> </b> 
    <hr>
    <form method="POST">
        @csrf
        <input type="hidden" name="post_id" value="{{ $post->id }}">
        <div class="card card-body p-1 " id="div_name_post" contenteditable="true" data-placeholder=" Напишите комментарий">
            {{ $post->name_post }}</div>
        <p class="link-danger">Правим название поста</p>
        <p></p>

        {{-- 1 ============================================================================================== --}}
        <img id="preview_1" class=" img-fluid shadow " src="{{ url($post->url_foto) }}" alt="Фото потерялось">
        <p class="link-danger">Фото 1</p>
        <input class="form-control" type="file" id="file_input_1" name="foto_1">
        {{-- <input class="form-control" type="file" name="foto_1"> --}}
        <p class="link-danger">Изменить фото 1</p>
        <p></p>
        <div class="card card-body p-1 " id="div_text_post" contenteditable="true" data-placeholder=" Напишите комментарий">
            {{ $post->text_post }}</div>
        <p class="link-danger">Правим текст под фото 1</p>
        <p></p>
        <br>
        <hr>
        {{-- 2 ============================================================================================== --}}
        @if ($post->url_foto_2 !== null)
            <img id="preview_2" class=" img-fluid shadow " src="{{ url($post->url_foto_2) }}" alt="Фото потерялось">
            <p class="link-danger">Фото 2</p>
            <input class="form-control" type="file" id="file_input_2" name="foto_2">
            <p class="link-danger">Изменить фото 2</p>
            <p></p>
            <div class="card card-body p-1 " id="div_text_post_2" contenteditable="true"
                data-placeholder=" Напишите комментарий"> {{ $post->text_post_2 }}</div>
            <p class="link-danger">Правим текст под фото 2</p>
            <p></p>
            <br>
        @endif
        <hr>
        {{-- 3 ============================================================================================== --}}
        @if ($post->url_foto_3 !== null)
            <img id="preview_3" class=" img-fluid shadow " src="{{ url($post->url_foto_3) }}" alt="Фото потерялось">
            <p class="link-danger">Фото 3</p>
            <input class="form-control" type="file" id="file_input_3" name="foto_3">
            <p class="link-danger">Изменить фото 3</p>
            <p></p>
            <div class="card card-body p-1 " id="div_text_post_3" contenteditable="true"
                data-placeholder=" Напишите комментарий"> {{ $post->text_post_3 }}</div>
            <p class="link-danger">Правим текст под фото 3</p>
            <p></p>
            <br>
            <br>
        @endif
        <hr>
        {{-- 4 ============================================================================================== --}}
        @if ($post->url_foto_4 !== null)
            <img id="preview_4" class=" img-fluid shadow " src="{{ url($post->url_foto_4) }}" alt="Фото потерялось">
            <p class="link-danger">Фото 4</p>
            <input class="form-control" type="file" id="file_input_4" name="foto_4">
            <p class="link-danger">Изменить фото 4</p>
            <p></p>
            <div class="card card-body p-1 " id="div_text_post_4" contenteditable="true"
                data-placeholder=" Напишите комментарий"> {{ $post->text_post_4 }}</div>
            <p class="link-danger">Правим текст под фото 4</p>
            <p></p>
            <br>
            <br>
        @endif
        <hr>
        {{-- 5 ============================================================================================== --}}
        @if ($post->url_foto_5 !== null)
            <img id="preview_5" class=" img-fluid shadow " src="{{ url($post->url_foto_5) }}" alt="Фото потерялось">
            <p class="link-danger">Фото 5</p>
            <input class="form-control" type="file" id="file_input_5" name="foto_5">
            <p class="link-danger">Изменить фото 5</p>
            <p></p>
            <div class="card card-body p-1 " id="div_text_post_5" contenteditable="true"
                data-placeholder=" Напишите комментарий"> {{ $post->text_post_5 }}</div>
            <p class="link-danger">Правим текст под фото 5</p>
            <p></p>
            <br>
            <br>
        @endif
        {{-- ============================================================================================== --}}

        

            <button class="btn btn-primary " title="Отправить" type="submit">Сохранить изменения поста</button>
       
    </form>
    <a class="btn btn-primary my-3" href="{{ route('channel2', $post->id) }}" target="_blank">Посмотреть как выглядит пост</a>
    <p></p>

    <br> <br> <br>

   
<script>
      //  =======предпросмотр фото 1=========================================================================
        let file_input_1 = document.getElementById('file_input_1');
        let preview_1 = document.getElementById('preview_1');

        file_input_1.addEventListener('change', function(event) {
            let file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview_1.src = e.target.result;
                };
                reader.readAsDataURL(file); // Читаем файл как DataURL
            }
        });
// -------------предпросмотр фото 2--------------------------------------------------------------------------
let file_input_2 = document.getElementById('file_input_2');
        let preview_2 = document.getElementById('preview_2');
 
        file_input_2.addEventListener('change', function(event) {
            let file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview_2.src = e.target.result;
                };
                reader.readAsDataURL(file); // Читаем файл как DataURL
            }
        });
// ---------------предпросмотр фото 3------------------------------------------------------------------------
let file_input_3 = document.getElementById('file_input_3');
        let preview_3 = document.getElementById('preview_3');
     
        file_input_3.addEventListener('change', function(event) {
            let file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview_3.src = e.target.result;
                };
                reader.readAsDataURL(file); // Читаем файл как DataURL
            }
        });
// ----------------предпросмотр фото 4-----------------------------------------------------------------------
let file_input_4 = document.getElementById('file_input_4');
        let preview_4 = document.getElementById('preview_4');

        file_input_4.addEventListener('change', function(event) {
            let file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview_4.src = e.target.result;
                };
                reader.readAsDataURL(file); // Читаем файл как DataURL
            }
        });
// ----------------предпросмотр фото 5------------------------------------------------------------------------
let file_input_5 = document.getElementById('file_input_5');
        let preview_5 = document.getElementById('preview_5');

        file_input_5.addEventListener('change', function(event) {
            let file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview_5.src = e.target.result;
                };
                reader.readAsDataURL(file); // Читаем файл как DataURL
            }
        });
// ==== отправка формы плюс текста ================================================================================
    document.addEventListener('submit', function(event) {
        event.preventDefault();
        let formData = new FormData(event.target);
        let div_text_post_2 = null;
        if (document.getElementById("div_text_post_2")) div_text_post_2 = event.target.querySelector('#div_text_post_2').textContent;
 

        formData.append("name_post", event.target.querySelector('#div_name_post').textContent);
        formData.append("text_post", event.target.querySelector('#div_text_post').textContent);
        formData.append("text_post_2", div_text_post_2);
        formData.append("text_post_3", event.target.querySelector('#div_text_post_3').textContent);
        formData.append("text_post_4", event.target.querySelector('#div_text_post_4').textContent);
        formData.append("text_post_5", event.target.querySelector('#div_text_post_5').textContent);


        fetch('/cabinet_edit_post', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrf_token
                },
                body: formData
            })
            .then(response => response.json())
            .then(commits => {

            });


    })
</script>
@endsection