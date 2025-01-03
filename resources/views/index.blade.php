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
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
rel="stylesheet" -->
  <link rel="stylesheet" href="bootstrap-icons-1.10.5/font/bootstrap-icons.min.css">
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



        <!-- <img src="storage/app/bot/images/7124124425-1735118651.jpg" class="img-fluid" alt="..."> -->
        <div id='wrapper'>

          @foreach ($posts as $post)

        <div class="card  mb-3  shadow ">
        <div class=" card-header text-muted py-1 p-lg-3">
          <div class="row">
          <!-- <div class="col-auto p-0 px-lg-3 "><a class="link-underline-light" href="#"> <i
      class="bi bi-card-text" value="www"></i> {{ $post->id}} </a> </div> -->
          <div class="col-auto me-auto p-0 "><i class="bi bi-clock p-lg-1" value="www"> </i>@php echo
            date('d-m-Y',
            strtotime($post->created_at)); @endphp </div>

          <div class="col-auto p-0"> <a class="link-underline-light" href="#"> <i class="bi bi-geo-alt"
              value="www"></i>{{'Алматы'}}</a> </div>

          <div class="col-auto p-0 ps-1 px-lg-3 "> <a class="link-underline-light" href="#collapseExample1"><i
              class="bi bi-universal-access ms-auto" value="www"></i>{{$post->user_name}} </a> </div>


          </div>
        </div>
        <div class="card-body px-1 px-lg-5 py-1">
          <h5 class="card-title">{{ $post->name_post}}</h5>
          <div class="card-body px-0 mx-lg-5 px-lg-5 py-0">
          <div class="card-body px-0 mx-lg-5 px-lg-5 py-0">
            <img class=" img-fluid shadow " src="{{ $post->url_foto}}" alt="Фото потерялось">
          </div>
          </div>


          <div class="card-text"> {{ $e = Str::limit($post->text_post, 300) }}
          <a class="link-underline-light p-0" href="#collapseExample1" data-bs-toggle="collapse"
            data-bs-target="#collapseExample{{$post->id}}{{ $loop->iteration }}" aria-expanded="false"
            aria-controls="collapseExample"> развернуть </a>
          </div>

          <div class="collapse p-0" id="collapseExample{{$post->id}}{{ $loop->iteration }}">
          <div class=" p-1">


            <div class="card-text"> {{'...'}} {{ Str::unwrap($post->text_post, Str::before($e, '...')) }}</div>
            @if ($post->url_foto_2 !== null)
        <div class="card-body px-0 mx-lg-5 px-lg-5 py-0">
        <div class="card-body px-0 mx-lg-5 px-lg-5 py-0">
          <img class=" img-fluid shadow " src="{{ $post->url_foto_2}}" alt="Фото потерялось">
        </div>
        </div>
        <p class="card-text"> {{ $post->text_post_2}}</p>
      @endif
            @if ($post->url_foto_3 !== null)
        <div class="card-body px-0 mx-lg-5 px-lg-5 py-0">
        <div class="card-body px-0 mx-lg-5 px-lg-5 py-0">
          <img class=" img-fluid shadow " src="{{ $post->url_foto_3}}" alt="Фото потерялось">
        </div>
        </div>
        <p class="card-text "> {{ $post->text_post_3}} <a class="link-underline-light p-0"
          href="#collapseExample1" data-bs-toggle="collapse"
          data-bs-target="#collapseExample{{$post->id}}{{ $loop->iteration }}" aria-expanded="false"
          aria-controls="collapseExample"> &nbsp &nbsp свернуть </a></p>
      @endif

          </div>
          </div>
        </div>

        <div class="card-footer text-muted p-1 p-lg-3 ">
          <div class="row">
          <!-- ЛАЙК -->
          <div class="col-auto pe-2"> <a class="link-underline-light" style="cursor: pointer;"> <i
              id='butlike{{$post->id}}' value="{{$post->id}}" class="bi bi-hand-thumbs-up">
              {{$post->like}}</i></a>
          </div>
          <!-- РЕПОСТ -->
          <div class="col-auto me-auto p-0">
            <a class="link-underline-light" href="#collapseExample1" data-bs-toggle="collapse"
            data-bs-target="#collapse{{$post->id}}" aria-expanded="false" aria-controls="collapseExample">
            <i class="bi bi-share" value="www"></i></i>
            Поделится
            </a>
          </div>
          <!-- КОМЕНТАРИИ КНОПКА -->
          <div class="col-auto">
            <a class="link-underline-light p-0" href="#collapseExample1" data-bs-toggle="collapse"
            data-bs-target="#collapseExample{{$post->id}}" aria-expanded="false"
            aria-controls="collapseExample"><i class="bi bi-chat-dots" value="www"></i></i> Коментарии 23 </a>
          </div>
          </div>

          <div class="collapse py-0" id="collapse{{$post->id}}">
          <div class="card card-body px-3 py-1">
            <div class="row p-0">
            <div class="col-auto px-1"><a class="link-underline-light" href="#"> <i class="bi bi-card-text"
                value="www"> Пост </i> {{ $post->id}} </a> </div>

            <div class="col-auto px-1"><a class="link-underline-light" href="#"> <i class="bi bi-telegram"
                value="www"> Телеграмм</i></a> </div>

            <div class="col-auto px-1"><a class="link-underline-light" href="#"> <i class="bi bi-whatsapp"
                value="www"> Whatsapp</i> </a> </div>
            </div>
          </div>
          </div>

          <div class="collapse p-0" id="collapseExample{{$post->id}}">
          <div class="card card-body p-1">
            <form id="form{{$post->id}}" val="{{$post->id}}">
            <div class="row">
              <div class="col-auto me-auto pe-0 flex-fill">
              <input type="text" name="comment" class="form-control" placeholder="Напишите комментарий">
              <input type="hidden" name="post_id" value="{{$post->id}}">
              <input type="hidden" name="user_name" value="{{$post->user_name}}">
              <input type="hidden" name="id_user" value="{{$post->id_user}}">
              </div>
              <div class="col-auto  ps-0">
              <button class="btn btn-primary" type="submit"><i class="bi bi-arrow-return-left"
                value="www"></i></button>
              </div>
            </div>
            </form>
            @foreach ($comments as $comment)
        <li>{{$comment->comment}}</li>
      @endforeach

            <div class="col-auto">
            <a class="link-underline-light p-0" href="#collapseExample1" data-bs-toggle="collapse"
              data-bs-target="#collapseExample{{$post->id}}" aria-expanded="false"
              aria-controls="collapseExample"><i class="bi bi-chat-dots" value="www"></i></i> Свернуть </a>
            </div>

          </div>
          </div>

        </div>
        </div>

      @endforeach
        </div>


      </div>
      <div id=li class="col-lg-2 ">





        <script>
          const wrapper = document.getElementById('wrapper');
          wrapper.addEventListener('submit', function (event) {
            event.preventDefault();
            let val = event.target.getAttribute('val');
            let formData = new FormData(document.getElementById("form" + val));
            fetch('/comments/', {
              method: 'POST',
              headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{csrf_token()}}'
              },
              body: formData
            })
          })
          // id_post
          let lik = null;
          wrapper.addEventListener('click', (event) => {
            const isButton = event.target.nodeName === 'I';
            let li = event.target.getAttribute('value');
            if (isButton && li != 'www') {
              let like = event.target.textContent;
              fetch('/likes/?post_id=' + li + '&id_user={{Auth::user()->name}}')
                .then(response => response.json())
                .then(commits => {
                  if (commits == 1) {
                    lik = +like + 1;
                  } else if (commits == 0 && like != 0) {
                    lik = +like - 1;
                  }
                  event.target.textContent = ' ' + lik;
                  console.dir(commits);
                });
            }
          })
        </script>

      </div>
    </div>

  </div>
</body>

</html>