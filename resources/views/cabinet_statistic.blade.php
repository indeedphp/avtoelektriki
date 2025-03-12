@extends('layouts/main')



@section('posts')
<x-nav-cabinet/> {{-- вставляем навигацию --}}

    <div class="p-3">
        <b>Всего размещенно постов на портале: {{ $post_count }} </b>
    </div>
    <div class="p-3">
        <b>Всего написано вами комментариев на портале:  {{ $comments_count }}</b>
    </div>
    <div class="p-3">
        <b>Последний пост рамещен: дата {{ $last_post['created_at']}}</b>
    </div>
    <div class="p-3">
        <b>Последний коментарий вами написан: дата {{$last_comments['created_at'] }}</b> 
    </div>
    <div class="p-3">
        <b>Последний коментарий вам написан: дата </b>
    </div>
    <div class="p-3">
        <b>Поставлено вами лайков: количество </b>
    </div>
    <div class="p-3">
        <b>Поставлено вами дизлайков: количество </b>
    </div>
    <div class="p-3">
        <b>Поставлено вам лайков: количество </b>
    </div>
    <div class="p-3">
        <b>Поставлено вам дизлайков: количество </b>
    </div>
    <div class="p-3">
        <b>Написано коментариев на ваши посты: количество </b>
    </div>
    <div class="p-3">
        <b>Вы зарегистрированы на портале: когда </b>
    </div>
@endsection
