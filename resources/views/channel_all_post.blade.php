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
{{-- height="255"  --}}

@foreach ($posts as $post)
<div class="card my-2">

    <div class="card-body p-1">

        <div class="row ">

            <div class="col-4 p-0  ">
                <img class=" img-fluid ps-3 p-0" width="200" height="200" src="{{url($post->url_foto)}}" alt="Фото потерялось">
            </div>
            <div class="col-8 d-sm-none"><b>{{Str::limit($post->name_post, 25)}}</b>
                
                {{Str::limit($post->text_post, 40)}}
            </div>
            <div class="col-8 d-none d-sm-block"><b>{{$post->name_post}}</b>
                
                <p>{{Str::limit($post->text_post, 300)}}</p>
                
            </div>
        </div>
    </div>
    <div class="card-footer text-muted p-1">
        <div class="float-start ms-2 p-0">
</div>
        <div class="float-end me-2 p-0" ><a class="btn btn-sm p-0" href="{{ route('channel2', $post->id) }}" target="_blank">Показать</a></div>
    
        
    </div>
</div>
@endforeach

{{ $posts->links() }}


@endsection 




