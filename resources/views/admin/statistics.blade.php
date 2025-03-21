@extends('layouts/admin')



@section('posts')

<x-nav-admin/>

<p>Вы в админке портала "автоэлектрики" на странице статистики</p>
{{-- {{ route('cabinet_statistic') }} --}}

<div class="p-3">
    <b>Количество входов на фреймворк  {{ $statistic->num }}  </b>
</div>

<div class="p-3">
    <b>Количество просмотров главной страницы  {{ $statistic->index }}  </b>
</div>
<div class="p-3">
    <b>Количество просмотров каналов  {{ $statistic->channel }}  </b>
</div>
<div class="p-3">
    <b>Количество просмотров постов оттдельно  {{ $statistic->post }}  </b>
</div>
<div class="p-3">
    <b>Количество просмотров на кабинет  {{ $statistic->cabinet }}  </b>
</div>
<div class="p-3">
    <b>Количество просмотров готовых сайтов всех  {{ $statistic->site }}  </b>
</div>
<div class="p-3">
    <b>Количество поданных жалоб  {{ $statistic->complaints }}  </b>
</div>
<div class="p-3">
    <b>Количество просмотров админки  {{ $statistic->admin }}  </b>
</div>
<div class="p-3">
    <b>Количество вызовов в боте функции старт  {{ $statistic->bot_start }}  </b>
</div>
<div class="p-3">
    <b>Количество вызовов в боте функции новый пост  {{ $statistic->bot_post }}  </b>
</div>
<hr>
{{-- ---------------------------------------------------------------------------------------- --}}

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