@extends('layouts/main')



@section('posts')
<x-nav-cabinet/> {{-- вставляем навигацию --}}
    <hr>
    
    @if($post != null)  {{-- если пустой пост то , окончание условия в низу поста --}}

    <b class=" mb-3" >На странице показан ваш крайний пост, если хотите выбрать другой то пройдите на страницу<a href="{{ route('cabinet_all_post') }}"> все посты</a> </b> 
    <hr>
    {{-- =========  форма ввода ================================================================================== --}}
    <form method="POST" action="{{ route('cabinet_edit_post2') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="post_id" value="{{ $post->id }}">

<textarea id="input_text_1" inf="1" class="form-control" placeholder="Напишите название поста" name="name_post">
@if($post->name_post != null){{$post->name_post}}@else{{old('name_post')}}@endif
</textarea>
@error('name_post')
<b class="link-danger ms-2">Ошибка: {{ $message }}</b>
@enderror
<p>Количество символов: <span id="symbols_count_1"></span></p>

        <p class="link-danger">Название поста (обязательно для заполнения)</p>
        <p></p>

        {{-- -------------------- карточка 1 -------------------------------------------- --}}
        <div>
            <img id="preview" class=" img-fluid shadow "
                src="@if ($post->url_foto == null) {{ url('plug.jpg') }}@else{{ url($post->url_foto) }} @endif"
                alt="Фото потерялось">
            @error('foto_1')
                <b class="link-danger ">Ошибка: {{ $message }}</b>
            @enderror
            <input class="form-control" type="file" id="fileInput" name="foto_1">
            <p class="link-danger">Выберите свое фото</p>
            <p id="error_foto_size_1" class="link-danger"></p>
            
            
<textarea id="input_text_2" inf="2" class="form-control" placeholder="Напишите текст под фото" name="text_post_1">
@if($post->text_post != null){{ $post->text_post}}@else{{old('text_post_1')}}@endif
</textarea>
@error('text_post_1')
<b class="link-danger ms-2">Ошибка: {{ $message }}</b>
@enderror
<p>Количество символов: <span id="symbols_count_2"></span></p>

            <p class="link-danger">Напишите текст под фото</p>
            <p></p>
        </div>
            {{-- checkbox 1----------------------------------------------------------------------------------- --}}
            <hr>
            <label>
                @if ($post->url_foto_2 == null && $post->text_post_2 == null)
                    <input type="checkbox" id="toggleCheckbox" name="checkbox_1"> <i id="checkbox_text_1"> Добавить второй
                        блок фото плюс текст </i>
                @else
                    <input type="checkbox" id="toggleCheckbox" name="checkbox_1" checked> <i id="checkbox_text_1"> Убрать второй блок фото плюс текст</i>
                @endif
            </label>
            <br>
            <hr><br>
       
        {{-- -------------------- карточка 2 -------------------------------------------- --}}

        <div id="myDiv" @if ($post->url_foto_2 == null && $post->text_post_2 == null) hidden @endif>
            <img id="preview2" class=" img-fluid shadow "
                src="@if ($post->url_foto_2 == null) {{ url('plug.jpg') }}@else{{ url($post->url_foto_2) }} @endif"
                alt="Фото потерялось">
                @error('foto_2')
                <b class="link-danger ">Ошибка: {{ $message }}</b>
            @enderror
            
            

            <input class="form-control" type="file" id="fileInput2" name="foto_2" >
            <p class="link-danger">Выберите свое фото 2 </p>
            <p id="error_foto_size_2" class="link-danger"></p>
            <br>
