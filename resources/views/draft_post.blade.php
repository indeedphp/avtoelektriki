@extends('layouts/main')

@section('posts')
    <div class="card  mb-3  shadow ">
        <div class=" card-header text-muted py-1 p-lg-3">
            <div class="row">
                <!-- МЕСТОПОЛОЖЕНИЕ -->
                <div class="col-auto me-auto p-0 px-lg-3">
                    <i class="bi bi-geo-alt"> Алматы </i>
                </div>
                <!-- ИМЯ ПОЛЬЗОВАТЕЛЯ -->
                <div class="col-auto p-0 pe-1 px-lg-3 ">
                    <i class="bi bi-universal-access ms-auto " style="text-decoration: none"> {{ $post->user_name }} </i>
                </div>

            </div>
        </div>
        <div class="card-body px-1 px-lg-5 mx-lg-5 py-2 ">
            <div class="pb-2">
                <!-- ДАТА -->
                <i class="bi bi-clock pe-3 p-lg-3 text-black-80"> @php echo date('d-m-Y', strtotime($post->updated_at)); @endphp </i>
                <!-- ИМЯ ПОСТА -->
                <b class="card-title pb-5 h5">{{ $post->name_post }}</b>

            </div>
            <div class="card-body px-0  px-lg-5 py-0">
                <div class="row">
                    <!-- ФОТО_1 -->
                    <div class="col-lg-10 ">
                        <img class="img-fluid shadow" src="@if($post->url_foto == null){{url('plug.jpg')}}@else{{url($post->url_foto)}}@endif">
                    </div>
                    <!-- МИНИ ФОТКИ -->
                    <div id="foto" class="d-none d-lg-block  col-lg-2 p-0">
                        @if ($post->url_foto_2 !== null)
                        <img class="img-fluid shadow" src="{{ url($post->url_foto_2) }}">
                        @endif
                        @if ($post->url_foto_3 !== null)
                        <img class="img-fluid shadow mt-2" src="{{ url($post->url_foto_3) }}">
                        @endif
                    </div>

                </div>
            </div>
            <!-- ТЕКСТ ПОД ФОТО 1 -->
            <div class="card-text pt-2">
                <div class="px-1">{{ $post->text_post }}</div>
            </div>
            <div class=" pt-3">
            <!-- ФОТО 2 И ТЕКСТ -->
            @if ($post->url_foto_2 !== null)
                <div class="card-body px-1 px-lg-2  py-3">
                    <div class="card-body px-0  px-lg-5 py-0">
                        <img class=" img-fluid shadow " src="{{ url($post->url_foto_2) }}">
                    </div>
                    <p class="card-text py-2">{{ $post->text_post_2 }}</p>
                </div>
            @endif
            <!-- ФОТО 3 И ТЕКСТ -->
            @if ($post->url_foto_3 !== null)
                <div class="card-body px-1 px-lg-2  py-1">
                    <div class="card-body px-0  px-lg-5 py-0">
                        <img class=" img-fluid shadow " src="{{ url($post->url_foto_3) }}">
                    </div>
                    <p class="card-text py-2">{{ $post->text_post_3 }}</p>
                </div>
            @endif

        </div>
        </div>
        <div class="card-footer text-muted px-0 py-1 p-lg-3 ">
            <div class="row">
                <!-- ЛАЙК -->
                <div class="col-auto pe-2 text-black-80">
                    <i class="bi bi-hand-thumbs-up ps-1"> 0</i>&nbsp;
                </div>
                <!-- РЕПОСТ -->
                <div class="col-auto me-auto ps-0">
                    <i class="bi bi-share text-black-80"> Поделится</i>
                </div>
                <!-- КОМЕНТАРИИ КНОПКА -->
                <div class="col-auto">
                    <i class="bi bi-chat-dots text-black-80"> Комментарии </i>
                </div>

            </div>
        </div>
    </div>
@endsection
