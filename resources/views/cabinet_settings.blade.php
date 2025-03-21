@extends('layouts/main')



@section('posts')
    <x-nav-cabinet /> {{-- вставляем навигацию --}}
    <div class="row px-1">

        <hr class="mt-2">
        {{-- ----------- выход с сайта-------------------------------------------------------------------------------- --}}
        <div class=""> <a class="btn btn-primary btn-sm px-3 me-2" href="{{ route('logout') }}">Выход</a> <label
                class="form-label">Выход с сайта</label> </div>

        {{-- ---------------- меняем имя пользователя----------------------------------------------------------------- --}}
        <hr>
        <div class="my-1"> <b>Ваше имя пользователя: {{ $user->name }}</b> </div>
        <form action="{{ route('cabinet_settings_edit_name') }}" method="POST">
            @csrf
            @method ('PUT')
            <label class="form-label ">Вы можете изменить свое имя пользователя тут, минимум 4 символа и максимум
                20</label>
            <input inf="1" maxlength="20" class="form-control my-1" type="text" name="new_name" placeholder = "Введите новое имя">
            @error('new_name')
                <b class="link-danger ">Ошибка: {{ $message }}</b>
            @enderror
            <p>Введено символов: <span id="symbols_count_1">0</span></p>
            <input class="btn btn-primary btn-sm my-1" type="submit">
        </form>

        <hr>

        {{-- ---------------- меняем логин ------------------------------------------------------------------------------------ --}}
        <form action="{{ route('cabinet_settings_edit_login') }}" method="POST">
            @csrf
            @method ('PUT')
            <label class="form-label ">Вы можете изменить свой логин, минимум 8 символов и максимум 20</label>
            <input inf="2" maxlength="20" class="form-control my-1" type="text" name="new_login" placeholder = "Введите новый логин">
            @error('new_login')
                <b class="link-danger ">Ошибка: {{ $message }}</b>
            @enderror
            <p>Введено символов: <span id="symbols_count_2">0</span></p>
            <input class="btn btn-primary btn-sm my-1" type="submit">
        </form>
        <hr>
        {{-- ------------------ меняем пароль -------------------------------------------------------------------------------------------- --}}
        <form action="{{ route('cabinet_settings_edit_password') }}" method="POST">
            @csrf
            @method ('PUT')
            <label class="form-label ">Вы можете изменить свой пароль, минимум 8 символов и максимум 20</label>
            <input inf="3" maxlength="20" class="form-control my-1" type="text" name="new_password" placeholder = "Введите новый пароль">
            @error('new_password')
                <b class="link-danger ">Ошибка: {{ $message }}</b>
            @enderror
            <p>Введено символов: <span id="symbols_count_3">0</span></p>
            <input class="btn btn-primary btn-sm my-1" type="submit">
        </form>
        <hr>

        {{-- <p>Запретить боту выдачу одноразовых ссылок для входа</p>
        <P>Запретить боту возможность cмены пароля на сайте</P> --}}

        {{-- ---------------- меняем _sity ------------------------------------------------------------------------------------ --}}
        <form action="{{ route('cabinet_settings_edit_sity') }}" method="POST">
            @csrf
            @method ('PUT')
            <label class="form-label ">Вы можете изменить свой город, минимум 2 символа и максимум 30</label>
            <input inf="6" maxlength="30" class="form-control my-1 " type="text" name="new_sity" placeholder = "Введите название города">
            @error('new_sity')
                <b class="link-danger ">Ошибка: {{ $message }}</b>
            @enderror
            <p>Введено символов: <span id="symbols_count_6">0</span></p>
            <input class="btn btn-primary btn-sm my-1" type="submit">
        </form>
        <hr>


