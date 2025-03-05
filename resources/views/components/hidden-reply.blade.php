<div hidden>
    <div id="replu_hidden">

        <div class="card mb-2 p-0 ms-3">
            <div class="card-header p-0 ">
                <div class="row">
                    <div class="col-auto me-auto pe-0 flex-fill">
                         <a href="ссылка js" id="a_reply_name_user" class=" small ps-1" style="text-decoration: none" target="_blank" ></a>
                    </div>
                    <div class="col-auto  ps-0">
                        <nobr class="small"> </nobr>
                        &nbsp;
                    </div>

                </div>
            </div>
            <ul class="list-group list-group-flush p-0">
                <li id="reply_text" class="list-group-item ps-1 p-0">
                </li>
                <li class="list-group-item p-0">
                    <div class="row small user-select-none">
                        {{-- ЛАЙК ДИЗЛАЙК ОТВЕТ==========================================================================    --}}
                        <div class="col-auto  pe-3 ">
                            <i id="like_reply" class="bi bi-hand-thumbs-up ps-1 " style="cursor: pointer;" value="5"
                                reply_id=""> 0
                            </i>&nbsp;
                            <i id="dislike_reply" class=" bi bi-hand-thumbs-down " style="cursor: pointer;"
                                value="6" reply_id=""> 0
                            </i>
                        </div>
                    <!-- ПОЖАЛОВАТСЯ -->
                    <div class="col-auto me-auto p-0 m-0 ps-0">
                        <button id="button_complaint" class="nav-link bi bi-shield-exclamation" onclick=""
                        title="Пожаловатся на комментарий"  data-bs-toggle="modal" data-bs-target="#modal_complaint"></button>       
                </div>
                        <div class="col-auto  ps-0">

                            <a hidden id="hidden_reply_collapse_edit" class="link-underline-light p-0"
                                data-bs-toggle="collapse" href="#reply_collapse_edit" role="button"
                                aria-expanded="false" aria-controls="collapseExample"
                                title="Редактировать, удалить комментарий" style="cursor: pointer;">изменить
                            </a>

                            <a id="hidden_reply_collapse" class="link-underline-light p-0 pe-1" data-bs-toggle="collapse"
                                href="#reply_collapse" role="button" aria-expanded="false"
                                aria-controls="collapseExample" title="Ответить на комментарий"
                                style=" cursor: pointer;">
                                &ensp; ответить
                            </a>

                        </div>
                    </div>
                </li>

            </ul>
        </div>

        <!-- \\\\\\\\\\\\\\\\\\\\\\\\ ФОРМА ОТВЕТА НА ОТВЕТ ==================================================================================== -->
        <div class="collapse" id="reply_collapse">
            <div class="card card-body p-1">

                <form id="form_reply_reply" form_type="4" coment_id="" reply_id="">
                    <div text_div class="card card-body p-1 m-0" id="text_div_reply" contenteditable="true"style="white-space: pre-wrap"></div>

                    <input id="input_name_opponent" type="hidden" name="name_opponent" value="">

                    <div class="row p-1 ">
                        <div class="col-7 me-auto  flex-fill ">

                            <i id="i_reply_reply_collapse_smile" class="bi bi-emoji-smile h3 " data-bs-toggle="collapse" href="#collapse_reply_smile"
                                role="button" aria-expanded="false" aria-controls="collapseExample"> </i>

                            <div class="collapse user-select-none" id="collapse_reply_smile">

                                <span reply_id="" class="reply_smile" >😀</span>
                                <span reply_id="" class="reply_smile" >👍</span>
                                <span reply_id="" class="reply_smile" >👌</span>
                                <span reply_id="" class="reply_smile" >😂</span>
                                <span reply_id="" class="reply_smile" >😎</span>
                                <span reply_id="" class="reply_smile" >😇</span>
                                <span reply_id="" class="reply_smile" >😝</span>

                                <span reply_id="" class="reply_smile" >👎</span>
                                <span reply_id="" class="reply_smile" >💩</span>
                                <span reply_id="" class="reply_smile" >😈</span>
                                <span reply_id="" class="reply_smile" >☠</span>
                                <span reply_id="" class="reply_smile" >😪</span>
                                <span reply_id="" class="reply_smile" >😬</span>
                                <span reply_id="" class="reply_smile" >😭</span>
                                <span reply_id="" class="reply_smile ">🍺</span>

                            </div>
                        </div>
                        <div class="col-auto p-0 pe-2 pt-1">
                            <button class="btn btn-primary btn-sm" title="Ответить" type="submit">Ответить</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

        <!-- ФОРМА ИСПРАВЛЕНИЯ ОТВЕТОВ ==================================================================================== -->
        <div class="collapse" id="reply_collapse_edit">
            <div class="card card-body p-1">

                <form id="form_reply_edit" form_type="5" reply_id="">
                    <div text_div class="card card-body p-1 m-0" id="text_div_reply_edit" contenteditable="true"
                        data-placeholder="Напишите новый текст">
                    </div>
                    <input name="_method" type="hidden" value="PUT">
                    <div class="row p-1 ">
                        <div class="col-7 me-auto  flex-fill ">

                            <i id="i_reply_edit_collapse_smile" class="bi bi-emoji-smile h3 " data-bs-toggle="collapse"
                                href="#collapse_reply_edit_smile" role="button" aria-expanded="false"
                                aria-controls="collapseExample"> </i>

                            <div class="collapse user-select-none" id="collapse_reply_edit_smile">

                                <span reply_id="" class="reply_edit_smile" >😀</span>
                                <span reply_id="" class="reply_edit_smile" >👍</span>
                                <span reply_id="" class="reply_edit_smile" >👌</span>
                                <span reply_id="" class="reply_edit_smile" >😂</span>
                                <span reply_id="" class="reply_edit_smile" >😎</span>
                                <span reply_id="" class="reply_edit_smile" >😇</span>
                                <span reply_id="" class="reply_edit_smile" >😝</span>

                                <span reply_id="" class="reply_edit_smile" >👎</span>
                                <span reply_id="" class="reply_edit_smile" >💩</span>
                                <span reply_id="" class="reply_edit_smile" >😈</span>
                                <span reply_id="" class="reply_edit_smile" >☠</span>
                                <span reply_id="" class="reply_edit_smile" >😪</span>
                                <span reply_id="" class="reply_edit_smile" >😬</span>
                                <span reply_id="" class="reply_edit_smile" >😭</span>
                                <span reply_id="" class="reply_edit_smile ">🍺</span>

                            </div>
                        </div>
                        <div class="col-auto p-0 pe-2 pt-1">
                            <button class="btn btn-primary btn-sm" title="Ответить" type="submit">Изменить</button>
                        </div>
                    </div>
                </form>

                <!-- ФОРМА УДАЛЕНИЯ ОТВЕТОВ ==================================================================================== -->

                <form id="form_reply_del" form_type="6" reply_id="" post_id="">
                    <input name="_method" type="hidden" value="DELETE">
                    <button class="btn m-0 p-0" title="Удаление комментария" type="submit">удалить комментарий</button>
                </form>
            </div>
        </div>

    </div>
</div>
