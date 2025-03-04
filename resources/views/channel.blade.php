@extends('layouts/main') 

@section('posts')  

<div div class="card my-3">
    <div class="card-body pt-2 pb-0 m-1 shadow rounded" style = "background-color : #@if($user_data->color_channel == null)283196 @else{{$user_data->color_channel}} @endif";>
        <i class=" text-white">Личный канал: </i>
        <h3 class="my-0 fw-normal text-white">@if($user_data->name_channel == null){{$user->name}} @else{{$user_data->name_channel}} @endif</h4>
            <p class=" text-white">@if($user_data->definition_channel == null)Автоэлектрика и диагностика @else{{$user_data->definition_channel}} @endif</p>
            {{-- <a class="nav-link text-white" href="" >Подписатся</a> --}}
</div></div>

{{-- style="height: 150px;" --}}
<div id="posts"></div>  {{-- в див вставляем посты --}}

@endsection 

@section('hidden') 

<x-hidden-post /> {{-- скрытый шаблон для поста --}}
<x-hidden-comment />
<x-hidden-reply />
<div id="page_url" hidden>/api_channel/{{$id}}</div>
@endsection 

@section('js') 
<script defer src="{{ url('client2.js') }}"></script>
<script defer src="{{ url('client.js') }}"></script>
@endsection  