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
                    <a class="nav-link" href="{{ route('cabinet_settings') }}">Настройки</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-danger " href="{{ route('cabinet_new_post') }}">Новый пост</a>
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
    {{-- ------------------------------------------------------------------------------------------- --}}

    <hr>
    <p> Создайте свой пост. На странице может быть показан черновик поста из бота если вы его сохранили или незаконченный
        пост. <br>
        <button class="btn btn-primary mt-2" onclick="draft_post_clear();" title="Очищаем пост.">Очистить пост</button>
        <a class="btn btn-primary mt-2" href="{{ route('draft_index', $draft_post->id) }}" target="_blank">Посмотреть как
            будет
            выглядеть пост</a>
    </p>
    <hr>
    {{-- =========  форма ввода ================================================================================== --}}
    <form method="POST">
        @csrf
        <input type="hidden" name="draft_post_id" value="{{ $draft_post->id }}">
        <div class="card card-body p-1 " id="div_name_post" contenteditable="true" data-placeholder=" Напишите комментарий">
            {{ $draft_post->name_post }}
        </div>
        <p class="link-danger">Название поста(обязательное поле)</p>
        <p></p>
        {{-- -------------------- карточка 1 -------------------------------------------- --}}
        <img id="preview" class=" img-fluid shadow "
            src="@if ($draft_post->url_foto == null) {{ url('plug.jpg') }}@else{{ url($draft_post->url_foto) }} @endif"
            alt="Фото потерялось">

        <p class="link-danger">Выберите свое фото(обязательно для изменения)</p>

        <input class="form-control" type="file" id="fileInput" name="foto_1">
        <br>
        <div class="card card-body p-1 " id="div_text_post" contenteditable="true" data-placeholder=" Напишите комментарий">
            {{ $draft_post->text_post }}
        </div>
        <p class="link-danger">Напишите текст под фото (обязательное поле)</p>
        <p></p>
        <label>
            @if ($draft_post->url_foto_2 == null)
                <input type="checkbox" id="toggleCheckbox" name="checkbox_1"> Добавить второй блок фото плюс текст
            @else
                <input hidden type="checkbox" id="toggleCheckbox" name="checkbox_1" checked>
            @endif
        </label>
        <br>
        <hr><br>
        {{-- -------------------- карточка 2 -------------------------------------------- --}}

        <div id="myDiv" @if ($draft_post->url_foto_2 == null) hidden @endif>
            <img id="preview2" class=" img-fluid shadow "
                src="@if ($draft_post->url_foto_2 == null) {{ url('plug.jpg') }}@else{{ url($draft_post->url_foto_2) }} @endif"
                alt="Фото потерялось">

            <p class="link-danger">Выберите свое фото 2 (обязательно для изменения)</p>

            <input class="form-control" type="file" id="fileInput2" name="foto_2">
            <br>
            <div class="card card-body p-1 " id="div_text_post_2"
                contenteditable="true"data-placeholder=" Напишите комментарий">
                {{ $draft_post->text_post_2 }}
            </div>
            <p class="link-danger">Напишите текст под фото 2 (обязательное поле)</p>
            <p></p>
            <label>
                @if ($draft_post->url_foto_3 == null)
                    <input type="checkbox" id="toggleCheckbox2" name="checkbox_2"> Добавить третий блок фото плюс текст
                @else
                    <input hidden type="checkbox" id="toggleCheckbox2" name="checkbox_2" checked>
                @endif
            </label>
            <br>
            <hr><br>
        </div>

        {{-- -------------------- карточка 3 -------------------------------------------- --}}

        <div id="myDiv2" @if ($draft_post->url_foto_3 == null) hidden @endif>
            <img id="preview3" class=" img-fluid shadow "
                src="@if ($draft_post->url_foto_3 == null) {{ url('plug.jpg') }}@else{{ url($draft_post->url_foto_3) }} @endif"
                alt="Фото потерялось">

            <p class="link-danger">Выберите свое фото 3 (обязательно для изменения)</p>

            <input class="form-control" type="file" id="fileInput3" name="foto_3">
            <br>
            <div class="card card-body p-1 " id="div_text_post_3" contenteditable="true"
                data-placeholder=" Напишите комментарий">
                {{ $draft_post->text_post_3 }}
            </div>
            <p class="link-danger">Напишите текст под фото 3 (обязательное поле)</p>
            <p></p>
            <label>
                @if ($draft_post->url_foto_4 == null)
                    <input type="checkbox" id="toggleCheckbox3" name="checkbox_3"> Добавить четвертый блок фото плюс
                    текст
                @else
                    <input hidden type="checkbox" id="toggleCheckbox3" name="checkbox_3" checked>
                @endif
            </label>
            <br>
            <hr><br>
        </div>

        {{-- -------------------- карточка 4 -------------------------------------------- --}}
        <div id="myDiv3" @if ($draft_post->url_foto_4 == null) hidden @endif>
            <img id="preview4" class=" img-fluid shadow "
                src="@if ($draft_post->url_foto_4 == null) {{ url('plug.jpg') }}@else{{ url($draft_post->url_foto_4) }} @endif"
                alt="Фото потерялось">

            <p class="link-danger">Выберите свое фото 4 (обязательно для изменения)</p>

            <input class="form-control" type="file" id="fileInput4" name="foto_4">
            <br>
            <div class="card card-body p-1 " id="div_text_post_4" contenteditable="true"
                data-placeholder=" Напишите комментарий">
                {{ $draft_post->text_post_4 }}
            </div>
            <p class="link-danger">Напишите текст под фото 4 (обязательное поле)</p>
            <p></p>
            <label>
                @if ($draft_post->url_foto_5 == null)
                    <input type="checkbox" id="toggleCheckbox4" name="checkbox_4"> Добавить пятый блок фото плюс текст
                @else
                    <input hidden type="checkbox" id="toggleCheckbox4" name="checkbox_4" checked>
                @endif
            </label>
            <br>
            <hr><br>
        </div>

        {{-- -------------------- карточка 5 -------------------------------------------- --}}
        <div id="myDiv4" @if ($draft_post->url_foto_5 == null) hidden @endif>
            <img id="preview5" class=" img-fluid shadow "
                src="@if ($draft_post->url_foto_5 == null) {{ url('plug.jpg') }}@else{{ url($draft_post->url_foto_3) }} @endif"
                alt="Фото потерялось">

            <p class="link-danger">Выберите свое фото 5 (обязательно для изменения)</p>

            <input class="form-control" type="file" id="fileInput5" name="foto_5">
            <br>
            <div class="card card-body p-1 " id="div_text_post_5" contenteditable="true"
                data-placeholder=" Напишите комментарий">
                {{ $draft_post->text_post_5 }}
            </div>
            <p class="link-danger">Напишите текст под фото 5 (обязательное поле)</p>
            <p></p>
            <br>
            <hr><br>
        </div>


        {{-- ----------------кнопки------------------------------------------------------------------------- --}}

        <button class="btn btn-primary " title="Сохранить чтоб потом дописать" type="submit">Сохранить пост</button>
    </form>
    <hr>
    <a class="btn btn-primary" href="{{ route('draft_index', $draft_post->id) }}" target="_blank">Посмотреть как будет
        выглядеть пост</a>
    <hr>

    <button class="btn btn-primary p-2" onclick="draft_post_in_post();"
        title="Опубликовать пост, для размещения на главной странице">Публикуем пост на портале автоэлектрики</button>
    <hr>
    <div id="draft_post_id" hidden>{{ $draft_post->id }}</div>

    {{-- ==================  JS  ======================================================================================= --}}
    <script>
        let draft_post_id = document.getElementById("draft_post_id").textContent;
        let temp;
        const checkbox = document.getElementById('toggleCheckbox');
        const checkbox2 = document.getElementById('toggleCheckbox2');
        const checkbox3 = document.getElementById('toggleCheckbox3');
        const checkbox4 = document.getElementById('toggleCheckbox4');
        const div = document.getElementById('myDiv');
        const div2 = document.getElementById('myDiv2');
        const div3 = document.getElementById('myDiv3');
        const div4 = document.getElementById('myDiv4')

        checkbox.addEventListener('change', function() { // Обработчик события для чекбокса 1
            if (checkbox.checked) {
                div.removeAttribute('hidden');
            } else {
                checkbox2.checked = false;
                div.setAttribute('hidden', true); // при закрытии закрываем и другие карточки
                div2.setAttribute('hidden', true);
                div3.setAttribute('hidden', true);
                div4.setAttribute('hidden', true);
            }
        });
        //--------------------------------------------------------------------
        checkbox2.addEventListener('change', function() { // Обработчик события для чекбокса 2
            if (checkbox2.checked) {
                div2.removeAttribute('hidden');
            } else {
                div2.setAttribute('hidden', true);
                div3.setAttribute('hidden', true);
                div4.setAttribute('hidden', true);
            }
        });
        //--------------------------------------------------------------------
        checkbox3.addEventListener('change', function() { // Обработчик события для чекбокса 3
            if (checkbox3.checked) {
                div3.removeAttribute('hidden');
            } else {
                div3.setAttribute('hidden', true);
                div4.setAttribute('hidden', true);
            }
        });
        //--------------------------------------------------------------------
        checkbox4.addEventListener('change', function() { // Обработчик события для чекбокса 4
            if (checkbox4.checked) {
                div4.removeAttribute('hidden');
            } else {
                div4.setAttribute('hidden', true);
            }
        });
        //=======предпросмотр фото 1=========================================================================
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
        //----------предпросмотр фото 2------------------------------------------------------------------------
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
        //----------предпросмотр фото 3--------------------------------------------------------------------
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
        //----------предпросмотр фото 4--------------------------------------------------------------------
        const fileInput4 = document.getElementById('fileInput4');
        const preview4 = document.getElementById('preview4');

        fileInput4.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview4.src = e.target.result;
                    // preview.style.display = 'block'; // Показываем изображение
                };

                reader.readAsDataURL(file); // Читаем файл как DataURL
            }
        });
        //----------предпросмотр фото 5--------------------------------------------------------------------
        const fileInput5 = document.getElementById('fileInput5');
        const preview5 = document.getElementById('preview5');

        fileInput5.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview5.src = e.target.result;
                    // preview.style.display = 'block'; // Показываем изображение
                };

                reader.readAsDataURL(file); // Читаем файл как DataURL
            }
        });

        //========= отправка формы и текста из див ==============================================================================
        document.addEventListener('submit', function(event) {
            temp = true;
            // console.log(temp+'333');
            event.preventDefault();
            const formData = new FormData(event.target);
            // let div_name_post = event.target.querySelector('#div_name_post');
            // let div_text_post = event.target.querySelector('#div_text_post');
            // let div_text_post_2 = event.target.querySelector('#div_text_post_2');
            // let div_text_post_3 = event.target.querySelector('#div_text_post_3');
            // let div_text_post_4 = event.target.querySelector('#div_text_post_4');
            // let div_text_post_5 = event.target.querySelector('#div_text_post_5');
            // let preview = event.target.querySelector('#preview');




            formData.append("preview", event.target.querySelector('#preview').getAttribute('src'));
            formData.append("preview2", event.target.querySelector('#preview2').getAttribute('src'));
            formData.append("preview3", event.target.querySelector('#preview3').getAttribute('src'));
            formData.append("preview4", event.target.querySelector('#preview4').getAttribute('src'));
            formData.append("preview5", event.target.querySelector('#preview5').getAttribute('src'));

            formData.append("name_post", event.target.querySelector('#div_name_post').textContent);
            formData.append("text_post", event.target.querySelector('#div_text_post').textContent);
            formData.append("text_post_2", event.target.querySelector('#div_text_post_2').textContent);
            formData.append("text_post_3", event.target.querySelector('#div_text_post_3').textContent);
            formData.append("text_post_4", event.target.querySelector('#div_text_post_4').textContent);
            formData.append("text_post_5", event.target.querySelector('#div_text_post_5').textContent);

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

        function draft_post_in_post() { // переносим из черновика в пост для портала
            if (temp) {
                fetch('/draft_post_in_post/' + draft_post_id)
                    .then(response => response.json())
                    .then(commits => {
                        console.dir(commits);


                        if (commits == 'nok') {
                            alert(
                                'Такое название поста у вас уже есть, добавте "продолжение" или "часть 2" или сделайте другое название');

                        } else alert('Ваш пост успешно размещен');
                        location.reload();

                    });
            } else alert('Сначала сохраните пост');

        }

        function draft_post_clear() { // пе

            fetch('/draft_post_clear/' + draft_post_id)
                .then(response => response.json())
                .then(commits => {
                    location.reload();
                });


        }
    </script>
@endsection