<textarea id="input_text_3" inf="3" class="form-control" placeholder="Напишите текст под фото 2" name="text_post_2">
@if($post->text_post_2 != null){{$post->text_post_2}}@else{{old('text_post_2')}}@endif
</textarea>
@error('text_post_2')
<b class="link-danger ms-2">Ошибка: {{ $message }}</b>
@enderror
<p>Количество символов: <span id="symbols_count_3"></span></p>

            <p class="link-danger">Напишите текст под фото 2 </p>
            <p></p>
        </div>
            {{-- checkbox 2----------------------------------------------------------------------------------- --}}
            <hr>
            <label>
                @if ($post->url_foto_3 == null && $post->text_post_3 == null)
                    <input type="checkbox" id="toggleCheckbox2" name="checkbox_2"> <i id="checkbox_text_2"> Добавить третий блок
                        фото плюс текст </i>
                @else
                    <input type="checkbox" id="toggleCheckbox2" name="checkbox_2" checked> <i id="checkbox_text_2"> Убрать третий блок фото плюс текст</i>
                @endif
            </label>
            <br>
            <hr><br>
      

        {{-- -------------------- карточка 3 -------------------------------------------- --}}

        <div id="myDiv2" @if ($post->url_foto_3 == null && $post->text_post_3 == null) hidden @endif>
            <img id="preview3" class=" img-fluid shadow "
                src="@if ($post->url_foto_3 == null) {{ url('plug.jpg') }}@else{{ url($post->url_foto_3) }} @endif"
                alt="Фото потерялось">
                @error('foto_3')
                <b class="link-danger ">Ошибка: {{ $message }}</b>
            @enderror
            <input class="form-control" type="file" id="fileInput3" name="foto_3">
            <p class="link-danger">Выберите свое фото 3 </p>
            <p id="error_foto_size_3" class="link-danger"></p>
            
            <br>
<textarea id="input_text_4" inf="4" class="form-control" placeholder="Напишите текст под фото 3" name="text_post_3">
@if ($post->text_post_3 != null){{$post->text_post_3}}@else{{old('text_post_3')}}@endif
</textarea>
@error('text_post_3')
<b class="link-danger ms-2">Ошибка: {{ $message }}</b>
@enderror
<p>Количество символов: <span id="symbols_count_4"></span></p>

            <p class="link-danger">Напишите текст под фото 3 </p>
            <p></p>
        </div>
            {{-- checkbox 3----------------------------------------------------------------------------------- --}}
            <hr>
            <label>
                @if ($post->url_foto_4 == null && $post->text_post_4 == null)
                    <input type="checkbox" id="toggleCheckbox3" name="checkbox_3"> <i id="checkbox_text_3"> Добавить
                        четвертый блок фото плюс текст </i>
                @else
                    <input type="checkbox" id="toggleCheckbox3" name="checkbox_3" checked> <i id="checkbox_text_3">
                        Убрать четвертый блок фото плюс текст</i>
                @endif
            </label>
            <br>
            <hr><br>
        

        {{-- -------------------- карточка 4 -------------------------------------------- --}}
        <div id="myDiv3" @if ($post->url_foto_4 == null && $post->text_post_4 == null) hidden @endif>
            <img id="preview4" class=" img-fluid shadow "
                src="@if ($post->url_foto_4 == null) {{ url('plug.jpg') }}@else{{ url($post->url_foto_4) }} @endif"
                alt="Фото потерялось">
                @error('foto_4')
                <b class="link-danger ">Ошибка: {{ $message }}</b>
            @enderror
            <input class="form-control" type="file" id="fileInput4" name="foto_4">
            <p class="link-danger">Выберите свое фото 4 </p>
            <p id="error_foto_size_4" class="link-danger"></p>
          
            <br>
<textarea id="input_text_5" inf="5" class="form-control" placeholder="Напишите текст под фото 4" name="text_post_4">
@if ($post->text_post_4 != null)
{{$post->text_post_4}}@else{{old('text_post_4')}}@endif
</textarea>
@error('text_post_4')
<b class="link-danger ms-2">Ошибка: {{ $message }}</b>
@enderror
<p>Количество символов: <span id="symbols_count_5"></span></p>

            <p class="link-danger">Напишите текст под фото 4 </p>
            <p></p>
        </div>
            {{-- checkbox 4----------------------------------------------------------------------------------- --}}
            <hr>
            <label>
                @if ($post->url_foto_5 == null && $post->text_post_5 == null)
                    <input type="checkbox" id="toggleCheckbox4" name="checkbox_4"> <i id="checkbox_text_4"> Добавить
                        пятый блок фото плюс текст </i>
                @else
                    <input type="checkbox" id="toggleCheckbox4" name="checkbox_4" checked> <i id="checkbox_text_4">
                        Убрать пятый блок фото плюс текст</i>
                @endif
            </label>
            <br>
            <hr><br>
       

        {{-- -------------------- карточка 5 -------------------------------------------- --}}

        <div id="myDiv4" @if ($post->url_foto_5 == null && $post->text_post_5 == null) hidden @endif>
            <img id="preview5" class=" img-fluid shadow "
                src="@if ($post->url_foto_5 == null) {{ url('plug.jpg') }}@else{{ url($post->url_foto_5) }} @endif"
                alt="Фото потерялось">
                @error('foto_5')
                <b class="link-danger ">Ошибка: {{ $message }}</b>
            @enderror
            <input class="form-control" type="file" id="fileInput5" name="foto_5">
            <p class="link-danger">Выберите свое фото 5 </p>
            <p id="error_foto_size_5" class="link-danger"></p>
            
            <br>
