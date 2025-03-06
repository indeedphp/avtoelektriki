@extends('layouts/admin')



@section('posts')

<x-nav-admin/>


{{-- {{ route('cabinet_statistic') }} --}}





<p>Вы в админке портала "автоэлектрики" на странице статистики</p>

<div class="p-3">
    <b>Всего зарегистрированных пользователей: </b> {{ $user_count }}
</div>
<div class="p-3">
    <b>Всего размещенно постов на портале: </b> {{ $post_count }}
</div>
<div class="p-3">
    <b>Всего размещенно комментариев: </b> {{ $comment_count }}
</div>
<div class="p-3">
    <b>Всего создано личных сайтов: </b> {{ $site_count }}
</div>
<div class="p-3">
    <b>Размер директории хранилища фото:  {{ $size_file }}Мб.  </b>
</div>
<div class="p-3">
    <b>Количество фото в директории хранилища:  {{ $count_files }}  </b>
</div>

<p>Время сервера {{date('i:H d-m-Y')}}</p>
<p>Адрес сервера {{$addr}}</p>
@endsection