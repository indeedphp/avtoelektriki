<!DOCTYPE html>

<html lang="ru">

<head>
    <meta charset="utf-8">
    <title>Автоэлектрики</title>
    <link rel="shortcut icon" href="favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Профпортал Автоэлектрики">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="bootstrap.js" integrity="" crossorigin="anonymous"></script>
    <link href="bootstrap.css" rel="stylesheet">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
rel="stylesheet" -->
    <link rel="stylesheet" href="bootstrap-icons-1.10.5/font/bootstrap-icons.min.css">
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

                    @foreach ($posts as $post)
                        <div class="card  mb-3  shadow ">
                            <div class=" card-header text-muted py-1 p-lg-3">
                                <div class="row">
                                    <!-- <div class="col-auto p-0 px-lg-3 "><a class="link-underline-light" href="#"> <i
      class="bi bi-card-text" value="www"></i> {{ $post->id }} </a> </div> -->
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
                                        <img class=" img-fluid shadow " src="{{ $post->url_foto }}"
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
                                              @if ($post->like_up) {{ 'bi bi-hand-thumbs-up-fill' }} 
                                                 @else
                                                  {{ 'bi bi-hand-thumbs-up' }} @endif 
                                                 ">
                                                {{ $post->like }}</i></a>
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
                                            <i id="comm_count{{ $post->id }}">{{ $post->comment }}</i>&nbsp;</a>
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
                                        <form id="form{{ $post->id }}" val="{{ $post->id }}" form_type="1"
                                            enctype="multipart/form-data">


                                            <div class="card card-body p-1 " id="text_div_comm{{ $post->id }}"
                                                contenteditable="true" data-placeholder="Напишите комментарий"></div>
                                            {{-- <input type="text" name="comment" class="form-control"
                                                        placeholder="Напишите комментарий"> --}}
                                            <input type="hidden" name="post_id" value="{{ $post->id }}">

                                            <input type="hidden" name="user_name"
                                                @auth value="{{ Auth::user()->user_name }}" @endauth>
                                            <input type="hidden" name="id_user"
                                                @auth value="{{ Auth::user()->name }}" @endauth>

                                            <div class="row p-1 ">
                                                <div class="col-7 me-auto  flex-fill">
                                                    <span vall="{{ $post->id }}" class="smile">😀</span>
                                                    <span vall="{{ $post->id }}" class="smile">👍</span>
                                                    <span vall="{{ $post->id }}" class="smile">👌</span>
                                                    <span vall="{{ $post->id }}" class="smile">😂</span>
                                                    <span vall="{{ $post->id }}" class="smile">😎</span>
                                                    <span vall="{{ $post->id }}" class="smile">😇</span>
                                                    <span vall="{{ $post->id }}" class="smile">😝</span>
                                                    <div>
                                                        <span vall="{{ $post->id }}" class="smile">👎</span>
                                                        <span vall="{{ $post->id }}" class="smile">💩</span>
                                                        <span vall="{{ $post->id }}" class="smile">😈</span>
                                                        <span vall="{{ $post->id }}" class="smile">☠</span>
                                                        <span vall="{{ $post->id }}" class="smile">😪</span>
                                                        <span vall="{{ $post->id }}" class="smile">😬</span>
                                                        <span vall="{{ $post->id }}" class="smile">😭</span>
                                                    </div>

                                                </div>
                                                <div class="col-auto p-0 pe-2 pt-1">
                                                    <button id='butw{{ $post->id }}' class="btn btn-primary"
                                                        title="Отправить" type="submit">Отправить</button>
                                                </div>
                                            </div>
                                        </form>


                                        {{-- КОМЕНТАРИИ ===================================================================================================================================================== --}}
                                        <div id='wr{{ $post->id }}' class="overflow-x-hidden p-0  "
                                            style="max-height: 300px;">
                                            @foreach ($post->comment_plus as $comment)
                                                <div>
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
                                                            <li class="list-group-item p-0">
                                                                <span id="comment_i{{ $comment->id }}"
                                                                    value="www">
                                                                    {{ $comment->comment }}
                                                                </span>
                                                            </li>
                                                            <li class="list-group-item p-0">
                                                                <div class="row small">
                                                                    <div class="col-auto me-auto pe-0 flex-fill">
                                                                        {{-- ЛАЙК ДИЗЛАЙК КОМЕНТ==========================================================================    --}}


                                                                        <i class="
                                                                        @if ($comment->like_comment_up) {{ 'bi bi-hand-thumbs-up-fill' }} 
                                                                           @else
                                                                            {{ 'bi bi-hand-thumbs-up' }} @endif "
                                                                            style="cursor: pointer;" value="3"
                                                                            comment_id="{{ $comment->id }}">
                                                                            {{ $comment->comment_like }}</i>&nbsp;
                                                                        <i class="
                                                                            @if ($comment->dislike_comment_up) {{ 'bi bi-hand-thumbs-down-fill' }} 
                                                                               @else
                                                                                {{ 'bi bi-hand-thumbs-down' }} @endif "
                                                                            style="cursor: pointer;" value="4"
                                                                            comment_id="{{ $comment->id }}">
                                                                            {{ $comment->comment_dislike }}</i>
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

                                                            <form id="form_reply_comment{{ $comment->id }}"
                                                                form_type="4" coment_id="{{ $comment->id }}">
                                                                <div class="card card-body p-1 m-0"
                                                                    id="text_reply_div{{ $comment->id }}"
                                                                    contenteditable="true"
                                                                    data-placeholder="Напишите ваш ответ">
                                                                    {{ $comment->user_name }} &ensp;
                                                                </div>
                                                                <input type="hidden" name="comment_id"
                                                                    value="{{ $comment->id }}">

                                                                <button class="btn btn-primary mt-2"
                                                                    title="Изменение комментария"
                                                                    type="submit">Ответить
                                                                </button>
                                                            </form>

                                                        </div>
                                                    </div>

                                                    <!-- ФОРМА ИСПРАВЛЕНИЯ КОММЕНТАРИЕВ ==================================================================================== -->
                                                    <div class="collapse" id="coment_collapse{{ $comment->id }}">
                                                        <div class="card card-body p-1">

                                                            <form id="form_coment{{ $comment->id }}" form_type="2"
                                                                coment_id="{{ $comment->id }}">
                                                                <div class="card card-body p-1 m-0"
                                                                    id="text_div{{ $comment->id }}"
                                                                    contenteditable="true"
                                                                    data-placeholder="Напишите новый текст">
                                                                    {{ $comment->comment }}
                                                                </div>
                                                                <input type="hidden" name="comment_id"
                                                                    value="{{ $comment->id }}">
                                                                <input name="_method" type="hidden" value="PUT">
                                                                <button id='butw{{ $post->id }}'
                                                                    class="btn btn-primary mt-2"
                                                                    title="Изменение комментария"
                                                                    type="submit">Изменить комментарий</button>
                                                            </form>

                                                            <!-- ФОРМА УДАЛЕНИЯ КОММЕНТАРИЕВ ==================================================================================== -->

                                                            <form id="form_coment_del{{ $comment->id }}"
                                                                form_type="3" coment_id="{{ $comment->id }}">
                                                                <input type="hidden" name="comment_id"
                                                                    value="{{ $comment->id }}">
                                                                <input name="_method" type="hidden" value="DELETE">
                                                                <button id='butw{{ $post->id }}'
                                                                    class="btn btn-link m-0 p-0"
                                                                    title="Удаление комментария"
                                                                    type="submit">удалить</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

  {{-- -------------------------------------------------------------------КОЛХОЗ --}}
  <div id="reply{{ $comment->id }}">
    @foreach ($comment->reply_comment_plus as $reply)
    <div class="card mb-2 p-0 ms-2">
        <div class="card-header p-0 ">
            <div class="row">
                <div class="col-auto me-auto pe-0 flex-fill">
                    &nbsp; <b class="small">{{ $reply->user_name }}
                    </b>
                </div>
                <div class="col-auto  ps-0">
                    <nobr class="small"> @php
                        echo date(
                            'd.m.Y',
                            strtotime($reply->created_at),
                        );
                    @endphp </nobr>
                    &nbsp;
                </div>

            </div>
        </div>
        <ul class="list-group list-group-flush p-0">
            <li class="list-group-item p-0">
                <span id="comment_i{{ $reply->id }}"
                    value="www">
                    {{ $reply->reply }}
                </span>
            </li>
            <li class="list-group-item p-0">
                <div class="row small">
                    <div class="col-auto me-auto pe-0 flex-fill">
                        {{-- ЛАЙК ДИЗЛАЙК КОМЕНТ==========================================================================    --}}


                        <i class="
                        @if ($comment->like_comment_up) {{ 'bi bi-hand-thumbs-up-fill' }} 
                           @else
                            {{ 'bi bi-hand-thumbs-up' }} @endif "
                            style="cursor: pointer;" value="3"
                            comment_id="{{ $comment->id }}">
                            {{ $comment->comment_like }}</i>&nbsp;
                        <i class="
                            @if ($comment->dislike_comment_up) {{ 'bi bi-hand-thumbs-down-fill' }} 
                               @else
                                {{ 'bi bi-hand-thumbs-down' }} @endif "
                            style="cursor: pointer;" value="4"
                            comment_id="{{ $comment->id }}">
                            {{ $comment->comment_dislike }}</i>
                    </div>
                    <div class="col-auto  ps-0">

                        @auth
                            @if ($reply->id_user == Auth::user()->name)
                                <a class="link-underline-light p-0"
                                    data-bs-toggle="collapse"
                                    href="#reply_collapse_edit{{ $reply->id }}"
                                    role="button" aria-expanded="false"
                                    aria-controls="collapseExample"
                                    title="Редактировать, удалить комментарий"
                                    style="cursor: pointer;">изменить
                                </a>
                            @endif
                        @endauth
                        <a class="link-underline-light p-0"
                            data-bs-toggle="collapse"
                            href="#reply_collapse{{ $reply->id }}"
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