<textarea id="input_text_6" inf="6" class="form-control" placeholder="Напишите текст под фото 5" name="text_post_5">
@if($post->text_post_5 != null){{$post->text_post_5}}@else{{old('text_post_5')}}@endif
</textarea>
@error('text_post_5')
<b class="link-danger ms-2">Ошибка: {{ $message }}</b>
@enderror
<p>Количество символов: <span id="symbols_count_6"></span></p>

            <p class="link-danger">Напишите текст под фото 5 </p>
            <p></p>
            <br>
            <hr><br>
        </div>
            {{-- checkbox 5 ----------------------------------------------------------------------------------- --}}
            <hr>
            <label>
                @if ($post->stuff == null )
                    <input type="checkbox" id="toggleCheckbox5" name="checkbox_5"> <i id="checkbox_text_5"> Добавить
                        видео в пост </i>
                @else
                    <input type="checkbox" id="toggleCheckbox5" name="checkbox_5" checked> <i id="checkbox_text_5">
                        Убрать видео из поста </i>
                @endif
            </label>
            <hr>
        {{-- -------------------- карточка 6 видео -------------------------------------------- --}}

        <div id="myDiv5" @if ($post->stuff == null ) hidden @endif>
            <div class="ratio ratio-16x9">
                <iframe class="rounded" id="preview-iframe" src="@if($post->stuff != null)https://www.youtube.com/embed/{{$post->stuff}}@endif" 
                title="YouTube video" allowfullscreen style="background-image: url('{{ url('video.jpg') }}')"></iframe>
              </div>
            <input class="form-control" type="text" id="youtube-url" inf="7" name="video_url" placeholder="вставте адрес видео с ютуба" >
            <p class="link-danger">Выберите видео с ютуба </p>
            <br>
<textarea id="input_text_8" inf="8" class="form-control" placeholder="Напишите текст под видео" name="text_post_6"></textarea>
@error('text_post_6')
<b class="link-danger ms-2">Ошибка: {{ $message }}</b>
@enderror
<p>Количество символов: <span id="symbols_count_8"></span></p>

            <p class="link-danger">Напишите текст под видео </p>
            <p></p>
            <br>
            <hr><br>
        </div>
        {{-- ----------------кнопки------------------------------------------------------------------------- --}}

        <button class="btn btn-primary " title="Сохранить чтоб потом дописать" type="submit">Сохранить пост</button>
    </form>
    <hr>
    <a class="btn btn-primary" href="{{ route('channel2', $post->id) }}" target="_blank">Посмотреть как выглядит пост</a>
    <hr>

    {{-- окончание условия, сам иф почти вначале поста --}}
