 <!DOCTYPE html>

 <html lang="en">

 <head>
     <meta charset="utf-8">
     <title>Автоэлектр</title>
     <link rel="shortcut icon" href="{{ url('favicon.ico') }}">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta name="description" content="Профпортал Автоэлектрики">
     <link href="{{ url('bootstrap.css') }}" rel="stylesheet">

 </head>

 <body  style = "background-color : #{{$site->color_body}}">


    <div class="container-fluid fixed-top p-2 rounded  mr-3  "  style = "background-color : #{{$site->color_head}}";>
        <div class="row "  >
          <div class="col-sm-6 d-flex justify-content-center" >
           <h3 class="text-white">{{$site->heading}}</h3>
         </div>
         <div class="col-sm-6 d-flex justify-content-center">
          <h4 class=" text-white"> <a class=" text-white" href="tel:{{$site->phone_1}}" rel="nofollow"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
            <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
          </svg> {{$site->phone_1}}</a></h4>
        </div>
  
      </div>
    </div>
    
     <div class="container-fluid p-1 overflow-x-hidden">
         <div class="row ">

             <div class="col-xl-2 "></div>

             <div class="col  p-3 px-2">
                 <div class=" my-4 py-3"></div>


                 <div id='content' class="">
<h4 class="my-0 fw-normal ">{{$site->top_text}}</h4>

                    <div class="card mb-4 rounded-3 shadow">
                        <div class="card-header py-3 " style = "background-color : #{{$site->color_card}}">
                          <h4 class="my-0 fw-normal text-white">{{$site->text_1_a}}</h4>
                        </div>
                        <div class="card-body p-1">
                            <img id="preview" class=" img-fluid shadow " src="{{$site->foto_1}}" alt="Фото потерялось">
              
                         <p class="card-text p-2">{{$site->text_1_b}}</p>
                       </div>
                     </div>
                     
                     <div class="card mb-4 rounded-3 shadow">
                        <div class="card-header py-3 " style = "background-color : #{{$site->color_card}}";>
                          <h4 class="my-0 fw-normal text-white">{{$site->text_2_a}}</h4>
                        </div>
                        <div class="card-body p-1">
                            <img id="preview" class=" img-fluid shadow " src="{{$site->foto_2}}" alt="Фото потерялось">
              
                         <p class="card-text p-2">{{$site->text_2_b}}</p>
                       </div>
                     </div>

                     <div class="card mb-4 rounded-3 shadow">
                        <div class="card-header py-3 " style = "background-color : #{{$site->color_card}}";>
                          <h4 class="my-0 fw-normal text-white">{{$site->text_3_a}}</h4>
                        </div>
                        <div class="card-body p-1">
                            <img id="preview" class=" img-fluid shadow " src="{{$site->foto_3}}" alt="Фото потерялось">
              
                         <p class="card-text p-2">{{$site->text_3_b}}</p>
                       </div>
                     </div>

                     <div class="card mb-4 rounded-3 shadow">
                        <div class="card-header py-3 " style = "background-color : #{{$site->color_card}}";>
                          <h4 class="my-0 fw-normal text-white">{{$site->text_4_a}}</h4>
                        </div>
                        <div class="card-body p-1">
                            <img id="preview" class=" img-fluid shadow " src="{{$site->foto_4}}" alt="Фото потерялось">
              
                         <p class="card-text p-2">{{$site->text_4_b}}</p>
                       </div>
                     </div>

                     <div class="card mb-4 rounded-3 shadow">
                        <div class="card-header py-3 " style = "background-color : #{{$site->color_card}}";>
                          <h4 class="my-0 fw-normal text-white">{{$site->text_5_a}}</h4>
                        </div>
                        <div class="card-body p-1">
                            <img id="preview" class=" img-fluid shadow " src="{{$site->foto_5}}" alt="Фото потерялось">
              
                         <p class="card-text p-2">{{$site->text_5_b}}</p>
                       </div>
                     </div>

                     <h4 class="my-0 fw-normal ">{{$site->bottom_text}}</h4>

                   </div>

                 </div>
            

             <div class="col-xl-2 "> </div>
            </div>
         </div>
     </div>











 </body>

 </html>
