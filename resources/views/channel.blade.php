<!DOCTYPE html>

<html lang="ru">

<head>
    <meta charset="utf-8">
    <title>Автоэлектрики</title>
    <link rel="shortcut icon" href="favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Профпортал Автоэлектрики">
    
    <script src="{{ url('bootstrap.bundle.js') }} " integrity="" crossorigin="anonymous"></script>
    <link href="{{ url('bootstrap.css') }}" rel="stylesheet">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
rel="stylesheet" -->
    <link rel="stylesheet" href="{{ url('bootstrap-icons-1.10.5/font/bootstrap-icons.min.css') }}">
    <style>
        /* body { overflow-x: hidden; } */
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 ">

            </div>
            <div class="col p-1 p-lg-avto">

                <nav class="navbar navbar-expand-lg  fixed-top navbar bg-primary" data-bs-theme="dark">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#">Автоэлектрики</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Переключатель навигации">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse right-aligned-div" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 ">
                                <li class="nav-item ms-auto">
                                    @guest
                                        <a class="nav-link active " href="{{ route('register') }}">Привествуем гость!</a>
                                    @endguest
                                    @auth
                                        <a class="nav-link active ">Привествуем {{ Auth::user()->user_name }} !</a>
                                    @endauth
                                </li>
                                <li class="nav-item ms-auto">
                                    @auth
                                        <a class="nav-link active " aria-current="page" href="#">Главная</a>
                                    @endauth
                                    @guest
                                        <a class="nav-link active " href="{{ route('login') }}">Вход</a>
                                    @endguest
                                </li>
                                <li class="nav-item ms-auto">
                                    @guest
                                        <a class="nav-link active " href="{{ route('register') }}">Регистрация</a>
                                    @endguest
                                    @auth
                                        <a class="nav-link active " href="{{ route('logout') }}">Выход</a>
                                    @endauth
                                </li>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

                <div class=" my-3 py-3"></div> {{-- отодвигатор --}}



                <!-- <img src="storage/app/bot/images/7124124425-1735118651.jpg" class="img-fluid" alt="..."> -->
                <div id='wrapper'>