@else  <h3 class="text-center mt-5">У вас нет еще ни одного поста ¯\_(ツ)_/¯</h3>  
    @endif

    {{-- ==================  JS  ======================================================================================= --}}
    <script>
        const checkbox = document.getElementById('toggleCheckbox');
        const checkbox2 = document.getElementById('toggleCheckbox2');
        const checkbox3 = document.getElementById('toggleCheckbox3');
        const checkbox4 = document.getElementById('toggleCheckbox4');
        const checkbox5 = document.getElementById('toggleCheckbox5');
        const div = document.getElementById('myDiv');
        const div2 = document.getElementById('myDiv2');
        const div3 = document.getElementById('myDiv3');
        const div4 = document.getElementById('myDiv4');
        const div5 = document.getElementById('myDiv5');

        checkbox.addEventListener('change', function() { // Обработчик события для чекбокса 1
            let checkbox_text_1 = document.getElementById("checkbox_text_1");
            if (checkbox.checked) {
                div.removeAttribute('hidden');
                checkbox_text_1.textContent = ' Убрать второй блок фото плюс текст';
            } else {
                div.setAttribute('hidden', true); // при закрытии закрываем и другие карточки
                checkbox_text_1.textContent = ' Добавить второй блок фото плюс текст';
            }
        });
        //--------------------------------------------------------------------
        checkbox2.addEventListener('change', function() { // Обработчик события для чекбокса 2
            let checkbox_text_2 = document.getElementById("checkbox_text_2");
            if (checkbox2.checked) {
                div2.removeAttribute('hidden');
                checkbox_text_2.textContent = ' Убрать третий блок фото плюс текст';
            } else {
                div2.setAttribute('hidden', true);
                checkbox_text_2.textContent = ' Добавить третий блок фото плюс текст';
            }
        });
        //--------------------------------------------------------------------
        checkbox3.addEventListener('change', function() { // Обработчик события для чекбокса 3
            let checkbox_text_3 = document.getElementById("checkbox_text_3");
            if (checkbox3.checked) {
                div3.removeAttribute('hidden');
                checkbox_text_3.textContent = ' Убрать четвертый блок фото плюс текст';
            } else {
                div3.setAttribute('hidden', true);
                checkbox_text_3.textContent = ' Добавить четвертый блок фото плюс текст';
            }
        });
        //--------------------------------------------------------------------
        checkbox4.addEventListener('change', function() { // Обработчик события для чекбокса 4
            let checkbox_text_4 = document.getElementById("checkbox_text_4");
            if (checkbox4.checked) {
                div4.removeAttribute('hidden');
                checkbox_text_4.textContent = ' Убрать пятый блок фото плюс текст';
            } else {
                div4.setAttribute('hidden', true);
                checkbox_text_4.textContent = ' Добавить пятый блок фото плюс текст';
            }
        });
                //--------------------------------------------------------------------
                checkbox5.addEventListener('change', function() { // Обработчик события для чекбокса 5
                    console.log('dgdfg');
            let checkbox_text_5 = document.getElementById("checkbox_text_5");
            if (checkbox5.checked) {
                div5.removeAttribute('hidden');
                checkbox_text_5.textContent = ' Убрать видео из поста';
            } else {
                div5.setAttribute('hidden', true);
                checkbox_text_5.textContent = ' Добавить видео в пост';
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
// ============ считаем и выводим количество символов в инпутах ====================================================================================
window.addEventListener('input', function(event) { // при вводе в любой инпут меняем счетчик 
if(event.target.type != 'checkbox'){  // не реагируем на инпут чекбоксов
  let inf = event.target.getAttribute('inf');
    let symbols_count = document.getElementById('symbols_count_'+inf);
    const text = event.target.value.length; // Получаем текст из поля ввода
    symbols_count.textContent = text; // Обновляем счетчик символо
}  
});
// -------------------------------------------------------------------------------------
document.addEventListener('DOMContentLoaded', function () {  // код срабатывает 1 раз при загрузке страницы
    for (let i = 1; i <= 6; i++) {  // считаем количество текста в инпутах и выводим под инпутами (i <= 2; меняем под количество инпутов)
    const input_text = document.getElementById('input_text_'+i);
    const symbols_count = document.getElementById('symbols_count_'+i);
    const text = input_text.value; // Получаем текст из поля ввода
    symbols_count.textContent = text.length; // Обновляем счетчик символов
    }
});
// ================ предпросмотр видео ютуб с двух форматов ссылок =================================================================================
document.getElementById('youtube-url').addEventListener('input', showPreview);

function showPreview() {
    // Получаем URL из поля ввода
    const url = document.getElementById('youtube-url').value;
    
    // Обновленное регулярное выражение для поддержания обоих форматов ссылок
    const regex = /(?:https?:\/\/(?:www\.)?youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*\?v=))([\w-]+)|(?:https?:\/\/youtu\.be\/)([\w-]+)/;
    const match = url.match(regex);
    
    if (match) {
        // Если ссылка обычного формата youtube.com
        const videoId = match[1] || match[2];
        const iframe = document.getElementById('preview-iframe');
        iframe.src = `https://www.youtube.com/embed/${videoId}`;
    } else {
        // Если ссылка некорректная, очищаем iframe
        document.getElementById('preview-iframe').src = '';
    }
}
    </script>
@endsection
