<!DOCTYPE html>

<html lang="ru">

<head>
  <meta charset="utf-8">
  <title>Автоэлектрики</title>
  <link rel="shortcut icon" href="favicon.ico">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Профпортал Автоэлектрики">
  <script src="bootstrap.js" integrity="" crossorigin="anonymous"></script>
  <link href="bootstrap.css" rel="stylesheet">
  <link rel="stylesheet" href="bootstrap-icons-1.10.5/font/bootstrap-icons.min.css">
</head>

<body>

  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-2 "></div>

      <div class="col ">


      <nav class="navbar navbar-expand-lg  fixed-top navbar bg-primary" data-bs-theme="dark">
          <div class="container-fluid">
            <a class="navbar-brand" href="#">Автоэлектрики</a>
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
            <a class="nav-link active ">Привествуем {{Auth::user()->name}} !</a>
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

        <div class=" my-3 py-3"></div> {{--отодвигатор--}}

      <form method="POST" action="{{ route('authentication') }}">
  @csrf
  <div class="mb-3">

    @error('email')
    <div>ошибка {{ $message }}</div>
  @enderror



    <label for="exampleInputEmail1" class="form-label">Адрес электронной почты</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">

  </div>
  <div class="mb-3">

    @error('password')
    <div>ошибка {{ $message }}</div>
  @enderror



    <label for="exampleInputPassword1" class="form-label">Пароль</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
  </div>

  <button type="submit" class="btn btn-primary">Отправить</button>
</form>

      </div>

      <div id=li class="col-lg-2 "></div>
      </div>
      </div>


