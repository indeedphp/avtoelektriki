<div id="reply{{ $comment->id }}">
    @foreach ($comment->reply_comment_plus as $reply)
        <div id="one_reply{{ $reply->id }}">
            <div class="card mb-2 p-0 ms-2">
                <div class="card-header p-0 ">
                    <div class="row">
                        <div class="col-auto me-auto pe-0 flex-fill">
                            &nbsp; <b class="small">{{ $reply->user_name }}
                                @if ($reply->stuff != 0)
                                    ответ {{ $reply->stuff }}
                                @endif
                            </b>
                        </div>
                        <div class="col-auto  ps-0">
                            <nobr class="small"> @php
                                echo date('d.m.Y', strtotime($reply->created_at));
                            @endphp
                            </nobr>
                            &nbsp;
                        </div>

                    </div>
                </div>
                <ul class="list-group list-group-flush p-0">
                    <li
                        id="reply_text{{ $reply->id }}"class="list-group-item p-0">
                        {{ $reply->reply }}
                    </li>
                    <li class="list-group-item p-0">
                        <div class="row small">
                            <div class="col-auto me-auto pe-0 flex-fill">
                                {{-- ЛАЙК ДИЗЛАЙК ответ==========================================================================    --}}


                                <i class="
                               @if ($reply->reply_like_active) {{ 'bi bi-hand-thumbs-up-fill' }} 
                              @else
                              {{ 'bi bi-hand-thumbs-up' }} @endif "
                                    style="cursor: pointer;" value="5"
                                    reply_id="{{ $reply->id }}">
                                    {{ $reply->reply_like_count }}</i>&nbsp;
                                <i class="
                               @if ($reply->reply_dislike_active) {{ 'bi bi-hand-thumbs-down-fill' }} 
                                  @else
                                {{ 'bi bi-hand-thumbs-down' }} @endif "
                                    style="cursor: pointer;" value="6"
                                    reply_id="{{ $reply->id }}">
                                    {{ $reply->reply_dislike_count }}</i>
                            </div>
                            <div class="col-auto  ps-0">

                                @auth
                                    @if ($reply->id_user == Auth::user()->name)
                                        <a class="link-underline-light p-0"
                                            data-bs-toggle="collapse"
                                            href="#reply_collapse_edit{{ $reply->id }}"
                                            role="button" aria-expanded="false"
                                            aria-controls="collapseExample"
                                            title="Редактировать, удалить комментарий"
                                            style="cursor: pointer;">изменить
                                        </a>
                                    @endif
                                @endauth
                                <a class="link-underline-light p-0"
                                    data-bs-toggle="collapse"
                                    href="#reply_collapse{{ $reply->id }}"
                                    role="button" aria-expanded="false"
                                    aria-controls="collapseExample"
                                    title="Редактировать, удалить комментарий"
                                    style=" cursor: pointer;"> &ensp;
                                    ответить
                                </a>

                            </div>
                        </div>
                    </li>

                </ul>
            </div>


            <!-- \\\\\\\\\\\\\\\\\\\\\\\\ ФОРМА ОТВЕТА НА ОТВЕТ ==================================================================================== -->
            <div class="collapse" id="reply_collapse{{ $reply->id }}">
                <div class="card card-body p-1">

                    <form id="form_reply_comment{{ $comment->id }}" form_type="4"
                        coment_id="{{ $comment->id }}"
                        reply_id="{{ $reply->id }}">

                        <div text_div class="card card-body p-1 m-0"
                            id="text_div_reply{{ $reply->id }}"
                            contenteditable="true"
                            data-placeholder="Напишите ваш ответ">
                            {{ $reply->user_name }} &ensp;
                        </div>

                        <input type="hidden" name="name_opponent"
                            value="{{ $reply->user_name }}">

                        <div class="row p-1 ">
                            <div class="col-7 me-auto  flex-fill ">

                                <i class="bi bi-emoji-smile h3 "
                                    data-bs-toggle="collapse"
                                    href="#collapse_reply_smile{{ $reply->id }}"
                                    role="button" aria-expanded="false"
                                    aria-controls="collapseExample"> </i>

                                <div class="collapse"
                                    id="collapse_reply_smile{{ $reply->id }}">

                                    <span reply_id="{{ $reply->id }}"
                                        class="reply_smile">😀</span>
                                    <span reply_id="{{ $reply->id }}"
                                        class="reply_smile">👍</span>
                                    <span reply_id="{{ $reply->id }}"
                                        class="reply_smile">👌</span>
                                    <span reply_id="{{ $reply->id }}"
                                        class="reply_smile">😂</span>
                                    <span reply_id="{{ $reply->id }}"
                                        class="reply_smile">😎</span>
                                    <span reply_id="{{ $reply->id }}"
                                        class="reply_smile">😇</span>
                                    <span reply_id="{{ $reply->id }}"
                                        class="reply_smile">😝</span>

                                    <span reply_id="{{ $reply->id }}"
                                        class="reply_smile">👎</span>
                                    <span reply_id="{{ $reply->id }}"
                                        class="reply_smile">💩</span>
                                    <span reply_id="{{ $reply->id }}"
                                        class="reply_smile">😈</span>
                                    <span reply_id="{{ $reply->id }}"
                                        class="reply_smile">☠</span>
                                    <span reply_id="{{ $reply->id }}"
                                        class="reply_smile">😪</span>
                                    <span reply_id="{{ $reply->id }}"
                                        class="reply_smile">😬</span>
                                    <span reply_id="{{ $reply->id }}"
                                        class="reply_smile">😭</span>

                                </div>
                            </div>
                            <div class="col-auto p-0 pe-2 pt-1">
                                <button class="btn btn-primary btn-sm"
                                    title="Ответить" type="submit">Ответить</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>


            <!-- ФОРМА ИСПРАВЛЕНИЯ ОТВЕТОВ ==================================================================================== -->
            <div class="collapse" id="reply_collapse_edit{{ $reply->id }}">
                <div class="card card-body p-1">

                    <form form_type="5" reply_id="{{ $reply->id }}">
                        <div text_div class="card card-body p-1 m-0"
                            id="text_div_reply_edit{{ $reply->id }}"
                            contenteditable="true"
                            data-placeholder="Напишите новый текст">
                            {{ $reply->reply }}
                        </div>
                        <input name="_method" type="hidden" value="PUT">
                        <div class="row p-1 ">
                            <div class="col-7 me-auto  flex-fill ">

                                <i class="bi bi-emoji-smile h3 "
                                    data-bs-toggle="collapse"
                                    href="#collapse_reply_edit_smile{{ $reply->id }}"
                                    role="button" aria-expanded="false"
                                    aria-controls="collapseExample"> </i>

                                <div class="collapse"
                                    id="collapse_reply_edit_smile{{ $reply->id }}">

                                    <span reply_id="{{ $reply->id }}"
                                        class="reply_edit_smile">😀</span>
                                    <span reply_id="{{ $reply->id }}"
                                        class="reply_edit_smile">👍</span>
                                    <span reply_id="{{ $reply->id }}"
                                        class="reply_edit_smile">👌</span>
                                    <span reply_id="{{ $reply->id }}"
                                        class="reply_edit_smile">😂</span>
                                    <span reply_id="{{ $reply->id }}"
                                        class="reply_edit_smile">😎</span>
                                    <span reply_id="{{ $reply->id }}"
                                        class="reply_edit_smile">😇</span>
                                    <span reply_id="{{ $reply->id }}"
                                        class="reply_edit_smile">😝</span>

                                    <span reply_id="{{ $reply->id }}"
                                        class="reply_edit_smile">👎</span>
                                    <span reply_id="{{ $reply->id }}"
                                        class="reply_edit_smile">💩</span>
                                    <span reply_id="{{ $reply->id }}"
                                        class="reply_edit_smile">😈</span>
                                    <span reply_id="{{ $reply->id }}"
                                        class="reply_edit_smile">☠</span>
                                    <span reply_id="{{ $reply->id }}"
                                        class="reply_edit_smile">😪</span>
                                    <span reply_id="{{ $reply->id }}"
                                        class="reply_edit_smile">😬</span>
                                    <span reply_id="{{ $reply->id }}"
                                        class="reply_edit_smile">😭</span>

                                </div>
                            </div>
                            <div class="col-auto p-0 pe-2 pt-1">
                                <button class="btn btn-primary btn-sm"
                                    title="Ответить" type="submit">Изменить</button>
                            </div>
                        </div>
                    </form>

                    <!-- ФОРМА УДАЛЕНИЯ КОММЕНТАРИЕВ ==================================================================================== -->

                    <form form_type="6" reply_id="{{ $reply->id }}">
                        {{-- <input type="hidden" name="reply_id"
                            value="{{ $reply->id }}"> --}}
                        <input name="_method" type="hidden" value="DELETE">
                        <button class="btn btn-link m-0 p-0"
                            title="Удаление комментария"
                            type="submit">удалить</button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

</div>