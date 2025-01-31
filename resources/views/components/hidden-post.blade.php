<div hidden>

    <div id='post'>
      
        <div class="card  mb-3  shadow ">
            <div class=" card-header text-muted py-1 p-lg-3">
                <div class="row">

                    <div class="col-auto me-auto p-0 px-lg-3">
                        <i class="bi bi-geo-alt"> Алматы </i> 
                    </div>

                    <div class="col-auto p-0 pe-1 px-lg-3 ">
                        <a id="a_channel" href="ссылка js" class="bi bi-universal-access ms-auto "
                            style="text-decoration: none" target="_blank"></a>
                    </div>
                </div>
            </div>
            <div class="card-body px-1 px-lg-5 mx-lg-5 py-2 ">
                <div class="pb-2">
                <i id="i_clock" class="bi bi-clock pe-3 p-lg-3 text-black-80">js время</i>
                <b id="h_name_post" class="card-title pb-5 h5">
                    js название поста
                </b>
            </div>
                <div class="card-body px-0  px-lg-5 py-0">
                    <div class="row">

                        <div id="foto1" class="col-lg-10 ">
                            <a id="a_url_post" class="" href="http://localhost:3000/post/4" target="_blank"> <img
                                    id="img_url1" class=" img-fluid shadow" src="" alt="Фото потерялось"> </a>
                        </div>
                        <div id="foto" class="d-none d-lg-block  col-lg-2 p-0">
                            <img id="img_url4" class="img-fluid shadow" src="" alt="Фото потерялось">
                            <img hidden id="img_url5" class="img-fluid shadow mt-2" src=""
                                alt="Фото потерялось">
                        </div>

                    </div>
                </div>

                <div class="card-text pt-2">
                    <div id="span_text_post" class="px-1">выводим текст под фото</div>
                    <div class="text-end pb-1 pe-1"> <a id="a_collapse_post" class="link-underline-light p-0 "
                            href="#collapseExample1" data-bs-toggle="collapse" data-bs-target="js collapse"
                            aria-expanded="false" aria-controls="collapseExample"></a>
                    </div>
                </div>

                <div id="div_collapse_post" class="collapse p-0">
                    <div class=" p-1">

                        <div id="div_text_post_end" class="card-text">
                        </div>

                        <div hidden id="div_hidden_post" class="card-body px-1 px-lg-2  py-3">
                            <div class="card-body px-0  px-lg-5 py-0">
                                <img id="img_url2" class=" img-fluid shadow " src="" alt="Фото потерялось">
                            </div>
                            <p id="p_text_post_2" class="card-text py-2"></p>
                        </div>

                        <div hidden id="div_hidden_post2" class="card-body px-1 px-lg-2  py-1">
                            <div class="card-body px-0  px-lg-5 py-0">
                                <img id="img_url3" class=" img-fluid shadow " src="" alt="Фото потерялось">
                            </div>
                            <p id="p_text_post_3" class="card-text py-2"></p>
                        </div>


                    </div>
                </div>
            </div>
            <div class="card-footer text-muted px-0 py-1 p-lg-3 ">
                <div class="row">

                    <div class="col-auto pe-2 text-black-80">
                        <i id="like_post" class="bi bi-hand-thumbs-up ps-1" style="cursor: pointer;" value="1"
                            post_id="js"></i>&nbsp;
                    </div>


                    <!-- РЕПОСТ -->
                    <div class="col-auto me-auto ps-0">

                        <i id="a_collapse_repost" class="bi bi-share text-black-80" title="Репост"
                            data-bs-toggle="collapse" role="button" data-bs-target="#collapse" aria-expanded="false"
                            aria-controls="collapseExample"> Поделится</i>

                    </div>
                    <!-- КОМЕНТАРИИ КНОПКА -->
                    <div class="col-auto">

                        <i id="a_collapse_comment" class="bi bi-chat-dots text-black-80"
                            title="Написать, прочитать комментарии" data-bs-toggle="collapse" role="button"
                            data-bs-target="#collapseComment" aria-expanded="false" aria-controls="collapseExample">
                            Комментарии </i>
                        <i id="i_comment_count" class="text-black-80 pe-2"></i>

                    </div>
                </div>
                {{-- РЕПОСТЫ  ===================================================================================================================================================== --}}
                <div id="div_repost" class="collapse py-0">
                    <div class="card card-body ps-1 p-0 py-1">

                        <div class="col-auto p-0">
                            <a id="i_repost_post" class="bi bi-card-text link-underline-light p-1 px-lg-3"
                                href="http://localhost:3000/post/4" target="_blank"> </a>
                            <a id="a_post_url" class="bi bi-share link-underline-light p-1 px-lg-2" role="button"
                                class="post" post_url="js"> Ссылка </a>
                            <a id="i_repost_telegram" class="bi bi-telegram link-underline-light p-1 px-lg-2"
                                href="https://telegram.me/share/url?url=https://bootstrap-5.ru/docs/5.3/utilities/link/"
                                target="_blank"> Телеграм </a>
                            <a id="i_repost_whatsap" class="bi bi-whatsapp link-underline-light px-lg-2"
                                href="whatsapp://send?text=https://bootstrap-5.ru/docs/5.3/utilities/link/"
                                target="_blank"> Whatsapp</a>
                        </div>

                    </div>
                </div>



                {{-- ФОРМА ВВОДА КОММЕНТАРИЕВ  tg://resolve ===================================================================================================================================================== --}}
                <div id="div_comment" class="collapse p-0">
                    <div class="card card-body p-1 ">
                        <form id="form" post_id="js" form_type="1">

                            <div text_div class="card card-body p-1 " id="text_div_post" contenteditable="true"
                                data-placeholder=" Напишите комментарий"></div>
                            <div class="row p-1 ">
                                <div class="col-7 me-auto  flex-fill ">
                                    <i id="i_smile_collapse" class="bi bi-emoji-smile h3 " data-bs-toggle="collapse"
                                        href="collapse_post_smile" role="button" aria-expanded="false"
                                        aria-controls="collapseExample"> </i>

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
                            {{-- КОМЕНТАРИИ ВСТАВЛЯЕМ ===================================================================================================================================================== --}}
                        </div>
                        <div class="row">
                            <div class="col-auto me-auto pe-0 flex-fill">
                            </div>
                            <div class="col-auto  ps-0">
                                <i id="a_collapse_comment_end" class="bi bi-chat-dots text-black-80"
                                    title="свернуть комментарии" data-bs-toggle="collapse" role="button"
                                    data-bs-target="#collapseComment" aria-expanded="false"
                                    aria-controls="collapseExample"> свернуть комментарии</i>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