<!-- \\\\\\\\\\\\\\\\\\\\\\\\ ФОРМА ОТВЕТА НА ОТВЕТ ==================================================================================== -->
    <div class="collapse"
        id="reply_collapse{{ $reply->id }}">
        <div class="card card-body p-1">

            <form id="form_reply_reply{{ $reply->id }}"
                form_type="4" coment_id="{{ $reply->id }}">
                <div class="card card-body p-1 m-0"
                    id="text_reply_div{{ $reply->id }}"
                    contenteditable="true"
                    data-placeholder="Напишите ваш ответ">
                    {{ $reply->user_name }} &ensp;
                </div>
                <input type="hidden" name="comment_id"
                    value="{{ $reply->id }}">

                <button class="btn btn-primary mt-2"
                    title="Изменение комментария"
                    type="submit">Ответить
                </button>
            </form>

        </div>
    </div>

    <!-- ФОРМА ИСПРАВЛЕНИЯ ОТВЕТОВ ==================================================================================== -->
    <div class="collapse" id="reply_collapse_edit{{ $reply->id }}">
        <div class="card card-body p-1">

            <form id="form_coment{{ $reply->id }}" form_type="2"
                coment_id="{{ $reply->id }}">
                <div class="card card-body p-1 m-0"
                    id="text_div{{ $reply->id }}"
                    contenteditable="true"
                    data-placeholder="Напишите новый текст">
                    {{ $reply->reply }}
                </div>
                <input type="hidden" name="comment_id"
                    value="{{ $reply->id }}">
                <input name="_method" type="hidden" value="PUT">
                <button 
                    class="btn btn-primary mt-2"
                    title="Изменение комментария"
                    type="submit">Изменить</button>
            </form>

            <!-- ФОРМА УДАЛЕНИЯ КОММЕНТАРИЕВ ==================================================================================== -->

            <form id="form_coment_del{{ $reply->id }}"
                form_type="3" coment_id="{{ $reply->id }}">
                <input type="hidden" name="comment_id"
                    value="{{ $reply->id }}">
                <input name="_method" type="hidden" value="DELETE">
                <button id='butw{{ $post->id }}'
                    class="btn btn-link m-0 p-0"
                    title="Удаление комментария"
                    type="submit">удалить</button>
            </form>
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

                    <div class="card  m-1">
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
                            <li class="list-group-item p-0">
                                <span id="comment_i" value="www">

                                </span>
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
                                            style="cursor: pointer;">изменить
                                        </a>

                                        <a title="Редактировать, удалить комментарий" style="cursor: pointer;"> &ensp;
                                            ответить
                                        </a>

                                    </div>
                                </div>
                            </li>

                        </ul>
                    </div>

                    <!-- ФОРМА ИСПРАВЛЕНИЯ КОММЕНТАРИЕВ ==================================================================================== -->
                    <div class="collapse" id="collap">
                        <div class="card card-body p-1">

                            <form id="form_coment" form_type="2" coment_id="">
                                <div class="card card-body p-1 m-0" id="text_div" contenteditable="true">
                                </div>
                                <input id="input2" type="hidden" name="comment_id" value="">
                                <input name="_method" type="hidden" value="PUT">
                                <button id='but1' class="btn btn-primary mt-2" title="Изменение комментария"
                                    type="submit">Изменить комментарий</button>
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
                                    <nobr class="small">  </nobr>
                                    &nbsp;
                                </div>
                
                            </div>
                        </div>
                        <ul class="list-group list-group-flush p-0">
                            <li class="list-group-item p-0">
                                <span id="comment_i"
                                    value="www">
                                   uytutyutyutyutyyt
                                </span>
                            </li>
                            <li class="list-group-item p-0">
                                <div class="row small">
                                    <div class="col-auto me-auto pe-0 flex-fill">
                                        {{-- ЛАЙК ДИЗЛАЙК КОМЕНТ==========================================================================    --}}
                
                
                                        <i class="bi bi-hand-thumbs-up"
                                            style="cursor: pointer;" value="3"
                                            comment_id="">
                                            </i>&nbsp;
                                        <i class=" bi bi-hand-thumbs-down "
                                            style="cursor: pointer;" value="4"
                                            comment_id="">
                                            </i>
                                    </div>
                                    <div class="col-auto  ps-0">
                
                                    
                                                <a id="hidden_reply_collapse_edit" class="link-underline-light p-0"
                                                    data-bs-toggle="collapse"
                                                    href="#reply_collapse_edit"
                                                    role="button" aria-expanded="false"
                                                    aria-controls="collapseExample"
                                                    title="Редактировать, удалить комментарий"
                                                    style="cursor: pointer;">изменить
                                                </a>
        
                                        <a id="hidden_reply_collapse" class="link-underline-light p-0"
                                            data-bs-toggle="collapse"
                                            href="#reply_collapse"
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
                
                <!-- \\\\\\\\\\\\\\\\\\\\\\\\ ФОРМА ОТВЕТА НА ОТВЕТ ==================================================================================== -->
                    <div class="collapse"
                        id="reply_collapse">
                        <div class="card card-body p-1">
                
                            <form id="form_reply_reply"
                                form_type="4" coment_id="">
                                <div class="card card-body p-1 m-0"
                                    id="text_reply_div"
                                    contenteditable="true"
                                    data-placeholder="Напишите ваш ответ">
                                    &ensp;
                                </div>
                                <input type="hidden" name="comment_id"
                                    value="">
                
                                <button class="btn btn-primary mt-2"
                                    title="Изменение комментария"
                                    type="submit">Ответить
                                </button>
                            </form>
                
                        </div>
                    </div>
                
                    <!-- ФОРМА ИСПРАВЛЕНИЯ ОТВЕТОВ ==================================================================================== -->
                    <div class="collapse" id="reply_collapse_edit">
                        <div class="card card-body p-1">
                
                            <form id="form_coment" form_type="2"
                                coment_id="">
                                <div class="card card-body p-1 m-0"
                                    id="text_div"
                                    contenteditable="true"
                                    data-placeholder="Напишите новый текст">
                                    
                                </div>
                                <input type="hidden" name="comment_id"
                                    value="">
                                <input name="_method" type="hidden" value="PUT">
                                <button 
                                    class="btn btn-primary mt-2"
                                    title="Изменение комментария"
                                    type="submit">Изменить</button>
                            </form>
                
                            <!-- ФОРМА УДАЛЕНИЯ КОММЕНТАРИЕВ ==================================================================================== -->
                
                            <form id="form_coment_del"
                                form_type="3" coment_id="">
                                <input type="hidden" name="comment_id"
                                    value="">
                                <input name="_method" type="hidden" value="DELETE">
                                <button 
                                    class="btn btn-link m-0 p-0"
                                    title="Удаление комментария"
                                    type="submit">удалить</button>
                            </form>
                        </div>
                    </div>


 
                </div>
            </div>
{{-- ====================================================================================================================================================== --}}








            <div id="user_name_id" hidden> @auth {{ Auth::user()->name }}
                @else
                0 @endauth </div>



            <div id=li class="col-lg-2 ">


            </div>
        </div>

    </div>



    <script>
        window.addEventListener('click', function(event) {
            // console.log('even');
            if (event.target.classList.contains('smile')) {

                let vall = event.target.getAttribute('vall');

                let text_div_c = document.getElementById('text_div_comm' + vall);

                text_div_c.textContent += event.target.textContent;
            }
        });



        {{-- =================================================================== ОТПРАВКА  КОМЕНТАРИЯ  ================================================================================== --}}
        const wrapper = document.getElementById('wrapper');
        wrapper.addEventListener('submit', function(event) {
            event.preventDefault();
            let form_type = event.target.getAttribute('form_type');
            let test_comment = document.getElementById('test_comment');
            let fff = document.getElementById('fff');

            switch (form_type) {
                case '1':
                    let val = event.target.getAttribute('val');
                    let text_div_comm = document.getElementById('text_div_comm' + val);
                    let wr = document.getElementById('wr' + val);
                    let comm_count = document.getElementById('comm_count' + val);
                    console.log(val);
                    let formData = new FormData(document.getElementById("form" + val));
                    // console.dir(val);





                    // let text_empty = formData.entries().next().value;
                    let button = document.getElementById('butw' + val);
                    button.className = "btn btn-success";
                    formData.append("comment", text_div_comm.textContent);

                    if (text_div_comm.textContent.trim() != '') {
                        fetch('/comments/', {
                                method: 'POST',
                                headers: {
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: formData
                            })
                            .then(response => response.json())
                            .then(commits => {

                                text_div_comm.textContent = null;
                                let clone = test_comment.cloneNode(true);
                                console.dir(clone);
                                clone.querySelector('li').id = 'one_comment' + commits['id'];
                                clone.querySelector('nobr').textContent = new Date().toLocaleString().slice(0, -
                                    10) + ' ';
                                clone.querySelector('b').textContent = commits['user_name'] + ' ';
                                clone.querySelector('#comment_i').textContent = commits['comment'];
                                clone.querySelector('#comment_i').id = "comment_i" + commits['id'];
                                clone.querySelector('a').setAttribute('href', "#coment_collapse" + commits[
                                    'id']);
                                // console.dir(clone.querySelector('#collap'));
                                clone.querySelector('#collap').id = "coment_collapse" + commits['id'];
                                clone.querySelector('#form_coment').setAttribute('coment_id', commits['id']);
                                clone.querySelector('#form_coment').id = "form_coment" + commits['id'];
                                clone.querySelector('#text_div').textContent = commits['comment'];
                                clone.querySelector('#text_div').id = 'text_div' + commits['id'];
                                clone.querySelector('#input2').value = commits['id'];
                                clone.querySelector('#but1').id = "butw" + val;
                                clone.querySelector('#form_coment_del').setAttribute('coment_id', commits[
                                    'id']);
                                clone.querySelector('#form_coment_del').id = "form_coment_del" + commits['id'];
                                clone.querySelector('#input3').value = commits['id'];
                                clone.querySelector('#but2').id = "butw" + val;
                                clone.querySelector('#like_comment').setAttribute('comment_id', commits['id']);
                                clone.querySelector('#dislike_comment').setAttribute('comment_id', commits[
                                    'id']);
                                clone.id = 'clone_mess';

                                wr.appendChild(clone);

                                comm_count.textContent = +comm_count.textContent +
                                    1; // прибавляем счет комментариев 
                                clone = null;
                            });
                    } else {
                        alert("Напишите коментарий");
                    }
                    event.target.reset();
                    setTimeout(function() {
                        button.className = "btn btn-primary"
                    }, 3000);

                    break;
                    // Изменение комментария ======================================================================================================================
                case '2':

                    let coment_id = event.target.getAttribute('coment_id');
                    console.dir(coment_id);
                    let comment_i = document.getElementById('comment_i' + coment_id);
                    console.dir(comment_i);
                    let text_div = document.getElementById('text_div' + coment_id).textContent;
                    let coment_collapse = document.getElementById('coment_collapse' + coment_id);
                    // console.dir(coment_id);
                    let formData2 = new FormData(document.getElementById("form_coment" + coment_id));
                    formData2.append("text_comment", text_div);

                    if (text_div.trim() != '') {
                        fetch('/comments/', {
                                method: 'POST',
                                headers: {
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: formData2
                            })
                            .then(response => response.json())
                            .then(commits => {
                                coment_collapse.className = "collapse";
                                comment_i.textContent = commits['comment'];

                            });
                    } else {
                        alert("Напишите комений");
                    }

                    break;
                    // Удаление комментария ======================================================================================================================
                case '3':

                    let coment_id2 = event.target.getAttribute('coment_id');
                    let one_comment = document.getElementById('one_comment' + coment_id2);
                    let coment_collapse2 = document.getElementById('coment_collapse' + coment_id2);
                    let formData3 = new FormData(document.getElementById("form_coment_del" + coment_id2));
                    // console.dir(one_comment);

                    fetch('/comments/', {
                            method: 'POST',
                            headers: {
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: formData3
                        })
                        .then(response => response.json())
                        .then(commits => {
                            coment_collapse2.className = "collapse";
                            one_comment.remove();
                            console.dir(commits);
                        });

                    break;

                    // Ответ на комментарий ======================================================================================================================
                case '4':

                    let coment_id4 = event.target.getAttribute('coment_id');
                    let replu_hidden = document.getElementById('replu_hidden');
                    let reply = document.getElementById('reply' + coment_id4);
                    // console.dir(coment_id);
                    // let comment_i = document.getElementById('comment_i' + coment_id);
                    // console.dir(comment_i);
                    let text_reply_div = document.getElementById('text_reply_div' + coment_id4).textContent;
                    let coment_reply_collapse = document.getElementById('coment_reply_collapse' + coment_id4);
                    // // console.dir(coment_id);
                    let formData4 = new FormData(document.getElementById("form_reply_comment" + coment_id4));
                    formData4.append("reply", text_reply_div);
                    // console.dir(formData4);


                    if (true) {
                        fetch('/reply_comment/', {
                                method: 'POST',
                                headers: {
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: formData4
                            })
                            .then(response => response.json())
                            .then(commits => {
                                 console.dir(commits);
                                 let clone_replu = replu_hidden.cloneNode(true);
                                 clone_replu.querySelector('b').textContent = commits['user_name'] + ' ';
                                 clone_replu.querySelector('nobr').textContent = new Date().toLocaleString().slice(0, - 10) + ' ';
                                 clone_replu.querySelector('#comment_i').textContent = commits['reply'];
                                 clone_replu.querySelector('#comment_i').id = "comment_i" + commits['id'];
                                 clone_replu.querySelector('#hidden_reply_collapse_edit').href = "#reply_collapse_edit" + commits['id'];
                                 clone_replu.querySelector('#reply_collapse_edit').id = "reply_collapse_edit" + commits['id'];
                                 clone_replu.querySelector('#hidden_reply_collapse').href = "#reply_collapse" + commits['id'];
                                 clone_replu.querySelector('#reply_collapse').id = "reply_collapse" + commits['id'];

                                 clone_replu.id = 'reply_clon';
                                reply.appendChild(clone_replu);

                                coment_reply_collapse.className = "collapse";
                                // comment_i.textContent = commits['comment'];
                            });
                    } else {
                        alert("Напишите комений");
                    }

                    break;




            }
        });


        {{-- ===================================================================   ОТПРАВКА ЛАЙКА  ================================================================================== --}}

        let lik = null;
        wrapper.addEventListener('click', (event) => {
            const isButton = event.target.nodeName === 'I';
            let type_element_like = event.target.getAttribute('value');
            let post_id = event.target.getAttribute('post_id');
            let litr = document.getElementById("butlike" + post_id)
            let user_name_id = document.getElementById("user_name_id").textContent;
            if (isButton && type_element_like != 'www') {
                // console.dir(user_name_id);

                if (user_name_id == 0) alert("Зарегистрируйтесь");
                else {

                    if (type_element_like == 1) { // лайк на пост  
                        let like = event.target.textContent;

                        // console.dir(litr);
                        fetch('/likes/?post_id=' + post_id + '&id_user=' + user_name_id)
                            .then(response => response.json())
                            .then(commits => {
                                if (commits == 1) {
                                    lik = +like + 1;
                                    litr.className = "bi bi-hand-thumbs-up-fill";
                                } else if (commits == 0 && like != 0) {
                                    lik = +like - 1;
                                    litr.className = "bi bi-hand-thumbs-up";
                                }
                                event.target.textContent = ' ' + lik;

                            });
                    }


                    if (type_element_like == 3) { // лайки на комментарии
                        let like_comment_content = +event.target.textContent;
                        let comment_id = event.target.getAttribute('comment_id');
                        fetch('/like_comment/?comment_id=' + comment_id + '&id_user=' + user_name_id)
                            .then(response => response.json())
                            .then(commits => {
                                // console.dir(commits);
                                if (commits == 1) {
                                    event.target.textContent = ' ' + (like_comment_content + 1);
                                    event.target.className = "bi bi-hand-thumbs-up-fill";
                                } else if (commits == 0 && like_comment_content != 0) {
                                    event.target.textContent = ' ' + (like_comment_content - 1);
                                    event.target.className = "bi bi-hand-thumbs-up";
                                }
                            });
                    }

                    if (type_element_like == 4) { // дизлайки на коментарии
                        let dislike_comment_content = +event.target.textContent;
                        let comment_id = event.target.getAttribute('comment_id');
                        fetch('/dislike_comment/?comment_id=' + comment_id + '&id_user=' + user_name_id)
                            .then(response => response.json())
                            .then(commits => {
                                // console.dir(commits);
                                if (commits == 1) {
                                    event.target.textContent = ' ' + (dislike_comment_content + 1);
                                    event.target.className = "bi bi-hand-thumbs-down-fill";
                                } else if (commits == 0 && dislike_comment_content != 0) {
                                    event.target.textContent = ' ' + (dislike_comment_content - 1);
                                    event.target.className = "bi bi-hand-thumbs-down";
                                }
                            });
                    }



                }

            }
        })
    </script>





</body>

</html>
