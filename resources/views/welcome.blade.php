<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Цветовая палитра на Canvas</title>
    <script src="{{ url('bootstrap.bundle.js') }}" integrity="" crossorigin="anonymous"></script>
    <link href="{{ url('bootstrap.css') }}" rel="stylesheet">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"> --}}



    <link rel="stylesheet" href="{{ url('bootstrap-icons-1.10.5/font/bootstrap-icons.min.css') }}">
</head>

<body>

    <nav class="navbar navbar-expand-xl fixed-top  " data-bs-theme="dark"  style = "background-color : #00496E">
        <div class="container-fluid ">
            <a class="navbar-brand" href="{{ url('/') }}">Автоэлектрики</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Переключатель навигации">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse right-aligned-div" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 ">
           
                    <li class="nav-item ms-auto">
                        @guest
                            <a class="nav-link active " href="{{ route('register') }}">Привествуем гость!</a>
                        @endguest
                        @auth
                            <a class="nav-link active ">Привествуем {{ Auth::user()->name }} !</a>
                        @endauth
                    </li>
                    <li class="nav-item dropdown ms-auto" data-bs-theme="light">
                        @auth
                        <a class="nav-link  link-danger  bi bi-bell-fill" data-bs-theme="white" href="#" role="button" data-bs-toggle="dropdown"></a>
                        <ul class="dropdown-menu" >
                            <li><a class="dropdown-item" href="#">Действие</a></li>
                            <li><a class="dropdown-item" href="#">Другое действие</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Что-то еще здесь</a></li>
                          </ul>
                        @endauth
                    </li>

             

                    <li class="nav-item ms-auto">
                        @auth
                            <a class="nav-link active " aria-current="page"
                                href="{{ route('cabinet_settings') }}">Кабинет</a>
                        @endauth
                        @guest
                            <a class="nav-link active " href="{{ route('login') }}">Вход</a>
                        @endguest
                    </li>
                    <li class="nav-item ms-auto">
                        @guest
                            <a class="nav-link active " href="{{ route('register') }}">Регистрация</a>
                        @endguest
                    
                    </li>
                    <li class="nav-item ms-auto">
                        @auth
                            <a class="nav-link active " aria-current="page"
                                href="{{ route('channel', Auth::user()->id) }}">Канал</a>
                        @endauth
                    </li>
                    <li class="nav-item ms-auto">
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

</body>

</html>

<br>
<br><br>


<div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
      Кнопка выпадающего списка
    </button>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="#">Действие</a></li>
      <li><a class="dropdown-item" href="#">Другое действие</a></li>
      <li><a class="dropdown-item" href="#">Что-то еще здесь</a></li>
    </ul>
  </div>







  <nav class="navbar navbar-expand-xl fixed-top  " data-bs-theme="dark"  style = "background-color : #00496E">
 
  
        <a class="navbar-brand  " href="{{ url('/') }}">Автоэлектрики</a>

  

        <button class="navbar-toggler  me-3" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Переключатель навигации">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse float-end" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0 ">
               
          
                   
                <li class="nav-item ms-auto">
                    @guest
                        <a class="nav-link active " href="{{ route('register') }}">Привествуем гость!</a>
                    @endguest
                    @auth
                        <a class="nav-link active ">Привествуем {{ Auth::user()->name }} !</a>
                    @endauth
                </li>
                {{-- <li class="nav-item dropdown ms-auto d-none d-lg-block" data-bs-theme="light"  >
                   
                    @auth
                    <a class="nav-link active @if(!empty($nots)) link-danger @endif bi bi-bell-fill" id="bell" href="#" role="button" data-bs-toggle="dropdown" onclick="bell()"></a>
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
                    </li> --}}
    
                <li class="nav-item ms-auto">
                    @auth
                        <a class="nav-link active " aria-current="page"
                            href="{{ route('cabinet_settings') }}">Кабинет</a>
                    @endauth
                    @guest
                        <a class="nav-link active " href="{{ route('login') }}">Вход</a>
                    @endguest
                </li>
                <li class="nav-item ms-auto">
                    @guest
                        <a class="nav-link active " href="{{ route('register') }}">Регистрация</a>
                    @endguest
                
                </li>
                <li class="nav-item ms-auto">
                    @auth
                        <a class="nav-link active " aria-current="page"
                            href="{{ route('channel', Auth::user()->id) }}">Канал</a>
                    @endauth
                </li>
                <li class="nav-item ms-auto">
                    @auth
                        {{-- @if (Auth::user()->id == 2) --}}
                            <a class="nav-link active " href="{{ route('admin_index') }}">admin</a>
                        {{-- @endif --}}
                    @endauth
                </li>
                </li>
            </ul>
        </div>
  
   

</nav>