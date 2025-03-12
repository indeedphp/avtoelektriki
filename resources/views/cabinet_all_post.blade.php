@extends('layouts/main')



@section('posts')
<x-nav-cabinet/>

    <hr>
    <b class=" mb-3" >Всего постов у вас {{$count}} </b> 
    <hr>
    
    @foreach ($posts as $post)
        <div class="card my-2">
 
            <div class="card-body p-1">

                <div class="row ">

                    <div class="col-4 p-0  ">
                        <img class=" img-fluid ps-3 p-0" src="{{$post->url_foto}}" alt="Фото потерялось">
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
                     <form method="POST" action="{{ route('cabinet_all_post_delete', $post->id) }}">
                         @method('DELETE') @csrf <button class="btn btn-sm p-0">Удалить</button></form> 
                     </div>
                     <div class="float-end me-2 p-0" ><a class="btn btn-sm p-0" href="{{ route('cabinet_edit_post', $post->id) }}">Редактировать</a></div>
                <div class="float-end me-2 p-0" ><a class="btn btn-sm p-0" href="{{ route('channel2', $post->id) }}" target="_blank">Показать</a></div>

                
            </div>
        </div>
    @endforeach


    {{ $posts->links() }}

    
@endsection


