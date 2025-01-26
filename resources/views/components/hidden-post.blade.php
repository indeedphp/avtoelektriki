<div hidden>
    
    <div id='post'>
        {{-- foreach posts as post) --}}
            <div class="card  mb-3  shadow ">
                <div class=" card-header text-muted py-1 p-lg-3">
                    <div class="row">
    
                        <div class="col-auto me-auto p-0 ">
                            <i id="i_clock" class="bi bi-clock p-lg-1" >js время</i>
                        </div>
    
                        <div class="col-auto p-0"> <a class="link-underline-light" href="#"> <i class="bi bi-geo-alt"
                                    ></i> Алматы </a> </div>
    
                        <div class="col-auto p-0 ps-1 px-lg-3 "> 
                            <a id="a_channel" class="link-underline-light" target="_blank" href="ссылка на канал юзера">
                                <i id="i_human" class="bi bi-universal-access ms-auto" >js юзер нейм</i>
                                </a> </div>
                    </div>
                </div>
                <div class="card-body px-1 px-lg-5 py-1">
                    <h5 id="h_name_post" class="card-title">
                       js название поста
                    </h5>
                    <div class="card-body px-0 mx-lg-5 px-lg-5 py-0">
                        <div class="card-body px-0 mx-lg-5 px-lg-5 py-0">
                            <img id="img_url1" class=" img-fluid shadow " 
                            src="" alt="Фото потерялось">
                        </div>
                    </div>
    
                    <div class="card-text"> <span id="span_text_post">выводим текст под фото</span>
                        <a id="a_collapse_post" class="link-underline-light p-0" href="#collapseExample1" data-bs-toggle="collapse"
                            data-bs-target="js collapse" aria-expanded="false"
                            aria-controls="collapseExample"> развернуть </a>
                    </div>
    
                    <div id="div_collapse_post" class="collapse p-0" >
                        <div class=" p-1">
    
                            <div class="card-text"> 
                            </div>
                        
                                <div hidden id="div_hidden_post" class="card-body px-0 mx-lg-5 px-lg-5 py-0">
                                    <div class="card-body px-0 mx-lg-5 px-lg-5 py-0">
                                        <img id="img_url2" class=" img-fluid shadow " src="" alt="Фото потерялось">
                                    </div>
                                    <p id="p_text_post_2" class="card-text"></p>
                                </div>
    
                                <div hidden id="div_hidden_post2" class="card-body px-0 mx-lg-5 px-lg-5 py-0">
                                    <div class="card-body px-0 mx-lg-5 px-lg-5 py-0">
                                        <img id="img_url3" class=" img-fluid shadow " src="" alt="Фото потерялось">
                                    </div>
                                    <p id="p_text_post_3" class="card-text"></p>
                                </div>
      
                                    <a id="a_collapse_post_end" class="link-underline-light p-0"
                                        href="#collapseExample1" data-bs-toggle="collapse"
                                        data-bs-target="#collapseExample" aria-expanded="false" 
                                        aria-controls="collapseExample"> &nbsp &nbsp свернуть </a>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted p-0 m-0 p-lg-3 ">
                    <div class="row">
                        
                        <div class="col-auto pe-2">
                            <i id="like_post" class="bi bi-hand-thumbs-up"
                                style="cursor: pointer;" value="1"
                                post_id="js"></i>&nbsp;
                        </div>
    
    
                        <!-- РЕПОСТ -->
                        <div class="col-auto me-auto p-0">
                            <a id="a_collapse_repost" class="link-underline-light" title="Репост" href="#collapseExample1"
                                data-bs-toggle="collapse" data-bs-target="#collapse"
                                aria-expanded="false" aria-controls="collapseExample">
                                <i class="bi bi-share" ></i></i>
                                Поделится
                            </a>
                        </div>
                        <!-- КОМЕНТАРИИ КНОПКА -->
                        <div class="col-auto ">
                            <a id="a_collapse_comment"  class="link-underline-light p-0" title="Написать, прочитать комментарии"
                                href="#collapseExample1" data-bs-toggle="collapse"
                                data-bs-target="#collapseComment" aria-expanded="false"
                                aria-controls="collapseExample"><i class="bi bi-chat-dots" ></i></i>
                                Коментарии
                                <i id="i_comment_count" id="comm_count
                                {{-- post->id  --}}
                                 ">
                                 {{-- post->post_comment_count  --}}
                                </i>&nbsp;</a>
                        </div>
                    </div>
                    {{-- РЕПОСТЫ  ===================================================================================================================================================== --}}
                    <div id="div_repost" class="collapse py-0" >
                        <div class="card card-body px-3 py-1">
                            <div class="row p-0">
                                <div class="col-auto px-1"><a class="link-underline-light" href="#"> <i id="i_repost_post" 
                                            class="bi bi-card-text" > Пост</i> </a> 
                                        </div>
                                <div class="col-auto px-1"><a class="link-underline-light" href="#"> <i
                                            class="bi bi-telegram" >
                                            Телеграмм</i></a>
                                         </div>
                                <div class="col-auto px-1"><a class="link-underline-light" href="#"> <i
                                            class="bi bi-whatsapp" >
                                            Whatsapp</i> </a> 
                                         </div>
                            </div>
                        </div>
                    </div>
                    {{-- ФОРМА ВВОДА КОММЕНТАРИЕВ  ===================================================================================================================================================== --}}
                    <div  id="div_comment" class="collapse p-0" >
                        <div  class="card card-body p-1 ">
                            <form id="form" post_id="js" form_type="1">
    
                                <div text_div class="card card-body p-1 " id="text_div_post"  
                                contenteditable="true" data-placeholder="Напишите комментарий"></div>
                                    <div class="row p-1 ">
                                    <div class="col-7 me-auto  flex-fill ">
                                        <i id="i_smile_collapse" class="bi bi-emoji-smile h3 " data-bs-toggle="collapse"
                                            href="collapse_post_smile" role="button"
                                            aria-expanded="false" aria-controls="collapseExample"> </i>
    
                                        <div id="div_smile" class="collapse">
    
                                            <span post_id="" class="post_smile">😀</span>
                                            <span post_id="" class="post_smile">👍</span>
                                            <span post_id="" class="post_smile">👌</span>
                                            <span post_id="" class="post_smile">😂</span>
                                            <span post_id="" class="post_smile">😎</span>
                                            <span post_id="" class="post_smile">😇</span>
                                            <span post_id="" class="post_smile">😝</span>
    
                                            <span post_id="" class="post_smile">👎</span>
                                            <span post_id="" class="post_smile">💩</span>
                                            <span post_id="" class="post_smile">😈</span>
                                            <span post_id="" class="post_smile">☠</span>
                                            <span post_id="" class="post_smile">😪</span>
                                            <span post_id="" class="post_smile">😬</span>
                                            <span post_id="" class="post_smile">😭</span>
    
                                        </div>
                                    </div>
                                    <div class="col-auto p-0 pe-2 pt-1">
                                        <button class="btn btn-primary btn-sm" title="Отправить"
                                            type="submit">Отправить</button>
                                    </div>
                                </div>
                            </form>
                            <div id="comm" class="overflow-x-hidden p-0" style="max-height: 300px;">
    {{-- КОМЕНТАРИИ ===================================================================================================================================================== --}}
                            {{-- <x-comments :post="$post"/> --}}
                            
    
    
                            </div>
                            
                            <div class="col-auto">
                                <div class="row">
                                    <div class="col-auto me-auto pe-0 flex-fill">
                                    </div>
                                    <div class="col-auto  ps-0">
                                        <a id="a_collapse_comment_end" class="link-underline-light p-0" href="#collapseExample1"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#collapseComment" aria-expanded="false"
                                            aria-controls="collapseExample"><i class="bi bi-chat-dots"></i></i> Свернуть
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    
                </div>
            </div>
      
    </div>
    </div>