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
    <form method="POST" action="{{ route('draft_post_create') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="draft_post_id" value="{{ $draft_post->id }}">

<textarea class="form-control" placeholder="Напишите текст под фото" name="name_post">
@if($draft_post->name_post != null){{$draft_post->name_post}}@else{{old('name_post')}}@endif
</textarea>
@error('name_post')
<b class="link-danger ms-2">Ошибка: {{ $message }}</b>
@enderror

        <p class="link-danger">Название поста (обязательно для заполнения)</p>
        <p></p>

        {{-- -------------------- карточка 1 -------------------------------------------- --}}
        <div>
            <img id="preview" class=" img-fluid shadow "
                src="@if ($draft_post->url_foto == null) {{ url('plug.jpg') }}@else{{ url($draft_post->url_foto) }} @endif"
                alt="Фото потерялось">
            @error('foto_1')
                <b class="link-danger ">Ошибка: {{ $message }}</b>
            @enderror
            <input class="form-control" type="file" id="fileInput" name="foto_1">
            <p class="link-danger">Выберите свое фото</p>
            <p id="error_foto_size_1" class="link-danger"></p>
            
            
<textarea class="form-control" placeholder="Напишите текст под фото" name="text_post_1">
@if($draft_post->text_post != null){{ $draft_post->text_post}}@else{{old('text_post_1')}}@endif
</textarea>
@error('text_post_1')
<b class="link-danger ms-2">Ошибка: {{ $message }}</b>
@enderror
            <p class="link-danger">Напишите текст под фото</p>
            <p></p>
            {{-- checkbox 1----------------------------------------------------------------------------------- --}}
            <hr>
            <label>
                @if ($draft_post->url_foto_2 == null && $draft_post->text_post_2 == null)
                    <input type="checkbox" id="toggleCheckbox" name="checkbox_1"> <i id="checkbox_text_1"> Добавить второй
                        блок
                        фото плюс текст </i>
                @else
                    <input type="checkbox" id="toggleCheckbox" name="checkbox_1" checked> <i id="checkbox_text_1"> Убрать
                        блоки
                        ниже </i>
                @endif
            </label>
            <br>
            <hr><br>
        </div>
        {{-- -------------------- карточка 2 -------------------------------------------- --}}

        <div id="myDiv" @if ($draft_post->url_foto_2 == null && $draft_post->text_post_2 == null) hidden @endif>
            <img id="preview2" class=" img-fluid shadow "
                src="@if ($draft_post->url_foto_2 == null) {{ url('plug.jpg') }}@else{{ url($draft_post->url_foto_2) }} @endif"
                alt="Фото потерялось">
                @error('foto_2')
                <b class="link-danger ">Ошибка: {{ $message }}</b>
            @enderror
            

            <input class="form-control" type="file" id="fileInput2" name="foto_2" >
            <p class="link-danger">Выберите свое фото 2 </p>
            <p id="error_foto_size_2" class="link-danger"></p>
            <br>
<textarea class="form-control" placeholder="Напишите текст под фото 2" name="text_post_2">
@if($draft_post->text_post_2 != null){{$draft_post->text_post_2}}@else{{old('text_post_2')}}@endif
</textarea>
@error('text_post_2')
<b class="link-danger ms-2">Ошибка: {{ $message }}</b>
@enderror
            <p class="link-danger">Напишите текст под фото 2 </p>
            <p></p>
            {{-- checkbox 2----------------------------------------------------------------------------------- --}}
            <hr>
            <label>
                @if ($draft_post->url_foto_3 == null && $draft_post->text_post_3 == null)
                    <input type="checkbox" id="toggleCheckbox2" name="checkbox_2"> <i id="checkbox_text_2"> Добавить третий
                        блок
                        фото плюс текст </i>
                @else
                    <input type="checkbox" id="toggleCheckbox2" name="checkbox_2" checked> <i id="checkbox_text_2"> Убрать
                        блоки
                        ниже </i>
                @endif
            </label>
            <br>
            <hr><br>
        </div>

        {{-- -------------------- карточка 3 -------------------------------------------- --}}

        <div id="myDiv2" @if ($draft_post->url_foto_3 == null && $draft_post->text_post_3 == null) hidden @endif>
            <img id="preview3" class=" img-fluid shadow "
                src="@if ($draft_post->url_foto_3 == null) {{ url('plug.jpg') }}@else{{ url($draft_post->url_foto_3) }} @endif"
                alt="Фото потерялось">
                @error('foto_3')
                <b class="link-danger ">Ошибка: {{ $message }}</b>
            @enderror
            <input class="form-control" type="file" id="fileInput3" name="foto_3">
            <p class="link-danger">Выберите свое фото 3 </p>
            <p id="error_foto_size_3" class="link-danger"></p>
            
            <br>
