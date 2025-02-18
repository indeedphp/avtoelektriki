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
                    <a class="nav-link" href="{{ route('cabinet_new_post') }}">Новый пост</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-danger" href="{{ route('cabinet_all_post') }}">Все посты</a>
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


    @foreach ($posts as $post)
        <div class="card my-2">
 
            <div class="card-body p-1">

                <div class="row ">

                    <div class="col-4 p-0  ">
                        <img class=" img-fluid ps-3 p-0" src="{{$post->url_foto}}" alt="Фото потерялось">
                    </div>
                    <div class="col-8 d-sm-none"><b>{{Str::limit($post->name_post, 25)}}</b>
                        
                        {{Str::limit($post->text_post, 40)}}
                    </div>
                    <div class="col-8 d-none d-sm-block"><b>{{$post->name_post}}</b>
                        
                        <p>{{Str::limit($post->text_post, 300)}}</p>
                    </div>
                </div>
            </div>
            <div class="card-footer text-muted p-1">
                <div class="float-start ms-2 p-0">
                     <form method="POST" action="{{ route('cabinet_all_post_delete', $post->id) }}">
                         @method('DELETE') @csrf <button class="btn btn-sm p-0">Удалить</button></form> 
                     </div>
                <div class="float-end me-2 p-0" ><a class="btn btn-sm p-0" href="{{ route('cabinet_all_post_edit', $post->id) }}">Редактировать</a></div>
            </div>
        </div>
    @endforeach
@endsection



{{-- 'created_at',
'updated_at',
'user_name',
'name_post',
'id_user',
'id_post',
'date',
'text_post',
'url_foto',
'text_post_2',
'url_foto_2',
'text_post_3',
'url_foto_3',
'stuff', --}}
