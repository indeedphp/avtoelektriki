<div hidden>
    <div id="test_comment">

        <div class="card  card mb-2 p-0 m-0">
            <div class="card-header p-0 ">
                <div class="row">
                    <div class="col-auto me-auto pe-0 flex-fill">
                        <a href="ссылка js" id="a_post_name_user" class=" ms-auto small ps-1" style="text-decoration: none" target="_blank" ></a>
                    </div>
                    <div class="col-auto  ps-0">
                        <nobr class="small"> </nobr>
                        &nbsp;
                    </div> 
                </div>
            </div>
            <ul class="list-group list-group-flush p-0">
                <li id="comment_text" class="list-group-item ps-1 p-0">
                </li>
                <li class="list-group-item p-0">
                    <div class="row small user-select-none">
                         <!-- ЛАЙК ДИЗЛАЙК -->
                        <div class="col-auto  pe-3 ">
                            <i id="like_comment" class='bi bi-hand-thumbs-up ps-1' style="cursor: pointer;" value="3"
                                comment_id="">
                                0</i>&nbsp;
                            <i id="dislike_comment" class="bi bi-hand-thumbs-down" style="cursor: pointer;"
                                value="4" comment_id=""> 0</i>
                        </div>
                        <!-- ПОЖАЛОВАТСЯ -->
                        <div class="col-auto me-auto p-0 m-0 ps-0">
                            <button id="button_complaint" class="nav-link bi bi-shield-exclamation" onclick=""
                            title="Пожаловатся на комментарий" data-bs-toggle="modal" data-bs-target="#modal_complaint"></button>      
                    </div>
                        <div class="col-auto  ps-0">
                      <!-- РЕДАКТИРУЕМ КОММЕНТАРИЙ -->
                            <a id="a_comment_edit"  hidden data-bs-toggle="collapse" href="#coment_collapse" role="button" aria-expanded="false"
                                aria-controls="collapseExample" title="Редактировать, удалить комментарий"
                                class="link-underline-light p-0" style="cursor: pointer;">изменить
                            </a>
                    <!-- ОТВЕТ НА КОММЕНТАРИЙ -->
                            <a id="coment_reply_collapse" class="link-underline-light p-0 pe-1" data-bs-toggle="collapse"
                                href="#coment_reply_collapse" role="button" aria-expanded="false"
                                aria-controls="collapseExample" title="Редактировать, удалить комментарий"
                                style=" cursor: pointer;">
                                &ensp; ответить
                            </a>

                        </div>
                    </div>
                </li>

            </ul>
        </div>
        <!-- \\\\\\\\\\\\\\\\\\\\\\\\ ФОРМА ОТВЕТА НА КОММЕНТАРИИ ==================================================================================== -->
        <div class="collapse" id="coment_reply_collapse_hidden">
            <div class="card card-body p-1">

                <form id="form_reply_comment" form_type="4" coment_id="" reply_id="0" post_id="">
                    <div text_div class="card card-body p-1 m-0" id="text_div_comment" contenteditable="true" style="white-space: pre-wrap">
                    </div>
                    <div class="row p-1 ">
                        <div class="col-7 me-auto  flex-fill ">

                            <i id="i_collapse_comment_smile_reply" class="bi bi-emoji-smile h3 " data-bs-toggle="collapse" href="#collapse_comment_smile"
                                role="button" aria-expanded="false" aria-controls="collapseExample"> </i>

                            <div id="collapse_comment_smile" class="collapse user-select-none">

                                <span comment_id="" class="comment_smile">😀</span>
                                <span comment_id="" class="comment_smile">👍</span>
                                <span comment_id="" class="comment_smile">👌</span>
                                <span comment_id="" class="comment_smile">😂</span>
                                <span comment_id="" class="comment_smile">😎</span>
                                <span comment_id="" class="comment_smile">😇</span>
                                <span comment_id="" class="comment_smile">😝</span>

                                <span comment_id="" class="comment_smile">👎</span>
                                <span comment_id="" class="comment_smile">💩</span>
                                <span comment_id="" class="comment_smile">😈</span>
                                <span comment_id="" class="comment_smile">☠</span>
                                <span comment_id="" class="comment_smile">😪</span>
                                <span comment_id="" class="comment_smile">😬</span>
                                <span comment_id="" class="comment_smile">😭</span>
                                <span comment_id="" class="comment_smile">🍺</span>

                            </div>
                        </div>
                        <div class="col-auto p-0 pe-2 pt-1">
                            <button class="btn btn-primary btn-sm" title="Ответить" type="submit">Отправить</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

        <!-- ФОРМА ИСПРАВЛЕНИЯ КОММЕНТАРИЕВ ==================================================================================== -->

        <div class="collapse" id="coment_collapse">
            <div class="card card-body p-1">

                <form id="form_coment" form_type="2" coment_id="">
                    <div text_div class="card card-body p-1 m-0" id="text_div_comment_edit" contenteditable="true">
                    </div>
                    <input name="_method" type="hidden" value="PUT">
                    <div class="row p-1 ">
                        <div class="col-7 me-auto  flex-fill ">

                            <i id="i_collapse_smile" class="bi bi-emoji-smile h3 " data-bs-toggle="collapse"
                                href="#collapse_comment_edit_smile" role="button" aria-expanded="false"
                                aria-controls="collapseExample"> </i>

                            <div id="div_comment_edit_smile" class="collapse user-select-none">

                                <span comment_id="" class="comment_edit_smile">😀</span>
                                <span comment_id="" class="comment_edit_smile">👍</span>
                                <span comment_id="" class="comment_edit_smile">👌</span>
                                <span comment_id="" class="comment_edit_smile">😂</span>
                                <span comment_id="" class="comment_edit_smile">😎</span>
                                <span comment_id="" class="comment_edit_smile">😇</span>
                                <span comment_id="" class="comment_edit_smile">😝</span>

                                <span comment_id="" class="comment_edit_smile">👎</span>
                                <span comment_id="" class="comment_edit_smile">💩</span>
                                <span comment_id="" class="comment_edit_smile">😈</span>
                                <span comment_id="" class="comment_edit_smile">☠</span>
                                <span comment_id="" class="comment_edit_smile">😪</span>
                                <span comment_id="" class="comment_edit_smile">😬</span>
                                <span comment_id="" class="comment_edit_smile">😭</span>
                                <span comment_id="" class="comment_edit_smile">🍺</span>

                            </div>
                        </div>
                        <div class="col-auto p-0 pe-2 pt-1">
                            <button class="btn btn-primary btn-sm" title="Ответить" type="submit">Изменить</button>
                        </div>
                    </div>
                </form>

                <!-- ФОРМА УДАЛЕНИЯ КОММЕНТАРИЕВ ==================================================================================== -->

                <form id="form_coment_del" form_type="3" coment_id="" post_id="">
                    {{-- <input id="input3" type="hidden" name="comment_id" value=""> --}}
                    <input name="_method" type="hidden" value="DELETE">
                    <button class="btn m-0 p-0" title="Удаление комментария"
                        type="submit">удалить комментарий</button>
                </form>
            </div>
        </div>

        <div id="reply">
        </div>
    </div>
</div>