<textarea class="form-control" placeholder="Напишите текст под фото 3" name="text_post_3">
@if ($draft_post->text_post_3 != null){{$draft_post->text_post_3}}@else{{old('text_post_3')}}@endif
</textarea>
@error('text_post_3')
<b class="link-danger ms-2">Ошибка: {{ $message }}</b>
@enderror
            <p class="link-danger">Напишите текст под фото 3 </p>
            <p></p>
            {{-- checkbox 3----------------------------------------------------------------------------------- --}}
            <hr>
            <label>
                @if ($draft_post->url_foto_4 == null && $draft_post->text_post_4 == null)
                    <input type="checkbox" id="toggleCheckbox3" name="checkbox_3"> <i id="checkbox_text_3"> Добавить
                        четвертый блок фото плюс текст </i>
                @else
                    <input type="checkbox" id="toggleCheckbox3" name="checkbox_3" checked> <i id="checkbox_text_3">
                        Убрать блоки ниже </i>
                @endif
            </label>
            <br>
            <hr><br>
        </div>

        {{-- -------------------- карточка 4 -------------------------------------------- --}}
        <div id="myDiv3" @if ($draft_post->url_foto_4 == null && $draft_post->text_post_4 == null) hidden @endif>
            <img id="preview4" class=" img-fluid shadow "
                src="@if ($draft_post->url_foto_4 == null) {{ url('plug.jpg') }}@else{{ url($draft_post->url_foto_4) }} @endif"
                alt="Фото потерялось">
                @error('foto_4')
                <b class="link-danger ">Ошибка: {{ $message }}</b>
            @enderror
            <input class="form-control" type="file" id="fileInput4" name="foto_4">
            <p class="link-danger">Выберите свое фото 4 </p>
            <p id="error_foto_size_4" class="link-danger"></p>
          
            <br>
<textarea class="form-control" placeholder="Напишите текст под фото 4" name="text_post_4">
@if ($draft_post->text_post_4 != null)
{{$draft_post->text_post_4}}@else{{old('text_post_4')}}@endif
</textarea>
@error('text_post_4')
<b class="link-danger ms-2">Ошибка: {{ $message }}</b>
@enderror
            <p class="link-danger">Напишите текст под фото 4 </p>
            <p></p>
            {{-- checkbox 4----------------------------------------------------------------------------------- --}}
            <hr>
            <label>
                @if ($draft_post->url_foto_5 == null && $draft_post->text_post_5 == null)
                    <input type="checkbox" id="toggleCheckbox4" name="checkbox_4"> <i id="checkbox_text_4"> Добавить
                        пятый блок фото плюс текст </i>
                @else
                    <input type="checkbox" id="toggleCheckbox4" name="checkbox_4" checked> <i id="checkbox_text_4">
                        Убрать блоки ниже </i>
                @endif
            </label>
            <br>
            <hr><br>
        </div>

        {{-- -------------------- карточка 5 -------------------------------------------- --}}

        <div id="myDiv4" @if ($draft_post->url_foto_5 == null && $draft_post->text_post_5 == null) hidden @endif>
            <img id="preview5" class=" img-fluid shadow "
                src="@if ($draft_post->url_foto_5 == null) {{ url('plug.jpg') }}@else{{ url($draft_post->url_foto_5) }} @endif"
                alt="Фото потерялось">
                @error('foto_5')
                <b class="link-danger ">Ошибка: {{ $message }}</b>
            @enderror
            <input class="form-control" type="file" id="fileInput5" name="foto_5">
            <p class="link-danger">Выберите свое фото 5 </p>
            <p id="error_foto_size_5" class="link-danger"></p>
            
            <br>
