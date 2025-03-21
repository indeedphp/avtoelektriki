 <!DOCTYPE html>

 <html lang="en">

 <head>
     <meta charset="utf-8">
     <title>Автоэлектрики</title>
     <link rel="shortcut icon" href="{{ url('favicon.ico') }}">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta name="description" content="{{ $site->meta_1 }}">
     <link rel="image_src" href="">
     <link href="{{ url('bootstrap.css') }}" rel="stylesheet">

 </head>

 <body style = "background-color : #{{ $site->color_body }}">


     <div class="container-fluid fixed-top rounded p-1" style = "background-color : #{{ $site->color_head }}";>
         <div class="row ">

             <div class="col-sm-6 d-flex justify-content-center ps-lg-5">
                 <p class="text-white ps-lg-5 h3">{{ $site->heading }}</p>
             </div>
             <div class="col-sm-5 d-flex justify-content-center ps-lg-5">
                 @if ($site->phone_1 != null)
                     <h4 class=" text-white ps-lg-5"> <a class=" text-white ps-lg-5" href="tel:{{ $site->phone_1 }}"
                             rel="nofollow"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                 fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                                 <path
                                     d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z" />
                             </svg> {{ $site->phone_1 }}</a></h4>
                 @endif
             </div>

         </div>
     </div>

     <div class="container-fluid p-1 overflow-x-hidden">
         <div class="row ">

             <div class="col-xl-2 "></div>

             <div class="col ">
                 @if ($site->phone_1 != null)
                     <div class=" my-3 py-3 "></div>
                 @else
                     <div class=" my-2 py-2 ">
                 @endif

                 <div class="d-block d-sm-none  my-2 py-1"></div>


                 <div>
                     <h4 class=" fw-normal ">{{ $site->top_text }}</h4>
                 </div>

                 <div class="card mb-3 my-lg-4 shadow">
                     <div class="card-header" style = "background-color : #{{ $site->color_card }}">


                         <h4 class="my-0 fw-normal text-white">{{ $site->text_1_a }}</h4>
                     </div>
                     <div class="card-body p-1" style = "background-color : #{{ $site->color_back }}">

                         <div class="card-body px-0 mx-lg-5 px-lg-5 py-0">
                             <img class="mt-lg-3 img-fluid shadow rounded " src="{{ url($site->foto_1) }}"
                                 alt="Фото потерялось">
                         </div>
                         <p class="card-text p-2 py-lg-4 px-lg-5">
                            @php
                            $text_1_b = preg_replace_callback(
                                '/https?\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/',
                                function ($matches) {
                                    return '<a href="' . $matches[0] . '" target="_blank">' . $matches[0] . '</a>';
                                },
                                $site->text_1_b
                            );
                        @endphp
                        {!! $text_1_b !!}
                         </p>
                     </div>
                 </div>

                 <div class="card mb-3 my-lg-4  shadow">
                     <div class="card-header" style = "background-color : #{{ $site->color_card }}";>
                         <h4 class="my-0 fw-normal text-white">{{ $site->text_2_a }}</h4>
                     </div>
                     <div class="card-body p-1" style = "background-color : #{{ $site->color_back }}">

                         <div class="card-body px-0 mx-lg-5 px-lg-5 py-0">
                             <img class="mt-lg-3 img-fluid shadow rounded" src="{{ url($site->foto_2) }}"
                                 alt="Фото потерялось">
                         </div>
                         <p class="card-text p-2 py-lg-4 px-lg-5">{{ $site->text_2_b }}
                            @php
                            $text_2_b = preg_replace_callback(
                                '/https?\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/',
                                function ($matches) {
                                    return '<a href="' . $matches[0] . '" target="_blank">' . $matches[0] . '</a>';
                                },
                                $site->text_2_b
                            );
                        @endphp
                        {!! $text_2_b !!}
                         </p>

                     </div>
                 </div>

                 <div class="card mb-3 my-lg-4 shadow">
                     <div class="card-header" style = "background-color : #{{ $site->color_card }}";>
                         <h4 class="my-0 fw-normal text-white">{{ $site->text_3_a }}</h4>
                     </div>
                     <div class="card-body p-1" style = "background-color : #{{ $site->color_back }}">
                         <div class="card-body px-0 mx-lg-5 px-lg-5 py-0">
                             <img class="mt-lg-3 img-fluid shadow rounded" src="{{ url($site->foto_3) }}"
                                 alt="Фото потерялось">
                         </div>
                         <p class="card-text p-2 py-lg-4 px-lg-5">
                            @php
                            $text_3_b = preg_replace_callback(
                                '/https?\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/',
                                function ($matches) {
                                    return '<a href="' . $matches[0] . '" target="_blank">' . $matches[0] . '</a>';
                                },
                                $site->text_3_b
                            );
                        @endphp
                        {!! $text_3_b !!}
                         </p>
                     </div>
                 </div>

                 <div class="card mb-3 my-lg-4 shadow">
                     <div class="card-header" style = "background-color : #{{ $site->color_card }}";>
                         <h4 class="my-0 fw-normal text-white">{{ $site->text_4_a }}</h4>
                     </div>
                     <div class="card-body p-1" style = "background-color : #{{ $site->color_back }}">
                         <div class="card-body px-0 mx-lg-5 px-lg-5 py-0">
                             <img class="mt-lg-3 img-fluid shadow rounded" src="{{ url($site->foto_4) }}"
                                 alt="Фото потерялось">
                         </div>
                         <p class="card-text p-2 py-lg-4  px-lg-5">
                            @php
                            $text_4_b = preg_replace_callback(
                                '/https?\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/',
                                function ($matches) {
                                    return '<a href="' . $matches[0] . '" target="_blank">' . $matches[0] . '</a>';
                                },
                                $site->text_4_b
                            );
                        @endphp
                        {!! $text_4_b !!}
                         </p>
                     </div>
                 </div>

                 <div class="card mb-3 my-lg-4 shadow">
                     <div class="card-header" style = "background-color : #{{ $site->color_card }}";>
                         <h4 class="my-0 fw-normal text-white">{{ $site->text_5_a }}</h4>
                     </div>
                     <div class="card-body p-1" style = "background-color : #{{ $site->color_back }}">
                         <div class="card-body px-0 mx-lg-5 px-lg-5 py-0">
                             <img class="mt-lg-3 img-fluid shadow rounded" src="{{ url($site->foto_5) }}"
                                 alt="Фото потерялось">
                         </div>
                         <p class="card-text p-2 py-lg-4 px-lg-5">{{ $site->text_5_b }}
                            @php
                            $text_5_b = preg_replace_callback(
                                '/https?\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/',
                                function ($matches) {
                                    return '<a href="' . $matches[0] . '" target="_blank">' . $matches[0] . '</a>';
                                },
                                $site->text_5_b
                            );
                        @endphp
                        {!! $text_5_b !!}
                         </p>
                     </div>
                 </div>

                 <div class=""> </div>

                 <div class="row mx-0">
                     <a href="{{ route('channel', Auth::user()->id) }}" class="btn text-white" target="_blank"
                         role="button" style = "background-color : #8E0400"
                         title="Перейти на портал Автоэлектрики">Все наши ремонты тут на портале</a>
                 </div>


                 <h4 class="p-2 fw-normal ">
                    @php
                    $bottom_text = preg_replace_callback(
                        '/https?\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/',
                        function ($matches) {
                            return '<a href="' . $matches[0] . '" target="_blank">' . $matches[0] . '</a>';
                        },
                        $site->bottom_text
                    );
                @endphp
               {!! $bottom_text !!}
                 </h4>




             </div>


             <div class="col-xl-2 "> </div>
         </div>
     </div>
     </div>







     <footer class=" text-white " style = "background-color : #{{ $site->color_head }}";>
         <div class="p-2">
             <span class=" ">© 2024 Company, Inc</span>
         </div>
     </footer>



 </body>

 </html>
