<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Автоэлектрики</title>
    <link rel="shortcut icon" href="{{ url('favicon.ico') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Профпортал Автоэлектрики">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <script src="{{ url('bootstrap.min.js') }}" integrity="" crossorigin="anonymous"></script> --}}
    <script src="{{ url('bootstrap.bundle.js') }}" integrity="" crossorigin="anonymous"></script>
    <link href="{{ url('bootstrap.css') }}" rel="stylesheet">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"> --}}



    <link rel="stylesheet" href="{{ url('bootstrap-icons-1.10.5/font/bootstrap-icons.min.css') }}">

</head>

<body>

    {{-- d-xl-none --}}

    <nav class="navbar navbar-expand-xl fixed-top  " data-bs-theme="dark"  style = "background-color : #00496E">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">Автоэлектрики</a>

            <button id="info_bell" class="navbar-toggler ms-auto @if(!empty($nots)) border-danger @endif"
                data-bs-target="#navbarSupportedContent" data-bs-toggle="collapse" >
                <span class="navbar-toggler-icon"></span>
            </button>
  
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0 ms-auto">
                    <li class="nav-item ">
                        @guest
                            <a class="nav-link active " href="{{ route('register') }}">Привествуем гость!</a>
                        @endguest
                        @auth
                            <a class="nav-link active ">Привествуем {{ Auth::user()->name }} !</a>
                        @endauth
                    </li>
                    <li class="nav-item dropdown " data-bs-theme="light"  >
                        @auth
                        <a id="bell" class="nav-link active @if(!empty($nots)) link-danger @endif bi bi-bell-fill"  href="#" role="button" data-bs-toggle="dropdown" onclick="bell()"></a>
                        <ul class="dropdown-menu dropdown-menu-end " >
                            @isset($nots)
                            @foreach($nots as $not)
                            <a class="nav-link text-black mx-2 border my-1" href="{{url('/post/'.$not['post_id'])}}">
                            <li>{{$not['type']}}</li>
                            <li>{{Str::limit($not['message'] , 18)}}</li></a>
                            @endforeach
                            @endisset
                            <li> <a class="dropdown-item "
                                href="{{ route('cabinet_notification') }}">Все уведомления</a></li>
                            </ul>
                            @endauth
                    </li>
                    <li class="nav-item ">
                        @auth
                            <a class="nav-link active " aria-current="page"
                                href="{{ route('cabinet_settings') }}">Кабинет</a>
                        @endauth
                        @guest
                            <a class="nav-link active " href="{{ route('login') }}">Вход</a>
                        @endguest
                    </li>
                    <li class="nav-item ">
                        @guest
                            <a class="nav-link active " href="{{ route('register') }}">Регистрация</a>
                        @endguest
                    
                    </li>
                    <li class="nav-item ">
                        @auth
                            <a class="nav-link active " aria-current="page"
                                href="{{ route('channel', Auth::user()->id) }}">Канал</a>
                        @endauth
                    </li>
                    <li class="nav-item ">
                        @auth
                            {{-- @if (Auth::user()->id == 2) --}}
                                <a class="nav-link active " href="{{ route('admin_index') }}">admin</a>
                            {{-- @endif --}}
                        @endauth
                    </li>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid p-1 overflow-x-hidden">
        <div class="row ">
            <div class="col-xl-2 "></div>
            <div class="col  p-3 px-2">
                <div class=" my-2 py-3"></div>
                <div id='content' class="">
                    @yield('posts')
                </div>
            </div>
            <div class="col-xl-2 "> </div>
        </div>
    </div>

    @yield('hidden')

    <div id="user_name_id" hidden> @auth {{ Auth::user()->name }}
        @else
        0 @endauth </div>
        <div id="user_id" hidden>@auth{{Auth::user()->id}}@else 0 @endauth</div>

    <div id="csrf_token" hidden> @auth {{ csrf_token() }}
        @else
        0 @endauth </div>

    <div id="server_url" hidden>{{ url('/') }}</div>

  <!-- Модальное окно жалоб одно для всех заполняется в public/client.js function complaint -->
  <div class="modal fade" id="modal_complaint" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 id="h1_text_modal" class="modal-title fs-5" id="exampleModalLabel">Ж на пост</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
        </div>
        <div class="modal-body">
            <form  form_type="10">
                <input id="hidden_input_complaint" type="hidden" name="id_pcr" value="">
                <input id="hidden_input_complaint_2" type="hidden" name="essence" value="">
                <input id="hidden_input_complaint_3" type="hidden" name="id_user_complaint" value="">
                <input id="hidden_input_complaint_4" type="hidden" name="id_user_untrue" value="">
                <input id="hidden_input_complaint_5" type="hidden" name="id_post" value="">
                <label class="form-label ">Напишите суть, оскорбления, ругань, флуд, реклама и пр.</label>
                <input id="input_complaint" class="form-control my-1" type="text" name="complaint" placeholder = "Опишите в несколько слов" >
        </div>
        <div class="modal-footer">
            <input class="btn btn-primary btn-sm my-1" type="submit" data-bs-dismiss="modal">
        </form>
        </div>
      </div>
    </div>
  </div>




    @yield('js')
</body>

<script>
function bell() { // меняем цвет колокольчика с красного на белый при нажатии на него
    document.getElementById('bell').setAttribute('class', "text-white nav-link active bi bi-bell-fill");
document.getElementById('info_bell').setAttribute('class', "navbar-toggler ms-auto");
    
}</script>

</html>
