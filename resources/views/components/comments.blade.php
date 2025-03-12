<div id='comments{{ $post->id }}' class="overflow-x-hidden p-0  "
    style="max-height: 300px;">
    @foreach ($post->comment_plus as $comment)
        <div id="one_comment{{ $comment->id }}">
            <div class="card mb-2 p-0 m-0">
                <div class="card-header p-0 ">
                    <div class="row">
                        <div class="col-auto me-auto pe-0 flex-fill">
                            &nbsp; <b class="small">{{ $comment->user_name }}
                            </b>
                        </div>
                        <div class="col-auto  ps-0">
                            <nobr class="small"> @php
                                echo date('d.m.Y', strtotime($comment->created_at));
                            @endphp </nobr>
                            &nbsp;
                        </div>

                    </div>
                </div>
                <ul class="list-group list-group-flush p-0">
                    <li id="comment_text{{ $comment->id }}" class="list-group-item p-0">
                        {{ $comment->comment }}
                    </li>
                    <li class="list-group-item p-0">
                        <div class="row small">
                            <div class="col-auto me-auto pe-0 flex-fill">
                                {{-- ЛАЙК ДИЗЛАЙК КОМЕНТ==========================================================================    --}}


                                <i class="
                                @if ($comment->comment_like_active) {{ 'bi bi-hand-thumbs-up-fill' }} 
                                   @else
                                    {{ 'bi bi-hand-thumbs-up' }} @endif "
                                    style="cursor: pointer;" value="3"
                                    comment_id="{{ $comment->id }}">
                                    {{ $comment->comment_like_count }}</i>&nbsp;
                                <i class="
                                    @if ($comment->comment_dislike_active) {{ 'bi bi-hand-thumbs-down-fill' }} 
                                       @else
                                        {{ 'bi bi-hand-thumbs-down' }} @endif "
                                    style="cursor: pointer;" value="4"
                                    comment_id="{{ $comment->id }}">
                                    {{ $comment->comment_dislike_count }}</i>
                            </div>
                            <div class="col-auto  ps-0">

                                @auth
                                    @if ($comment->id_user == Auth::user()->name)
                                        <a class="link-underline-light p-0"
                                            data-bs-toggle="collapse"
                                            href="#coment_collapse{{ $comment->id }}"
                                            role="button" aria-expanded="false"
                                            aria-controls="collapseExample"
                                            title="Редактировать, удалить комментарий"
                                            style="cursor: pointer;">изменить
                                        </a>
                                    @endif
                                @endauth
                                <a class="link-underline-light p-0" data-bs-toggle="collapse"
                                    href="#coment_reply_collapse{{ $comment->id }}"
                                    role="button" aria-expanded="false"
                                    aria-controls="collapseExample"
                                    title="Редактировать, удалить комментарий"
                                    style=" cursor: pointer;"> &ensp; ответить
                                </a>

                            </div>
                        </div>
                    </li>

                </ul>
            </div>

            <!-- \\\\\\\\\\\\\\\\\\\\\\\\ ФОРМА ОТВЕТА НА КОММЕНТАРИИ ==================================================================================== -->
            <div class="collapse" id="coment_reply_collapse{{ $comment->id }}">
                <div class="card card-body p-1">

                    <form form_type="4" coment_id="{{ $comment->id }}" reply_id="0">
                        <div text_div class="card card-body p-1 m-0"
                            id="text_div_comment{{ $comment->id }}" contenteditable="true"
                            data-placeholder="Напишите ваш ответ">
                            {{ $comment->user_name }} &ensp;
                        </div>
                        <div class="row p-1 ">
                            <div class="col-7 me-auto  flex-fill ">

                                <i class="bi bi-emoji-smile h3 " data-bs-toggle="collapse"
                                    href="#collapse_comment_smile{{ $comment->id }}"
                                    role="button" aria-expanded="false"
                                    aria-controls="collapseExample"> </i>

                                <div class="collapse"
                                    id="collapse_comment_smile{{ $comment->id }}">

                                    <span comment_id="{{ $comment->id }}"
                                        class="comment_smile">😀</span>
                                    <span comment_id="{{ $comment->id }}"
                                        class="comment_smile">👍</span>
                                    <span comment_id="{{ $comment->id }}"
                                        class="comment_smile">👌</span>
                                    <span comment_id="{{ $comment->id }}"
                                        class="comment_smile">😂</span>
                                    <span comment_id="{{ $comment->id }}"
                                        class="comment_smile">😎</span>
                                    <span comment_id="{{ $comment->id }}"
                                        class="comment_smile">😇</span>
                                    <span comment_id="{{ $comment->id }}"
                                        class="comment_smile">😝</span>

                                    <span comment_id="{{ $comment->id }}"
                                        class="comment_smile">👎</span>
                                    <span comment_id="{{ $comment->id }}"
                                        class="comment_smile">💩</span>
                                    <span comment_id="{{ $comment->id }}"
                                        class="comment_smile">😈</span>
                                    <span comment_id="{{ $comment->id }}"
                                        class="comment_smile">☠</span>
                                    <span comment_id="{{ $comment->id }}"
                                        class="comment_smile">😪</span>
                                    <span comment_id="{{ $comment->id }}"
                                        class="comment_smile">😬</span>
                                    <span comment_id="{{ $comment->id }}"
                                        class="comment_smile">😭</span>

                                </div>
                            </div>
                            <div class="col-auto p-0 pe-2 pt-1">
                                <button class="btn btn-primary btn-sm" title="Ответить"
                                    type="submit">Отправить</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

            <!-- ФОРМА ИСПРАВЛЕНИЯ КОММЕНТАРИЕВ ==================================================================================== -->
            <div class="collapse" id="coment_collapse{{ $comment->id }}">
                <div class="card card-body p-1">

                    <form form_type="2" coment_id="{{ $comment->id }}">
                        <div text_div class="card card-body p-1 m-0"
                            id="text_div_comment_edit{{ $comment->id }}"
                            contenteditable="true" data-placeholder="Напишите новый текст">
                            {{ $comment->comment }}
                        </div>
                        <div class="row p-1 ">
                            <div class="col-7 me-auto  flex-fill ">

                                <i class="bi bi-emoji-smile h3 " data-bs-toggle="collapse"
                                    href="#collapse_comment_edit_smile{{ $comment->id }}"
                                    role="button" aria-expanded="false"
                                    aria-controls="collapseExample"> </i>

                                <div class="collapse"
                                    id="collapse_comment_edit_smile{{ $comment->id }}">

                                    <span comment_id="{{ $comment->id }}"
                                        class="comment_edit_smile">😀</span>
                                    <span comment_id="{{ $comment->id }}"
                                        class="comment_edit_smile">👍</span>
                                    <span comment_id="{{ $comment->id }}"
                                        class="comment_edit_smile">👌</span>
                                    <span comment_id="{{ $comment->id }}"
                                        class="comment_edit_smile">😂</span>
                                    <span comment_id="{{ $comment->id }}"
                                        class="comment_edit_smile">😎</span>
                                    <span comment_id="{{ $comment->id }}"
                                        class="comment_edit_smile">😇</span>
                                    <span comment_id="{{ $comment->id }}"
                                        class="comment_edit_smile">😝</span>

                                    <span comment_id="{{ $comment->id }}"
                                        class="comment_edit_smile">👎</span>
                                    <span comment_id="{{ $comment->id }}"
                                        class="comment_edit_smile">💩</span>
                                    <span comment_id="{{ $comment->id }}"
                                        class="comment_edit_smile">😈</span>
                                    <span comment_id="{{ $comment->id }}"
                                        class="comment_edit_smile">☠</span>
                                    <span comment_id="{{ $comment->id }}"
                                        class="comment_edit_smile">😪</span>
                                    <span comment_id="{{ $comment->id }}"
                                        class="comment_edit_smile">😬</span>
                                    <span comment_id="{{ $comment->id }}"
                                        class="comment_edit_smile">😭</span>

                                </div>
                            </div>
                            <div class="col-auto p-0 pe-2 pt-1">
                                <button class="btn btn-primary btn-sm" title="Ответить"
                                    type="submit">Изменить</button>
                            </div>
                        </div>
                    </form>

                    <!-- ФОРМА УДАЛЕНИЯ КОММЕНТАРИЕВ ==================================================================================== -->

                    <form form_type="3" coment_id="{{ $comment->id }}">
                        {{-- <input type="hidden" name="comment_id"
                            value="{{ $comment->id }}"> --}}
                        <input name="_method" type="hidden" value="DELETE">
                        <button class="btn btn-link m-0 p-0" title="Удаление комментария"
                            type="submit">удалить</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- ----------------------------------------------------------------------------------------------------------------------------Вставляем ответы на комментарии --}}

        <x-replys :comment="$comment"/>
        {{-- ---------------------------------------------------------------------------------------------- --}}
    @endforeach
    
</div>