<textarea class="form-control" placeholder="Напишите текст под фото 5" name="text_post_5">
@if($draft_post->text_post_5 != null){{$draft_post->text_post_5}}@else{{old('text_post_5')}}@endif
</textarea>
@error('text_post_5')
<b class="link-danger ms-2">Ошибка: {{ $message }}</b>
@enderror
            <p class="link-danger">Напишите текст под фото 5 </p>
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
        const checkbox = document.getElementById('toggleCheckbox');
        const checkbox2 = document.getElementById('toggleCheckbox2');
        const checkbox3 = document.getElementById('toggleCheckbox3');
        const checkbox4 = document.getElementById('toggleCheckbox4');
        const div = document.getElementById('myDiv');
        const div2 = document.getElementById('myDiv2');
        const div3 = document.getElementById('myDiv3');
        const div4 = document.getElementById('myDiv4');

        checkbox.addEventListener('change', function() { // Обработчик события для чекбокса 1
            let checkbox_text_1 = document.getElementById("checkbox_text_1");
            if (checkbox.checked) {
                div.removeAttribute('hidden');
                checkbox_text_1.textContent = ' Убрать блоки ниже';
            } else {
                checkbox2.checked = false;
                checkbox3.checked = false;
                checkbox4.checked = false;
                div.setAttribute('hidden', true); // при закрытии закрываем и другие карточки
                div2.setAttribute('hidden', true);
                div3.setAttribute('hidden', true);
                div4.setAttribute('hidden', true);
                checkbox_text_1.textContent = ' Добавить второй блок фото плюс текст';
            }
        });
        //--------------------------------------------------------------------
        checkbox2.addEventListener('change', function() { // Обработчик события для чекбокса 2
            let checkbox_text_2 = document.getElementById("checkbox_text_2");
            if (checkbox2.checked) {
                div2.removeAttribute('hidden');
                checkbox_text_2.textContent = ' Убрать блоки ниже';
            } else {
                checkbox3.checked = false;
                checkbox4.checked = false;
                div2.setAttribute('hidden', true);
                div3.setAttribute('hidden', true);
                div4.setAttribute('hidden', true);
                checkbox_text_2.textContent = ' Добавить третий блок фото плюс текст';
            }
        });
        //--------------------------------------------------------------------
        checkbox3.addEventListener('change', function() { // Обработчик события для чекбокса 3
            let checkbox_text_3 = document.getElementById("checkbox_text_3");
            if (checkbox3.checked) {
                div3.removeAttribute('hidden');
                checkbox_text_3.textContent = ' Убрать блоки ниже';
            } else {
                checkbox4.checked = false;
                div3.setAttribute('hidden', true);
                div4.setAttribute('hidden', true);
                checkbox_text_3.textContent = ' Добавить четвертый блок фото плюс текст';
            }
        });
        //--------------------------------------------------------------------
        checkbox4.addEventListener('change', function() { // Обработчик события для чекбокса 4
            let checkbox_text_4 = document.getElementById("checkbox_text_4");
            if (checkbox4.checked) {
                div4.removeAttribute('hidden');
                checkbox_text_4.textContent = ' Убрать блоки ниже';
            } else {
                div4.setAttribute('hidden', true);
                checkbox_text_4.textContent = ' Добавить пятый блок фото плюс текст';
            }
        });
        //=======предпросмотр фото 1=========================================================================
        const maxSize = 1048576; // Максимальный размер файла: 1MB
        const fileInput = document.getElementById('fileInput');
        const preview = document.getElementById('preview');

        fileInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const error_foto_size_1 = document.getElementById('error_foto_size_1');
                if (file.size > maxSize) error_foto_size_1.textContent = 'Максимальный размер фото — 1MB.';
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
// -------------------------------------------------------------------------------------------------------------
        function draft_post_in_post() { // переносим из черновика в пост для портала
           
                fetch('/draft_post_in_post/' + draft_post_id)
                    .then(response => response.json())
                    .then(commits => {
                        console.dir('111' + commits);

                        if (commits == 'nok') {
                            alert(
                                'Такое название поста у вас уже есть, добавте "продолжение" или "часть 2" или сделайте другое название'
                            );

                        } else alert('Ваш пост успешно размещен');
                        location.reload();

                    });
                }
// -----------------------------------------------------------------------------------------
        function draft_post_clear() { 

            fetch('/draft_post_clear/' + draft_post_id)
                .then(response => response.json())
                .then(commits => {
                    location.reload();
                });
        }
    </script>
@endsection