{{-- ----------- меняем цвет полосы канала и текста -------------------------------------------------------------------------------------------- --}}
        <form class="user-select-none" action="{{ route('cabinet_settings_edit_color_channel') }}" method="POST">
            @csrf
            @method ('PUT')
            
           <input id="input_palette" type="hidden" name="color_channel" value="776300">
           <p class="form-label ">меняем цвет полосы канала и текста</p>
            <canvas  id="palette" height="50"></canvas>
            <div class="ps-2 border" id="color_result" style="width: 300px; height: 50px;">выбранный цвет <div class="text-white">выбранный цвет</div> </div>
            <p class="link-danger">Выберите цвет верхней полосы канала</p>
            <input type="radio" name="color_text" value="0" checked> 
            <label class="">Цвет текста черный</label>
            <br>
            <input type="radio" name="color_text" value="1">
            <label class="">Цвет текста белый</label>
            <br>
            <input class="btn btn-primary btn-sm my-1" type="submit">
        </form>
        

        {{-- ---------- меняем описание канала -------------------------------------------------------------------------- --}}
        <hr>
        <form action="{{ route('cabinet_settings_edit_definition_channel') }}" method="POST">
            @csrf
            @method ('PUT')
            <label class="form-label ">Вы можете поменять описание канала, максимальная длина 100 символов</label>
            <input inf="4" maxlength="100" class="form-control my-1" type="text" name="definition_channel" placeholder = "Введите описание">
            @error('definition_channel')
                <b class="link-danger ">Ошибка: {{ $message }}</b>
            @enderror
            <p>Введено символов: <span id="symbols_count_4">0</span></p>
            <input class="btn btn-primary btn-sm my-1" type="submit">
        </form>

        <hr>

        {{-- ------- меняем название канала ------------------------------------------------------------------------------------- --}}
        <form action="{{ route('cabinet_settings_edit_name_channel') }}" method="POST">
            @csrf
            @method ('PUT')
            <label class="form-label ">Вы можете поменять название канала, максимальная длина 40 символов</label>
            <input inf="5" maxlength="40" class="form-control my-1" type="text" name="name_channel" placeholder = "Введите описание"
                value="{{ old('name_channel') }}">
            @error('name_channel')
                <b class="link-danger ">Ошибка: {{ $message }}</b>
            @enderror
            <p>Введено символов: <span id="symbols_count_5">0</span></p>
            <input class="btn btn-primary btn-sm my-1" type="submit">
        </form>
        <hr>


    </div>

    <footer class="" ;>
        <div class="p-2">
            <span class=" ">© 2024 Company, Inc</span>
        </div>
    </footer>


<script>
    // ============ считаем и выводим количество символов в инпутах ====================================================================================
    window.addEventListener('input', function(event) { // при вводе в любой инпут меняем счетчик 
        console.log(event.target.type);
    if(event.target.type != 'radio'){  // не реагируем на инпут radio
      let inf = event.target.getAttribute('inf');
        let symbols_count = document.getElementById('symbols_count_'+inf);
        const text = event.target.value.length; // Получаем текст из поля ввода
        symbols_count.textContent = text; // Обновляем счетчик символо
    }  
    });
    // ===========================================================================================================================
        const color_result = document.getElementById('color_result');
        const input_palette = document.getElementById('input_palette');
        const canvas = document.getElementById('palette');
        const ctx = canvas.getContext('2d', { willReadFrequently: true });
        const colorValue = document.getElementById('colorValue');

        function createGradient() { // Создание градиента на canvas
            const gradient = ctx.createLinearGradient(0, 0, canvas.width, 0);
            gradient.addColorStop(0.3, 'white'); // белый цвет
            gradient.addColorStop(1, 'black'); // черный цвет
            gradient.addColorStop(0, 'red');
            gradient.addColorStop(1 / 6, 'orange');
            gradient.addColorStop(1 / 6, 'orange');
            gradient.addColorStop(2 / 6, 'yellow');
            gradient.addColorStop(3 / 6, 'green');
            gradient.addColorStop(4 / 6, 'blue');
            gradient.addColorStop(5 / 6, 'indigo');
            gradient.addColorStop(1, 'violet');
            ctx.fillStyle = gradient; // Заполнение холста градиентом
            ctx.fillRect(0, 0, canvas.width, canvas.height);
        }
        // Функция для получения цвета по координатам на canv
        function getColorUnderCursor(event) {
            const x = event.offsetX;
            const y = event.offsetY;
            // Получаем цвет пикселя в точке (x, y)
            const pixel = ctx.getImageData(x, y, 1, 1).data;
            // Преобразуем rgba в формат hex
            const hexColor = `#${(1 << 24 | (pixel[0] << 16) | (pixel[1] << 8) | pixel[2]).toString(16).slice(1).toUpperCase()}`;
            // передаем в скрытый инпут
            input_palette.value = hexColor;
            // Меняем фон на выбранный цвет
            color_result.style.backgroundColor = hexColor;
        }
        // Заполнение канваса градиентом
        createGradient();
        // Обработчик клика на canvas
        canvas.addEventListener('click', getColorUnderCursor);
</script>



@endsection