<p>логин 2183900510@5303500659 пароль 5303500659  бот @sky_bob_bot</p>
                    @foreach ($posts as $post)
                        <div class="card  mb-3  shadow ">
                            <div class=" card-header text-muted py-1 p-lg-3">
                                <div class="row">
   
                                    <div class="col-auto me-auto p-0 "><i class="bi bi-clock p-lg-1" value="www">
                                        </i>@php echo date('d-m-Y', strtotime($post->created_at)); @endphp </div>

                                    <div class="col-auto p-0"> <a class="link-underline-light" href="#"> <i
                                                class="bi bi-geo-alt" value="www"></i>{{ 'Алматы' }}</a> </div>

                                    <div class="col-auto p-0 ps-1 px-lg-3 "> <a class="link-underline-light"
                                            href="#collapseExample1"><i class="bi bi-universal-access ms-auto"
                                                value="www"></i>{{ $post->user_name }} </a> </div>


                                </div>
                            </div>
                            <div class="card-body px-1 px-lg-5 py-1">
                                <h5 class="card-title">{{ $post->name_post }}</h5>
                                <div class="card-body px-0 mx-lg-5 px-lg-5 py-0">
                                    <div class="card-body px-0 mx-lg-5 px-lg-5 py-0">
                                        <img class=" img-fluid shadow " src=" {{ url($post->url_foto ) }} "
                                            alt="Фото потерялось">
                                    </div>
                                </div>


                                <div class="card-text"> {{ $e = Str::limit($post->text_post, 300) }}
                                    <a class="link-underline-light p-0" href="#collapseExample1"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseExample{{ $post->id }}{{ $loop->iteration }}"
                                        aria-expanded="false" aria-controls="collapseExample"> развернуть </a>
                                </div>

                                <div class="collapse p-0"
                                    id="collapseExample{{ $post->id }}{{ $loop->iteration }}">
                                    <div class=" p-1">


                                        <div class="card-text"> {{ '...' }}
                                            {{ Str::unwrap($post->text_post, Str::before($e, '...')) }}
                                        </div>
                                        @if ($post->url_foto_2 !== null)
                                            <div class="card-body px-0 mx-lg-5 px-lg-5 py-0">
                                                <div class="card-body px-0 mx-lg-5 px-lg-5 py-0">
                                                    <img class=" img-fluid shadow " src="{{ $post->url_foto_2 }}"
                                                        alt="Фото потерялось">
                                                </div>
                                            </div>
                                            <p class="card-text"> {{ $post->text_post_2 }}</p>
                                        @endif
                                        @if ($post->url_foto_3 !== null)
                                            <div class="card-body px-0 mx-lg-5 px-lg-5 py-0">
                                                <div class="card-body px-0 mx-lg-5 px-lg-5 py-0">
                                                    <img class=" img-fluid shadow " src="{{ $post->url_foto_3 }}"
                                                        alt="Фото потерялось">
                                                </div>
                                            </div>
                                            <p class="card-text "> {{ $post->text_post_3 }} <a
                                                    class="link-underline-light p-0" href="#collapseExample1"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#collapseExample{{ $post->id }}{{ $loop->iteration }}"
                                                    aria-expanded="false" aria-controls="collapseExample"> &nbsp &nbsp
                                                    свернуть </a></p>
                                        @endif

                                    </div>
                                </div>
                            </div>






                            <div class="card-footer text-muted p-0 m-0 p-lg-3 ">
                                <div class="row">
                                    <!-- ЛАЙК "bi bi-hand-thumbs-up-fill"-->
                                    <div class="col-auto pe-2">&nbsp;<a class="link-underline-light"
                                            title="Поставить лайк" style="cursor: pointer;"> <i
                                                id='butlike{{ $post->id }}' value="1"
                                                post_id="{{ $post->id }}"
                                                class="
                                              @if ($post->post_like_active) {{ 'bi bi-hand-thumbs-up-fill' }} 
                                                 @else
                                                  {{ 'bi bi-hand-thumbs-up' }} @endif 
                                                 ">
                                                {{ $post->post_like_count }}</i></a>
                                    </div>
                                    <!-- РЕПОСТ -->
                                    <div class="col-auto me-auto p-0">
                                        <a class="link-underline-light" title="Репост" href="#collapseExample1"
                                            data-bs-toggle="collapse" data-bs-target="#collapse{{ $post->id }}"
                                            aria-expanded="false" aria-controls="collapseExample">
                                            <i class="bi bi-share" value="www"></i></i>
                                            Поделится
                                        </a>
                                    </div>
                                    <!-- КОМЕНТАРИИ КНОПКА -->
                                    <div class="col-auto ">
                                        <a class="link-underline-light p-0" title="Написать, прочитать комментарии"
                                            href="#collapseExample1" data-bs-toggle="collapse"
                                            data-bs-target="#collapseExample{{ $post->id }}"
                                            aria-expanded="false" aria-controls="collapseExample"><i
                                                class="bi bi-chat-dots" value="www"></i></i> Коментарии
                                            <i id="comm_count{{ $post->id }}">{{ $post->post_comment_count }}</i>&nbsp;</a>
                                    </div>
                                </div>

                                {{-- РЕПОСТЫ  ===================================================================================================================================================== --}}
                                <div class="collapse py-0" id="collapse{{ $post->id }}">
                                    <div class="card card-body px-3 py-1">
                                        <div class="row p-0">
                                            <div class="col-auto px-1"><a class="link-underline-light"
                                                    href="#"> <i class="bi bi-card-text" value="www"> Пост
                                                    </i> {{ $post->id }} </a> </div>
                                            <div class="col-auto px-1"><a class="link-underline-light"
                                                    href="#"> <i class="bi bi-telegram" value="www">
                                                        Телеграмм</i></a> </div>

                                            <div class="col-auto px-1"><a class="link-underline-light"
                                                    href="#"> <i class="bi bi-whatsapp" value="www">
                                                        Whatsapp</i> </a> </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- ФОРМА ВВОДА КОММЕНТАРИЕВ  ===================================================================================================================================================== --}}
                                <div class="collapse p-0" id="collapseExample{{ $post->id }}">
                                    <div class="card card-body p-1 ">
                                        <form post_id="{{ $post->id }}" form_type="1">




                                            <div text_div class="card card-body p-1 " id="text_div_post{{ $post->id }}" contenteditable="true"
                                                data-placeholder="Напишите комментарий"></div>

                                            <div class="row p-1 ">
                                                <div class="col-7 me-auto  flex-fill ">
                                                    <i class="bi bi-emoji-smile h3 " data-bs-toggle="collapse" href="#collapse_post_smile{{ $post->id }}" role="button" aria-expanded="false" aria-controls="collapseExample">  </i>

                                                    <div class="collapse" id="collapse_post_smile{{ $post->id }}">
                                                      
                                                        <span post_id="{{ $post->id }}" class="post_smile">😀</span>
                                                        <span post_id="{{ $post->id }}" class="post_smile">👍</span>
                                                        <span post_id="{{ $post->id }}" class="post_smile">👌</span>
                                                        <span post_id="{{ $post->id }}" class="post_smile">😂</span>
                                                        <span post_id="{{ $post->id }}" class="post_smile">😎</span>
                                                        <span post_id="{{ $post->id }}" class="post_smile">😇</span>
                                                        <span post_id="{{ $post->id }}" class="post_smile">😝</span>
                                                        
                                                            <span post_id="{{ $post->id }}" class="post_smile">👎</span>
                                                            <span post_id="{{ $post->id }}" class="post_smile">💩</span>
                                                            <span post_id="{{ $post->id }}" class="post_smile">😈</span>
                                                            <span post_id="{{ $post->id }}" class="post_smile">☠</span>
                                                            <span post_id="{{ $post->id }}" class="post_smile">😪</span>
                                                            <span post_id="{{ $post->id }}" class="post_smile">😬</span>
                                                            <span post_id="{{ $post->id }}" class="post_smile">😭</span>
                                                      
                                                    </div>
                                                </div>
                                                <div class="col-auto p-0 pe-2 pt-1">
                                                    <button class="btn btn-primary btn-sm" title="Отправить"
                                                        type="submit">Отправить</button>
                                                </div>
                                            </div>
                                        </form>


                                        {{-- КОМЕНТАРИИ ===================================================================================================================================================== --}}
                                        <div id='comments{{ $post->id }}' class="overflow-x-hidden p-0  "
                                            style="max-height: 300px;">
                                            @foreach ($post->comment_plus as $comment)
                                                <div id="one_comment{{ $comment->id }}">
                                                    <div class="card mb-2 p-0 m-0">
                                                        <div class="card-header p-0 ">
                                                            <div class="row">
                                                                <div class="col-auto me-auto pe-0 flex-fill">
                                                                    &nbsp; <b class="small">{{ $comment->user_name }}
                                                                    </b>
                                                                </div>
                                                                <div class="col-auto  ps-0">
                                                                    <nobr class="small"> @php
                                                                        echo date(
                                                                            'd.m.Y',
                                                                            strtotime($comment->created_at),
                                                                        );
                                                                    @endphp </nobr>
                                                                    &nbsp;
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <ul class="list-group list-group-flush p-0">
                                                            <li id="comment_text{{ $comment->id }}" class="list-group-item p-0">
                                                                    {{ $comment->comment }}
                                                            </li>
                                                            <li class="list-group-item p-0">
                                                                <div class="row small">
                                                                    <div class="col-auto me-auto pe-0 flex-fill">
                                                                        {{-- ЛАЙК ДИЗЛАЙК КОМЕНТ==========================================================================    --}}


                                                                        <i class="
                                                                        @if ($comment->comment_like_active) {{ 'bi bi-hand-thumbs-up-fill' }} 
                                                                           @else
                                                                            {{ 'bi bi-hand-thumbs-up' }} @endif "
                                                                            style="cursor: pointer;" value="3"
                                                                            comment_id="{{ $comment->id }}">
                                                                            {{ $comment->comment_like_count }}</i>&nbsp;
                                                                        <i class="
                                                                            @if ($comment->comment_dislike_active) {{ 'bi bi-hand-thumbs-down-fill' }} 
                                                                               @else
                                                                                {{ 'bi bi-hand-thumbs-down' }} @endif "
                                                                            style="cursor: pointer;" value="4"
                                                                            comment_id="{{ $comment->id }}">
                                                                            {{ $comment->comment_dislike_count }}</i>
                                                                    </div>
                                                                    <div class="col-auto  ps-0">

                                                                        @auth
                                                                            @if ($comment->id_user == Auth::user()->name)
                                                                                <a class="link-underline-light p-0"
                                                                                    data-bs-toggle="collapse"
                                                                                    href="#coment_collapse{{ $comment->id }}"
                                                                                    role="button" aria-expanded="false"
                                                                                    aria-controls="collapseExample"
                                                                                    title="Редактировать, удалить комментарий"
                                                                                    style="cursor: pointer;">изменить
                                                                                </a>
                                                                            @endif
                                                                        @endauth
                                                                        <a class="link-underline-light p-0"
                                                                            data-bs-toggle="collapse"
                                                                            href="#coment_reply_collapse{{ $comment->id }}"
                                                                            role="button" aria-expanded="false"
                                                                            aria-controls="collapseExample"
                                                                            title="Редактировать, удалить комментарий"
                                                                            style=" cursor: pointer;"> &ensp; ответить
                                                                        </a>

                                                                    </div>
                                                                </div>
                                                            </li>

                                                        </ul>
                                                    </div>

                                                    <!-- \\\\\\\\\\\\\\\\\\\\\\\\ ФОРМА ОТВЕТА НА КОММЕНТАРИИ ==================================================================================== -->
                                                    <div class="collapse"
                                                        id="coment_reply_collapse{{ $comment->id }}">
                                                        <div class="card card-body p-1">

                                                            <form form_type="4" coment_id="{{ $comment->id }}"
                                                                reply_id="0">
                                                                <div text_div  class="card card-body p-1 m-0" id="text_div_comment{{ $comment->id }}"
                                                                    contenteditable="true"
                                                                    data-placeholder="Напишите ваш ответ">
                                                                    {{ $comment->user_name }} &ensp;
                                                                </div>
                                                                <div class="row p-1 ">
                                                                    <div class="col-7 me-auto  flex-fill ">

                                                                        <i class="bi bi-emoji-smile h3 " data-bs-toggle="collapse" href="#collapse_comment_smile{{ $comment->id }}" role="button" aria-expanded="false" aria-controls="collapseExample">  </i>

                                                                        <div class="collapse" id="collapse_comment_smile{{ $comment->id }}">
                                                                          
                                                                            <span comment_id="{{ $comment->id }}" class="comment_smile">😀</span>
                                                                            <span comment_id="{{ $comment->id }}" class="comment_smile">👍</span>
                                                                            <span comment_id="{{ $comment->id }}" class="comment_smile">👌</span>
                                                                            <span comment_id="{{ $comment->id }}" class="comment_smile">😂</span>
                                                                            <span comment_id="{{ $comment->id }}" class="comment_smile">😎</span>
                                                                            <span comment_id="{{ $comment->id }}" class="comment_smile">😇</span>
                                                                            <span comment_id="{{ $comment->id }}" class="comment_smile">😝</span>
                                                                            
                                                                                <span comment_id="{{ $comment->id }}" class="comment_smile">👎</span>
                                                                                <span comment_id="{{ $comment->id }}" class="comment_smile">💩</span>
                                                                                <span comment_id="{{ $comment->id }}" class="comment_smile">😈</span>
                                                                                <span comment_id="{{ $comment->id }}" class="comment_smile">☠</span>
                                                                                <span comment_id="{{ $comment->id }}" class="comment_smile">😪</span>
                                                                                <span comment_id="{{ $comment->id }}" class="comment_smile">😬</span>
                                                                                <span comment_id="{{ $comment->id }}" class="comment_smile">😭</span>
                                                                          
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-auto p-0 pe-2 pt-1">
                                                                        <button class="btn btn-primary btn-sm" title="Ответить"
                                                                            type="submit">Отправить</button>
                                                                    </div>
                                                                </div>
                                                            </form>

                                                        </div>
                                                    </div>

                                                    <!-- ФОРМА ИСПРАВЛЕНИЯ КОММЕНТАРИЕВ ==================================================================================== -->
                                                    <div class="collapse" id="coment_collapse{{ $comment->id }}">
                                                        <div class="card card-body p-1">

                                                            <form form_type="2" coment_id="{{ $comment->id }}">
                                                                <div text_div class="card card-body p-1 m-0" id="text_div_comment_edit{{ $comment->id }}"
                                                                    contenteditable="true"
                                                                    data-placeholder="Напишите новый текст">
                                                                    {{ $comment->comment }}
                                                                </div>
                                                                <div class="row p-1 ">
                                                                    <div class="col-7 me-auto  flex-fill ">

                                                                        <i class="bi bi-emoji-smile h3 " data-bs-toggle="collapse" href="#collapse_comment_edit_smile{{ $comment->id }}" role="button" aria-expanded="false" aria-controls="collapseExample">  </i>

                                                                        <div class="collapse" id="collapse_comment_edit_smile{{ $comment->id }}">
                                                                          
                                                                            <span comment_id="{{ $comment->id }}" class="comment_edit_smile">😀</span>
                                                                            <span comment_id="{{ $comment->id }}" class="comment_edit_smile">👍</span>
                                                                            <span comment_id="{{ $comment->id }}" class="comment_edit_smile">👌</span>
                                                                            <span comment_id="{{ $comment->id }}" class="comment_edit_smile">😂</span>
                                                                            <span comment_id="{{ $comment->id }}" class="comment_edit_smile">😎</span>
                                                                            <span comment_id="{{ $comment->id }}" class="comment_edit_smile">😇</span>
                                                                            <span comment_id="{{ $comment->id }}" class="comment_edit_smile">😝</span>
                                                                            
                                                                                <span comment_id="{{ $comment->id }}" class="comment_edit_smile">👎</span>
                                                                                <span comment_id="{{ $comment->id }}" class="comment_edit_smile">💩</span>
                                                                                <span comment_id="{{ $comment->id }}" class="comment_edit_smile">😈</span>
                                                                                <span comment_id="{{ $comment->id }}" class="comment_edit_smile">☠</span>
                                                                                <span comment_id="{{ $comment->id }}" class="comment_edit_smile">😪</span>
                                                                                <span comment_id="{{ $comment->id }}" class="comment_edit_smile">😬</span>
                                                                                <span comment_id="{{ $comment->id }}" class="comment_edit_smile">😭</span>
                                                                          
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-auto p-0 pe-2 pt-1">
                                                                        <button class="btn btn-primary btn-sm" title="Ответить"
                                                                            type="submit">Изменить</button>
                                                                    </div>
                                                                </div>
                                                            </form>

                                                            <!-- ФОРМА УДАЛЕНИЯ КОММЕНТАРИЕВ ==================================================================================== -->

                                                            <form form_type="3" coment_id="{{ $comment->id }}">
                                                                {{-- <input type="hidden" name="comment_id"
                                                                    value="{{ $comment->id }}"> --}}
                                                                <input name="_method" type="hidden" value="DELETE">
                                                                <button class="btn btn-link m-0 p-0"
                                                                    title="Удаление комментария"
                                                                    type="submit">удалить</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- ----------------------------------------------------------------------------------------------------------------------------Вставляем ответы на комментарии --}}

                                                <div id="reply{{ $comment->id }}">
                                                    @foreach ($comment->reply_comment_plus as $reply)
                                                        <div id="one_reply{{ $reply->id }}">
                                                            <div class="card mb-2 p-0 ms-2">
                                                                <div class="card-header p-0 ">
                                                                    <div class="row">
                                                                        <div class="col-auto me-auto pe-0 flex-fill">
                                                                            &nbsp; <b
                                                                                class="small">{{ $reply->user_name }}
                                                                                @if ($reply->stuff != 0)
                                                                                    ответ {{ $reply->stuff }}
                                                                                @endif
                                                                            </b>
                                                                        </div>
                                                                        <div class="col-auto  ps-0">
                                                                            <nobr class="small"> @php
                                                                                echo date(
                                                                                    'd.m.Y',
                                                                                    strtotime($reply->created_at),
                                                                                );
                                                                            @endphp
                                                                            </nobr>
                                                                            &nbsp;
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <ul class="list-group list-group-flush p-0">                                           
                                                                    <li id="reply_text{{ $reply->id }}"class="list-group-item p-0">
                                                                        {{ $reply->reply }}
                                                                </li>
                                                                    <li class="list-group-item p-0">
                                                                        <div class="row small">
                                                                            <div
                                                                                class="col-auto me-auto pe-0 flex-fill">
                                                                                {{-- ЛАЙК ДИЗЛАЙК ответ==========================================================================    --}}


                                                                                <i class="
                                                                               @if ($reply->reply_like_active) {{ 'bi bi-hand-thumbs-up-fill' }} 
                                                                              @else
                                                                              {{ 'bi bi-hand-thumbs-up' }} @endif "
                                                                                    style="cursor: pointer;"
                                                                                    value="5"
                                                                                    reply_id="{{ $reply->id }}">
                                                                                    {{ $reply->reply_like_count }}</i>&nbsp;
                                                                                <i class="
                                                                               @if ($reply->reply_dislike_active) {{ 'bi bi-hand-thumbs-down-fill' }} 
                                                                                  @else
                                                                                {{ 'bi bi-hand-thumbs-down' }} @endif "
                                                                                    style="cursor: pointer;"
                                                                                    value="6"
                                                                                    reply_id="{{ $reply->id }}">
                                                                                    {{ $reply->reply_dislike_count }}</i>
                                                                            </div>
                                                                            <div class="col-auto  ps-0">

                                                                                @auth
                                                                                    @if ($reply->id_user == Auth::user()->name)
                                                                                        <a class="link-underline-light p-0"
                                                                                            data-bs-toggle="collapse"
                                                                                            href="#reply_collapse_edit{{ $reply->id }}"
                                                                                            role="button"
                                                                                            aria-expanded="false"
                                                                                            aria-controls="collapseExample"
                                                                                            title="Редактировать, удалить комментарий"
                                                                                            style="cursor: pointer;">изменить
                                                                                        </a>
                                                                                    @endif
                                                                                @endauth
                                                                                <a class="link-underline-light p-0"
                                                                                    data-bs-toggle="collapse"
                                                                                    href="#reply_collapse{{ $reply->id }}"
                                                                                    role="button"
                                                                                    aria-expanded="false"
                                                                                    aria-controls="collapseExample"
                                                                                    title="Редактировать, удалить комментарий"
                                                                                    style=" cursor: pointer;"> &ensp;
                                                                                    ответить
                                                                                </a>

                                                                            </div>
                                                                        </div>
                                                                    </li>

                                                                </ul>
                                                            </div>


                                                            <!-- \\\\\\\\\\\\\\\\\\\\\\\\ ФОРМА ОТВЕТА НА ОТВЕТ ==================================================================================== -->
                                                            <div class="collapse"
                                                                id="reply_collapse{{ $reply->id }}">
                                                                <div class="card card-body p-1">

                                                                    <form id="form_reply_comment{{ $comment->id }}"
                                                                        form_type="4"
                                                                        coment_id="{{ $comment->id }}"
                                                                        reply_id="{{ $reply->id }}">

                                                                        <div text_div class="card card-body p-1 m-0"
                                                                            id="text_div_reply{{ $reply->id }}" contenteditable="true"
                                                                            data-placeholder="Напишите ваш ответ">
                                                                            {{ $reply->user_name }} &ensp;
                                                                        </div>

                                                                        <input type="hidden" name="name_opponent"
                                                                            value="{{ $reply->user_name }}">

                                                                            <div class="row p-1 ">
                                                                                <div class="col-7 me-auto  flex-fill ">
            
                                                                                    <i class="bi bi-emoji-smile h3 " data-bs-toggle="collapse" href="#collapse_reply_smile{{ $reply->id }}" role="button" aria-expanded="false" aria-controls="collapseExample">  </i>
            
                                                                                    <div class="collapse" id="collapse_reply_smile{{ $reply->id }}">
                                                                                      
                                                                                        <span reply_id="{{ $reply->id }}" class="reply_smile">😀</span>
                                                                                        <span reply_id="{{ $reply->id }}" class="reply_smile">👍</span>
                                                                                        <span reply_id="{{ $reply->id }}" class="reply_smile">👌</span>
                                                                                        <span reply_id="{{ $reply->id }}" class="reply_smile">😂</span>
                                                                                        <span reply_id="{{ $reply->id }}" class="reply_smile">😎</span>
                                                                                        <span reply_id="{{ $reply->id }}" class="reply_smile">😇</span>
                                                                                        <span reply_id="{{ $reply->id }}" class="reply_smile">😝</span>
                                                                                        
                                                                                            <span reply_id="{{ $reply->id }}" class="reply_smile">👎</span>
                                                                                            <span reply_id="{{ $reply->id }}" class="reply_smile">💩</span>
                                                                                            <span reply_id="{{ $reply->id }}" class="reply_smile">😈</span>
                                                                                            <span reply_id="{{ $reply->id }}" class="reply_smile">☠</span>
                                                                                            <span reply_id="{{ $reply->id }}" class="reply_smile">😪</span>
                                                                                            <span reply_id="{{ $reply->id }}" class="reply_smile">😬</span>
                                                                                            <span reply_id="{{ $reply->id }}" class="reply_smile">😭</span>
                                                                                      
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-auto p-0 pe-2 pt-1">
                                                                                    <button class="btn btn-primary btn-sm" title="Ответить"
                                                                                        type="submit">Ответить</button>
                                                                                </div>
                                                                            </div>
                                                                    </form>

                                                                </div>
                                                            </div>


                                                            <!-- ФОРМА ИСПРАВЛЕНИЯ ОТВЕТОВ ==================================================================================== -->
                                                            <div class="collapse"
                                                                id="reply_collapse_edit{{ $reply->id }}">
                                                                <div class="card card-body p-1">

                                                                    <form form_type="5"
                                                                        reply_id="{{ $reply->id }}">
                                                                        <div text_div class="card card-body p-1 m-0"
                                                                            id="text_div_reply_edit{{ $reply->id }}" contenteditable="true"
                                                                            data-placeholder="Напишите новый текст">
                                                                            {{ $reply->reply }}
                                                                        </div>
                                                                        <input name="_method" type="hidden"
                                                                            value="PUT">
                                                                            <div class="row p-1 ">
                                                                                <div class="col-7 me-auto  flex-fill ">
            
                                                                                    <i class="bi bi-emoji-smile h3 " data-bs-toggle="collapse" href="#collapse_reply_edit_smile{{ $reply->id }}" role="button" aria-expanded="false" aria-controls="collapseExample">  </i>
            
                                                                                    <div class="collapse" id="collapse_reply_edit_smile{{ $reply->id }}">
                                                                                      
                                                                                        <span reply_id="{{ $reply->id }}" class="reply_edit_smile">😀</span>
                                                                                        <span reply_id="{{ $reply->id }}" class="reply_edit_smile">👍</span>
                                                                                        <span reply_id="{{ $reply->id }}" class="reply_edit_smile">👌</span>
                                                                                        <span reply_id="{{ $reply->id }}" class="reply_edit_smile">😂</span>
                                                                                        <span reply_id="{{ $reply->id }}" class="reply_edit_smile">😎</span>
                                                                                        <span reply_id="{{ $reply->id }}" class="reply_edit_smile">😇</span>
                                                                                        <span reply_id="{{ $reply->id }}" class="reply_edit_smile">😝</span>
                                                                                        
                                                                                            <span reply_id="{{ $reply->id }}" class="reply_edit_smile">👎</span>
                                                                                            <span reply_id="{{ $reply->id }}" class="reply_edit_smile">💩</span>
                                                                                            <span reply_id="{{ $reply->id }}" class="reply_edit_smile">😈</span>
                                                                                            <span reply_id="{{ $reply->id }}" class="reply_edit_smile">☠</span>
                                                                                            <span reply_id="{{ $reply->id }}" class="reply_edit_smile">😪</span>
                                                                                            <span reply_id="{{ $reply->id }}" class="reply_edit_smile">😬</span>
                                                                                            <span reply_id="{{ $reply->id }}" class="reply_edit_smile">😭</span>
                                                                                      
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-auto p-0 pe-2 pt-1">
                                                                                    <button class="btn btn-primary btn-sm" title="Ответить"
                                                                                        type="submit">Изменить</button>
                                                                                </div>
                                                                            </div>
                                                                    </form>

                                                                    <!-- ФОРМА УДАЛЕНИЯ КОММЕНТАРИЕВ ==================================================================================== -->

                                                                    <form form_type="6"
                                                                        reply_id="{{ $reply->id }}">
                                                                        {{-- <input type="hidden" name="reply_id"
                                                                            value="{{ $reply->id }}"> --}}
                                                                        <input name="_method" type="hidden"
                                                                            value="DELETE">
                                                                        <button class="btn btn-link m-0 p-0"
                                                                            title="Удаление комментария"
                                                                            type="submit">удалить</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach

                                                </div>
                                                {{-- ---------------------------------------------------------------------------------------------- --}}
                                            @endforeach

                                        </div>
                                        <!-- ==================================== КНОПКА СВЕРНУТЬ В КОНЦЕ КОММЕНТОВ ====================================== -->

                                        <div class="col-auto">
                                            <div class="row">
                                                <div class="col-auto me-auto pe-0 flex-fill">
                                                </div>
                                                <div class="col-auto  ps-0">
                                                    <a class="link-underline-light p-0" href="#collapseExample1"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#collapseExample{{ $post->id }}"
                                                        aria-expanded="false" aria-controls="collapseExample"><i
                                                            class="bi bi-chat-dots" value="www"></i></i> Свернуть
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>


            </div>

            {{-- =================================================================================================================================================== --}}

            <div hidden>
                <div id="test_comment">

                    <div class="card  card mb-2 p-0 m-0">
                        <div class="card-header p-0 ">
                            <div class="row">
                                <div class="col-auto me-auto pe-0 flex-fill">
                                    &nbsp; <b class="small"> </b>
                                </div>
                                <div class="col-auto  ps-0">
                                    <nobr class="small"> </nobr>
                                    &nbsp;
                                </div>

                            </div>
                        </div>
                        <ul class="list-group list-group-flush p-0">
                            <li id="comment_text"  class="list-group-item p-0"> 
                            </li>
                            <li class="list-group-item p-0">
                                <div class="row small">
                                    <div class="col-auto me-auto pe-0 flex-fill">
                                        <i id="like_comment" class='bi bi-hand-thumbs-up ' style="cursor: pointer;"
                                            value="3" comment_id="">
                                            0</i>&nbsp;
                                        <i id="dislike_comment" class="bi bi-hand-thumbs-down"
                                            style="cursor: pointer;" value="4" comment_id=""> 0</i>
                                    </div>
                                    <div class="col-auto  ps-0">


                                        <a data-bs-toggle="collapse" href="#coment_collapse" role="button"
                                            aria-expanded="false" aria-controls="collapseExample"
                                            title="Редактировать, удалить комментарий"
                                            class="link-underline-light p-0" style="cursor: pointer;">изменить
                                        </a>


                                        <a id="coment_reply_collapse" class="link-underline-light p-0"
                                            data-bs-toggle="collapse" href="#coment_reply_collapse" role="button"
                                            aria-expanded="false" aria-controls="collapseExample"
                                            title="Редактировать, удалить комментарий" style=" cursor: pointer;">
                                            &ensp; ответить
                                        </a>


                                    </div>
                                </div>
                            </li>

                        </ul>
                    </div>
                    <!-- \\\\\\\\\\\\\\\\\\\\\\\\ ФОРМА ОТВЕТА НА КОММЕНТАРИИ ==================================================================================== -->
                    <div class="collapse" id="coment_reply_collapse_hidden">
                        <div class="card card-body p-1">

                            <form id="form_reply_comment" form_type="4" coment_id="" reply_id="0">
                                <div text_div class="card card-body p-1 m-0" id="text_div_comment" contenteditable="true"
                                    data-placeholder="Напишите ваш ответ">
                                    &ensp;
                                </div>
                                <div class="row p-1 ">
                                    <div class="col-7 me-auto  flex-fill ">

                                        <i class="bi bi-emoji-smile h3 " data-bs-toggle="collapse" href="#collapse_comment_smile" role="button" aria-expanded="false" aria-controls="collapseExample">  </i>

                                        <div class="collapse" id="collapse_comment_smile">
                                          
                                            <span comment_id="" class="comment_smile">😀</span>
                                            <span comment_id="" class="comment_smile">👍</span>
                                            <span comment_id="" class="comment_smile">👌</span>
                                            <span comment_id="" class="comment_smile">😂</span>
                                            <span comment_id="" class="comment_smile">😎</span>
                                            <span comment_id="" class="comment_smile">😇</span>
                                            <span comment_id="" class="comment_smile">😝</span>
                                            
                                                <span comment_id="" class="comment_smile">👎</span>
                                                <span comment_id="" class="comment_smile">💩</span>
                                                <span comment_id="" class="comment_smile">😈</span>
                                                <span comment_id="" class="comment_smile">☠</span>
                                                <span comment_id="" class="comment_smile">😪</span>
                                                <span comment_id="" class="comment_smile">😬</span>
                                                <span comment_id="" class="comment_smile">😭</span>
                                          
                                        </div>
                                    </div>
                                    <div class="col-auto p-0 pe-2 pt-1">
                                        <button class="btn btn-primary btn-sm" title="Ответить"
                                            type="submit">Отправить</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>



                    <!-- ФОРМА ИСПРАВЛЕНИЯ КОММЕНТАРИЕВ ==================================================================================== -->
                    <div class="collapse" id="coment_collapse">
                        <div class="card card-body p-1">

                            <form id="form_coment" form_type="2" coment_id="">
                                <div text_div class="card card-body p-1 m-0" id="text_div_comment_edit" contenteditable="true">
                                </div>
                                <input name="_method" type="hidden" value="PUT">
                                <div class="row p-1 ">
                                    <div class="col-7 me-auto  flex-fill ">

                                        <i class="bi bi-emoji-smile h3 " data-bs-toggle="collapse" href="#collapse_comment_edit_smile" role="button" aria-expanded="false" aria-controls="collapseExample">  </i>

                                        <div class="collapse" id="collapse_comment_edit_smile">
                                          
                                            <span comment_id="" class="comment_edit_smile">😀</span>
                                            <span comment_id="" class="comment_edit_smile">👍</span>
                                            <span comment_id="" class="comment_edit_smile">👌</span>
                                            <span comment_id="" class="comment_edit_smile">😂</span>
                                            <span comment_id="" class="comment_edit_smile">😎</span>
                                            <span comment_id="" class="comment_edit_smile">😇</span>
                                            <span comment_id="" class="comment_edit_smile">😝</span>
                                            
                                                <span comment_id="" class="comment_edit_smile">👎</span>
                                                <span comment_id="" class="comment_edit_smile">💩</span>
                                                <span comment_id="" class="comment_edit_smile">😈</span>
                                                <span comment_id="" class="comment_edit_smile">☠</span>
                                                <span comment_id="" class="comment_edit_smile">😪</span>
                                                <span comment_id="" class="comment_edit_smile">😬</span>
                                                <span comment_id="" class="comment_edit_smile">😭</span>
                                          
                                        </div>
                                    </div>
                                    <div class="col-auto p-0 pe-2 pt-1">
                                        <button class="btn btn-primary btn-sm" title="Ответить"
                                            type="submit">Изменить</button>
                                    </div>
                                </div>
                            </form>

                            <!-- ФОРМА УДАЛЕНИЯ КОММЕНТАРИЕВ ==================================================================================== -->

                            <form id="form_coment_del" form_type="3" coment_id="">
                                <input type="hidden" name="comment_id" value="">
                                <input id="input3" name="_method" type="hidden" value="DELETE">
                                <button id='but2' class="btn btn-link m-0 p-0" title="Удаление комментария"
                                    type="submit">удалить</button>
                            </form>
                        </div>
                    </div>

                    <div id="reply">
                    </div>
                </div>
            </div>

            {{-- ========================================================================================================================================= --}}

            <div hidden>
                <div id="replu_hidden">


                    <div class="card mb-2 p-0 ms-2">
                        <div class="card-header p-0 ">
                            <div class="row">
                                <div class="col-auto me-auto pe-0 flex-fill">
                                    &nbsp; <b class="small">
                                    </b>
                                </div>
                                <div class="col-auto  ps-0">
                                    <nobr class="small"> </nobr>
                                    &nbsp;
                                </div>

                            </div>
                        </div>
                        <ul class="list-group list-group-flush p-0">
                            <li id="reply_text" class="list-group-item p-0">
                            </li>
                            <li class="list-group-item p-0">
                                <div class="row small">
                                    <div class="col-auto me-auto pe-0 flex-fill">
                                        {{-- ЛАЙК ДИЗЛАЙК ОТВЕТ==========================================================================    --}}



                                        <i id="like_reply" class="bi bi-hand-thumbs-up" style="cursor: pointer;"
                                            value="5" reply_id=""> 0
                                        </i>&nbsp;
                                        <i id="dislike_reply" class=" bi bi-hand-thumbs-down "
                                            style="cursor: pointer;" value="6" reply_id=""> 0
                                        </i>
                                    </div>
                                    <div class="col-auto  ps-0">


                                        <a id="hidden_reply_collapse_edit" class="link-underline-light p-0"
                                            data-bs-toggle="collapse" href="#reply_collapse_edit" role="button"
                                            aria-expanded="false" aria-controls="collapseExample"
                                            title="Редактировать, удалить комментарий"
                                            style="cursor: pointer;">изменить
                                        </a>

                                        <a id="hidden_reply_collapse" class="link-underline-light p-0"
                                            data-bs-toggle="collapse" href="#reply_collapse" role="button"
                                            aria-expanded="false" aria-controls="collapseExample"
                                            title="Ответить на комментарий" style=" cursor: pointer;">
                                            &ensp; ответить
                                        </a>

                                    </div>
                                </div>
                            </li>

                        </ul>
                    </div>

                    <!-- \\\\\\\\\\\\\\\\\\\\\\\\ ФОРМА ОТВЕТА НА ОТВЕТ ==================================================================================== -->
                    <div class="collapse" id="reply_collapse">
                        <div class="card card-body p-1">

                            <form id="form_reply_reply" form_type="4" coment_id="" reply_id="">
                                <div text_div class="card card-body p-1 m-0" id="text_div_reply" contenteditable="true"
                                    data-placeholder="Напишите ваш ответ">
                                    &ensp;
                                </div>

                                <input id="input_name_opponent" type="hidden" name="name_opponent" value="">

                                <div class="row p-1 ">
                                    <div class="col-7 me-auto  flex-fill ">

                                        <i class="bi bi-emoji-smile h3 " data-bs-toggle="collapse" href="#collapse_reply_smile" role="button" aria-expanded="false" aria-controls="collapseExample">  </i>

                                        <div class="collapse" id="collapse_reply_smile">
                                          
                                            <span reply_id="" class="reply_smile">😀</span>
                                            <span reply_id="" class="reply_smile">👍</span>
                                            <span reply_id="" class="reply_smile">👌</span>
                                            <span reply_id="" class="reply_smile">😂</span>
                                            <span reply_id="" class="reply_smile">😎</span>
                                            <span reply_id="" class="reply_smile">😇</span>
                                            <span reply_id="" class="reply_smile">😝</span>
                                            
                                                <span reply_id="" class="reply_smile">👎</span>
                                                <span reply_id="" class="reply_smile">💩</span>
                                                <span reply_id="" class="reply_smile">😈</span>
                                                <span reply_id="" class="reply_smile">☠</span>
                                                <span reply_id="" class="reply_smile">😪</span>
                                                <span reply_id="" class="reply_smile">😬</span>
                                                <span reply_id="" class="reply_smile">😭</span>
                                          
                                        </div>
                                    </div>
                                    <div class="col-auto p-0 pe-2 pt-1">
                                        <button class="btn btn-primary btn-sm" title="Ответить"
                                            type="submit">Ответить</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>

                    <!-- ФОРМА ИСПРАВЛЕНИЯ ОТВЕТОВ ==================================================================================== -->
                    <div class="collapse" id="reply_collapse_edit">
                        <div class="card card-body p-1">

                            <form id="form_reply_edit" form_type="5" reply_id="">
                                <div text_div class="card card-body p-1 m-0" id="text_div_reply_edit" contenteditable="true"
                                    data-placeholder="Напишите новый текст">
                                </div>
                                <input name="_method" type="hidden" value="PUT">
                                <div class="row p-1 ">
                                    <div class="col-7 me-auto  flex-fill ">

                                        <i class="bi bi-emoji-smile h3 " data-bs-toggle="collapse" href="#collapse_reply_edit_smile" role="button" aria-expanded="false" aria-controls="collapseExample">  </i>

                                        <div class="collapse" id="collapse_reply_edit_smile">
                                          
                                            <span reply_id="" class="reply_edit_smile">😀</span>
                                            <span reply_id="" class="reply_edit_smile">👍</span>
                                            <span reply_id="" class="reply_edit_smile">👌</span>
                                            <span reply_id="" class="reply_edit_smile">😂</span>
                                            <span reply_id="" class="reply_edit_smile">😎</span>
                                            <span reply_id="" class="reply_edit_smile">😇</span>
                                            <span reply_id="" class="reply_edit_smile">😝</span>
                                            
                                                <span reply_id="" class="reply_edit_smile">👎</span>
                                                <span reply_id="" class="reply_edit_smile">💩</span>
                                                <span reply_id="" class="reply_edit_smile">😈</span>
                                                <span reply_id="" class="reply_edit_smile">☠</span>
                                                <span reply_id="" class="reply_edit_smile">😪</span>
                                                <span reply_id="" class="reply_edit_smile">😬</span>
                                                <span reply_id="" class="reply_edit_smile">😭</span>
                                          
                                        </div>
                                    </div>
                                    <div class="col-auto p-0 pe-2 pt-1">
                                        <button class="btn btn-primary btn-sm" title="Ответить"
                                            type="submit">Изменить</button>
                                    </div>
                                </div>
                            </form>

                            <!-- ФОРМА УДАЛЕНИЯ ОТВЕТОВ ==================================================================================== -->

                            <form id="form_reply_del" form_type="6" reply_id="">
                                <input name="_method" type="hidden" value="DELETE">
                                <button class="btn btn-link m-0 p-0" title="Удаление комментария"
                                    type="submit">удалить</button>
                            </form>
                        </div>
                    </div>



                </div>
            </div>
            {{-- ====================================================================================================================================================== --}}


            <div id=li class="col-lg-2 ">


            </div>
        </div>

    </div>

    <div id="user_name_id" hidden> @auth {{ Auth::user()->name }}
        @else
        0 @endauth </div>

    <div id="csrf_token" hidden> @auth {{ csrf_token() }}
        @else
        0 @endauth </div>



    <script defer src="{{ url('client.js') }}"></script>
    


</body>

</html>

