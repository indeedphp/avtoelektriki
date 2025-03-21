@extends('layouts/main') 

@section('posts')  

<div div class="card  my-3 @if($user_data->stuff == 1)text-white @endif">

    <div class="card-body row pt-2 pb-0 m-0 p-0 shadow rounded " style = "background-color : @if($user_data->color_channel == null)#B7B7B7 @else{{$user_data->color_channel}} @endif";>
    <div class=" m-0 px-2" >    <i class=" float-start  ">Личный канал: </i>  <a class="m-0 float-end h4 bi bi-file-earmark-plus " href="{{route('cabinet_new_post')}}" title="Создать пост"></a> </div>

    
    <div  class="m-0 px-2" >   <h3 class="my-0 fw-normal ">@if($user_data->name_channel == null){{$user->name}} @else{{$user_data->name_channel}} @endif</h4></div>
      {{-- <div>       <p class=" ">@if($user_data->definition_channel == null)Автоэлектрика и диагностика @else{{$user_data->definition_channel}} @endif</p></div> --}}
      <div class=" m-0 px-2" >    <p class=" float-start  ">@if($user_data->definition_channel == null)Автоэлектрика и диагностика @else{{$user_data->definition_channel}} @endif </p>  <a class="float-end me-1 h4 nav-link bi bi-stack" href="{{route('channel_all_post', $id)}}" title="Посмотреть все посты на канале"></a> </div>
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


{{-- <div class="card-footer text-muted px-0 py-1 p-lg-3 ">
            
    <!-- ЛАЙК -->
    <div class="float-start pe-2">
        <i class="bi bi-hand-thumbs-up ps-1"> 0</i>&nbsp;
    </div>
    <!-- РЕПОСТ -->
    <div class="float-start">
        <i class="bi bi-share text-black-80"> Поделится</i>
    </div>
    <!-- КОМЕНТАРИИ КНОПКА -->
    <div class="float-end pe-2">
        <i class="bi bi-chat-dots text-black-80"> Комментарии </i>
    </div>


</div> --}}