<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="shortcut icon"href="images/myicon.ico">
  <meta charset="utf-8">
  <title>toSenior_PHP</title>
  <script src="bootstrap.js" integrity="" crossorigin="anonymous"></script>
  <link href="bootstrap.css" rel="stylesheet">
</head>
<body>


<div class="container-fluid">
  <div class="row">
    <div class="col-lg-2 ">
  
    </div>
    <div class="col ">
    

    
   

<nav class="navbar navbar-expand-lg  fixed-top navbar bg-primary" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Автоэлектрики</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Переключатель навигации">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse right-aligned-div" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 ">
      <li class="nav-item ms-auto">
        @guest
        <a class="nav-link active " href="{{ route('register') }}" >Привествуем гость!</a>
        @endguest
        @auth
        <a class="nav-link active ">Привествуем {{Auth::user()->name}} !</a>
        @endauth
        </li>
        <li class="nav-item ms-auto">
        @auth
          <a class="nav-link active " aria-current="page" href="#">Главная</a>
          @endauth
          @guest
          <a class="nav-link active " href="{{ route('login') }}" >Вход</a>
          @endguest
        </li>
        <li class="nav-item ms-auto">
        @guest
        <a class="nav-link active " href="{{ route('register') }}" >Регистрация</a>
        @endguest
        @auth
        <a class="nav-link active " href="{{ route('logout') }}" >Выход</a>
        @endauth
        </li>
        
        </li>



       </ul>
 
    </div>
  </div>
</nav>

<div class=" my-4 py-3"></div> {{--отодвигатор--}}
 


@foreach ($posts as $post)

<div class="card  mb-3  shadow ">
  <div class="card-header">
  
  {{ $post->name_post}}
  </div>
  <div class="card-body">
    <h5 class="card-title">Особое обращение с заголовком</h5>
    <img src="{{ $post->url_foto}}"  height="255" alt="lorem">
    <p class="card-text"> {{ $post->text_post}}</p>

  </div>
  <div class="card-footer text-muted">
    2 дня спустя
  </div>
</div>

@endforeach


</div>
    <div class="col-lg-2 ">
   
    </div>
  </div>

</div>



