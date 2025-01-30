<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Автоэлектрики</title>
    <link rel="shortcut icon" href="{{ url('favicon.ico') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Профпортал Автоэлектрики">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ url('bootstrap.min.js') }}" integrity="" crossorigin="anonymous"></script>
    <link href="{{ url('bootstrap.css') }}" rel="stylesheet">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
rel="stylesheet" -->
    <link rel="stylesheet" href="{{ url('bootstrap-icons-1.10.5/font/bootstrap-icons.min.css') }}">

</head>

<body>



                <nav class="navbar navbar-expand-xl fixed-top bg-primary " data-bs-theme="dark">
                    <div class="container-fluid ">
                        <a class="navbar-brand" href="{{ url('/') }}">Автоэлектрики</a>
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
                                    {{-- @auth
                                        <a class="nav-link active " aria-current="page" href="#">Главная</a>
                                    @endauth --}}
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

                <div class="container-fluid p-1 overflow-x-hidden">
                    <div class="row ">
                        
                        <div class="col-xl-2 "></div>
            
                        <div class="col  p-xl-3 px-2">
                            <div class=" my-3 py-3"></div>



                          

                
                <div id='content' class="">
 @yield('posts')  

</div></div>

<div  class="col-xl-2 "> </div>
</div></div>

@yield('hidden') 

<div id="user_name_id" hidden> @auth {{ Auth::user()->name }}
        @else
        0 @endauth </div>

<div id="csrf_token" hidden> @auth {{ csrf_token() }}
        @else
        0 @endauth </div>

        <div id="server_url" hidden>{{ url('/') }}</div>

      


<script defer src="{{ url('client2.js') }}"></script>
<script defer src="{{ url('client.js') }}"></script>
</body>
</html>
