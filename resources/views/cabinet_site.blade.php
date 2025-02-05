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


    
            
            <p> Ваш сайт уже создан, только укажите свой номер телефона, посмотреть как выглядит сайт можно  <a class="" href="{{ route('site_show')}}" target="_blank">нажав тут</a>
            </p>
            <hr>
            <form method="POST">
                @csrf
                <div class="card card-body p-1 " id="div_name_post" contenteditable="true"
                    data-placeholder=" Напишите комментарий"></div>
                <p class="link-danger">Напишите чем занимаетесь и где, в два-три слова например"Автоэлектрики Алматы"</p>
                <p></p>
    
                <div class="card card-body p-1 " id="div_name_post" contenteditable="true"
                data-placeholder=" Напишите комментарий"> </div>
            <p class="link-danger">Напишите номер телефона для контактов, пример +70000000000</p>
            <p></p>
            <hr>
            <div class="card card-body p-1 " id="div_name_post" contenteditable="true"
            data-placeholder=" Напишите комментарий">  </div>
        <p class="link-danger">Напишите коротко главные направления деятельности например "Срочный выезд для запуска автомобиля, диагностика на выезде, заправка и ремонт кондиционера и пр."</p>
        <p></p>
        <hr>
        <div class="card card-body p-1 " id="div_name_post" contenteditable="true"
        data-placeholder=" Напишите комментарий"> </div>
    <p class="link-danger">Напишите заголовок карточки вида работ</p>
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




    {{-- <div class="container-fluid fixed-top p-2 rounded  mr-3  " style="background-color : #1D1274" ;="">
        <div class="row ">
          <div class="col-sm-6 d-flex justify-content-center">
           <h4 class="text-white">Автоэлектрика в Алматы</h4>
         </div>
         <div class="col-sm-6 d-flex justify-content-center">
          <h4 class=" text-white"> <a class=" text-white" href="tel:+77074751000" rel="nofollow"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
            <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"></path>
          </svg> +7-(707)-475-10-00</a></h4>
        </div>
  
      </div>
    </div> --}}





{{-- 
    <div class="card mb-4 rounded-3 shadow-sm border-dark ">
        <div class="card-header py-3 " style="background-color : #418BC6" ;="">
          <h4 class="my-0 fw-normal ">Не запускается автомобиль?</h4>
        </div>
        <div class="card-body">
          <img src="1.jpg" height="300" class="rounded  mr-3">
          <table class="table table-striped ">
            <thead>
              <tr><th><h5 class="text-center">Частые обращения к нам</h5></th></tr>
            </thead>
            <tbody>
             <tr><td>Машина стояла и не запускается</td></tr>
             <tr><td>На заправке остановились и не заводится</td> </tr>
             <tr><td>Сходили в магазин и нет запуска</td> </tr>
             <tr><td>Дети что то включили и все</td> </tr>
           </tbody>
         </table>
         Частые ситуации с которыми нам приходится иметь дело, звоните разберемся обязательно.
       </div>
     </div> --}}