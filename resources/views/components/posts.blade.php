<div id='wrapp'>
    @foreach ($posts as $post)
        <div class="card  mb-3  shadow ">
            <div class=" card-header text-muted py-1 p-lg-3">
                <div class="row">

                    <div class="col-auto me-auto p-0 "><i class="bi bi-clock p-lg-1" value="www">
                        </i>@php echo date('d-m-Y', strtotime($post->created_at)); @endphp </div>

                    <div class="col-auto p-0"> <a class="link-underline-light" href="#"> <i class="bi bi-geo-alt"
                                value="www"></i>{{ 'Алматы' }}</a> </div>

                    <div class="col-auto p-0 ps-1 px-lg-3 "> <a class="link-underline-light" target="_blank"
                            href="{{route('channel_show', $post->id_user)}}"><i class="bi bi-universal-access ms-auto"
                                value="www"></i>{{ $post->user_name }} </a> </div>
                </div>
            </div>
            <div class="card-body px-1 px-lg-5 py-1">
                <h5 class="card-title">{{ $post->name_post }}</h5>
                <div class="card-body px-0 mx-lg-5 px-lg-5 py-0">
                    <div class="card-body px-0 mx-lg-5 px-lg-5 py-0">
                        <img class=" img-fluid shadow " src="{{ url($post->url_foto) }}" alt="Фото потерялось">
                    </div>
                </div>

                <div class="card-text"> {{ $e = Str::limit($post->text_post, 300) }}
                    <a class="link-underline-light p-0" href="#collapseExample1" data-bs-toggle="collapse"
                        data-bs-target="#collapseExample{{ $post->id }}{{ $loop->iteration }}" aria-expanded="false"
                        aria-controls="collapseExample"> развернуть </a>
                </div>

                <div class="collapse p-0" id="collapseExample{{ $post->id }}{{ $loop->iteration }}">
                    <div class=" p-1">

                        <div class="card-text"> {{ '...' }}
                            {{ Str::unwrap($post->text_post, Str::before($e, '...')) }}
                        </div>
                        @if ($post->url_foto_2 !== null)
                            <div class="card-body px-0 mx-lg-5 px-lg-5 py-0">
                                <div class="card-body px-0 mx-lg-5 px-lg-5 py-0">
                                    <img class=" img-fluid shadow " src="{{ url($post->url_foto_2) }}"
                                        alt="Фото потерялось">
                                </div>
                            </div>
                            <p class="card-text"> {{ $post->text_post_2 }}</p>
                        @endif
                        @if ($post->url_foto_3 !== null)
                            <div class="card-body px-0 mx-lg-5 px-lg-5 py-0">
                                <div class="card-body px-0 mx-lg-5 px-lg-5 py-0">
                                    <img class=" img-fluid shadow " src="{{ url($post->url_foto_3) }}"
                                        alt="Фото потерялось">
                                </div>
                            </div>
                            <p class="card-text "> {{ $post->text_post_3 }} <a class="link-underline-light p-0"
                                    href="#collapseExample1" data-bs-toggle="collapse"
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
                    <div class="col-auto pe-2">&nbsp;<a class="link-underline-light" title="Поставить лайк"
                            style="cursor: pointer;"> <i id='butlike{{ $post->id }}' value="1"
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
                            data-bs-target="#collapseExample{{ $post->id }}" aria-expanded="false"
                            aria-controls="collapseExample"><i class="bi bi-chat-dots" value="www"></i></i>
                            Коментарии
                            <i id="comm_count{{ $post->id }}">{{ $post->post_comment_count }}</i>&nbsp;</a>
                    </div>
                </div>
                {{-- РЕПОСТЫ  ===================================================================================================================================================== --}}
                <div class="collapse py-0" id="collapse{{ $post->id }}">
                    <div class="card card-body px-3 py-1">
                        <div class="row p-0">
                            <div class="col-auto px-1"><a class="link-underline-light" href="#"> <i
                                        class="bi bi-card-text" value="www"> Пост
                                    </i> {{ $post->id }} </a> </div>
                            <div class="col-auto px-1"><a class="link-underline-light" href="#"> <i
                                        class="bi bi-telegram" value="www">
                                        Телеграмм</i></a> </div>

                            <div class="col-auto px-1"><a class="link-underline-light" href="#"> <i
                                        class="bi bi-whatsapp" value="www">
                                        Whatsapp</i> </a> </div>
                        </div>
                    </div>
                </div>
                {{-- ФОРМА ВВОДА КОММЕНТАРИЕВ  ===================================================================================================================================================== --}}
                <div class="collapse p-0" id="collapseExample{{ $post->id }}">
                    <div class="card card-body p-1 ">
                        <form post_id="{{ $post->id }}" form_type="1">

                            <div text_div class="card card-body p-1 " id="text_div_post{{ $post->id }}"
                                contenteditable="true" data-placeholder="Напишите комментарий"></div>

                            <div class="row p-1 ">
                                <div class="col-7 me-auto  flex-fill ">
                                    <i class="bi bi-emoji-smile h3 " data-bs-toggle="collapse"
                                        href="#collapse_post_smile{{ $post->id }}" role="button"
                                        aria-expanded="false" aria-controls="collapseExample"> </i>

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
                        <x-comments :post="$post"/>
                        <!-- ==================================== КНОПКА СВЕРНУТЬ В КОНЦЕ КОММЕНТОВ ====================================== -->

                        <div class="col-auto">
                            <div class="row">
                                <div class="col-auto me-auto pe-0 flex-fill">
                                </div>
                                <div class="col-auto  ps-0">
                                    <a class="link-underline-light p-0" href="#collapseExample1"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseExample{{ $post->id }}" aria-expanded="false"
                                        aria-controls="collapseExample"><i class="bi bi-chat-dots"
                                            value="www"></i></i> Свернуть
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



