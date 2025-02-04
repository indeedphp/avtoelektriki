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
                    <a class="nav-link link-danger " href="{{ route('cabinet_new_post') }}">Новый пост</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Все посты</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cabinet_edit_post') }}">Редактируем пост</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Сайт</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Статистика</a>
                </li>
            </ul>
        </div>

    </nav>




        <hr>
        <p> Создайте свой пост, посмотреть его предварительно можно тут <a class="nav-link" href="{{ route('draft_index')}}" target="_blank">Показать пост</a>
        </p>
        <hr>
        <form method="POST">
            @csrf
            <div class="card card-body p-1 " id="div_name_post" contenteditable="true"
                data-placeholder=" Напишите комментарий"> </div>
            <p class="link-danger">Название поста(обязательное поле)</p>
            <p></p>

            <img id="preview" class=" img-fluid shadow " src="plug.jpg" alt="Фото потерялось">

            <p class="link-danger">Выберите свое фото(обязательно для изменения)</p>

            <input class="form-control" type="file" id="fileInput" name="foto_1">
            <br>
            <div class="card card-body p-1 " id="div_text_post" contenteditable="true"
                data-placeholder=" Напишите комментарий"> </div>
            <p class="link-danger">Напишите текст под фото (обязательное поле)</p>
            <p></p>
            {{-- <img id="preview" style="max-width: 300px; display: none;" alt="Предпросмотр"> --}}
            <label>
                <input type="checkbox" id="toggleCheckbox" name="checkbox_1"> Добавить в пост второй блок фото плюс текст
            </label>
            <br><br>


            <div id="myDiv" hidden>
                <img id="preview2" class=" img-fluid shadow " src="plug.jpg" alt="Фото потерялось">

                <p class="link-danger">Выберите свое фото 2 (обязательно для изменения)</p>

                <input class="form-control" type="file" id="fileInput2" name="foto_2">
                <br>
                <div class="card card-body p-1 " id="div_text_post_2" contenteditable="true"
                    data-placeholder=" Напишите комментарий"> </div>
                <p class="link-danger">Напишите текст под фото 2 (обязательное поле)</p>
                <p></p>
                            <label>
                <input type="checkbox" id="toggleCheckbox2" name="checkbox_2"> Добавить в пост третий блок фото плюс текст
            </label>
            </div>
            <br><br>
            <hr>

            <div id="myDiv2" hidden>
                <img id="preview3" class=" img-fluid shadow " src="plug.jpg" alt="Фото потерялось">

                <p class="link-danger">Выберите свое фото 3 (обязательно для изменения)</p>

                <input class="form-control" type="file" id="fileInput3" name="foto_3">
                <br>
                <div class="card card-body p-1 " id="div_text_post_3" contenteditable="true"
                    data-placeholder=" Напишите комментарий"> </div>
                <p class="link-danger">Напишите текст под фото 3 (обязательное поле)</p>
                <p></p>
  
            </div>


            <button class="btn btn-primary " title="Отправить" type="submit">Сохранить пост</button>
        </form>
        <hr>
        <button class="btn btn-primary " title="Отправить" type="submit">Опубликовать пост</button>
        <hr>


        <script>
            const checkbox = document.getElementById('toggleCheckbox');
            const div = document.getElementById('myDiv');

            // Обработчик события для чекбокса
            checkbox.addEventListener('change', function() {
                // Если чекбокс выбран, убираем атрибут hidden, показываем блок
                if (checkbox.checked) {
                    div.removeAttribute('hidden');
                } else {
                    div.setAttribute('hidden', true); // Добавляем атрибут hidden, скрываем блок
                }
            });
//--------------------------------------------------------------------
            const checkbox2 = document.getElementById('toggleCheckbox2');
            const div2 = document.getElementById('myDiv2');

            // Обработчик события для чекбокса
            checkbox2.addEventListener('change', function() {
                // Если чекбокс выбран, убираем атрибут hidden, показываем блок
                if (checkbox2.checked) {
                    div2.removeAttribute('hidden');
                } else {
                    div2.setAttribute('hidden', true); // Добавляем атрибут hidden, скрываем блок
                }
            });
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
//----------------------------------------------------------------------------------
            const fileInput2 = document.getElementById('fileInput2');
            const preview2 = document.getElementById('preview2');

            fileInput2.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        preview2.src = e.target.result;
                        // preview.style.display = 'block'; // Показываем изображение
                    };

                    reader.readAsDataURL(file); // Читаем файл как DataURL
                }
            });
//------------------------------------------------------------------------------
const fileInput3 = document.getElementById('fileInput3');
            const preview3 = document.getElementById('preview3');

            fileInput3.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        preview3.src = e.target.result;
                        // preview.style.display = 'block'; // Показываем изображение
                    };

                    reader.readAsDataURL(file); // Читаем файл как DataURL
                }
            });


//=======================================================================================
            document.addEventListener('submit', function(event) {
                event.preventDefault();
                const formData = new FormData(event.target);
                let div_name_post = event.target.querySelector('#div_name_post');
                let div_text_post = event.target.querySelector('#div_text_post');
                let div_text_post_2 = event.target.querySelector('#div_text_post_2');
                let div_text_post_3 = event.target.querySelector('#div_text_post_3');

                formData.append("name_post", div_name_post.textContent);
                formData.append("text_post", div_text_post.textContent);
                formData.append("text_post_2", div_text_post_2.textContent);
                formData.append("text_post_3", div_text_post_3.textContent);


                fetch('/draft_post', {
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
