@extends('layouts/main') 



@section('posts') 

<nav class="navbar navbar-expand-lg  p-0 pe-2">
 
    <a class="navbar-brand ps-3">Кабинет пользователя:</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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

<form  method="POST">
    @csrf
    <input type="hidden" name="post_id" value="{{$post->id}}">
  <div class="card card-body p-1 " id="div_name_post" contenteditable="true"
  data-placeholder=" Напишите комментарий">  {{ $post->name_post}}</div>
  <p class="link-danger">Правим название поста</p>
  <p></p>

  <img class=" img-fluid shadow " src="{{ url($post->url_foto) }}" alt="Фото потерялось">
  <p class="link-danger">Фото 1</p>
  <input class="form-control" type="file" name="foto_1">
  <p class="link-danger">Изменить фото 1</p>
  <p></p>
  <div class="card card-body p-1 " id="div_text_post" contenteditable="true"
  data-placeholder=" Напишите комментарий">  {{ $post->text_post}}</div>
  <p class="link-danger">Правим текст под фото 1</p>
  <p></p>
  <br>
  <hr>

@if ($post->url_foto_2 !== null)
  <img class=" img-fluid shadow " src="{{ url($post->url_foto_2) }}" alt="Фото потерялось">
  <p class="link-danger">Фото 2</p>
  <input class="form-control" type="file" name="foto_2">
  <p class="link-danger">Изменить фото 2</p>
  <p></p>
  <div class="card card-body p-1 " id="div_text_post_2" contenteditable="true"
  data-placeholder=" Напишите комментарий">  {{ $post->text_post_2}}</div>
  <p class="link-danger">Правим текст под фото 2</p>
  <p></p>
  <br>
@endif
  <hr>
  @if ($post->url_foto_2 !== null)
  <img class=" img-fluid shadow " src="{{ url($post->url_foto_3) }}" alt="Фото потерялось">
  <p class="link-danger">Фото 3</p>
  <input class="form-control" type="file" name="foto_3">
  <p class="link-danger">Изменить фото 3</p>
  <p></p>
  <div class="card card-body p-1 " id="div_text_post_3" contenteditable="true"
  data-placeholder=" Напишите комментарий">  {{ $post->text_post_3}}</div>
  <p class="link-danger">Правим текст под фото 3</p>
  <p></p>
  <br>
  <br>@endif
  <div class="row">
    
    <button class="btn btn-primary " title="Отправить"
        type="submit">Сохранить изменения поста</button>
  </div>
</form>
<p></p>

<br> <br> <br>

  {{-- {{json_encode($post)}} --}}





@endsection 


<script>

document.addEventListener('submit', function (event) {
    event.preventDefault();
    const formData = new FormData(event.target);
    let div_text_post_2 = null;
    if (document.getElementById("div_text_post_2")) div_text_post_2 = event.target.querySelector('#div_text_post_2').textContent;
    let div_text_post_3 = null;
    if (document.getElementById("div_text_post_3")) div_text_post_3 = event.target.querySelector('#div_text_post_3').textContent;



    let div_name_post = event.target.querySelector('#div_name_post');
    let div_text_post = event.target.querySelector('#div_text_post');


                formData.append("name_post", div_name_post.textContent);
                formData.append("text_post", div_text_post.textContent);
                formData.append("text_post_2", div_text_post_2);
                formData.append("text_post_3", div_text_post_3);

              
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