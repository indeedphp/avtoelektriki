@extends('layouts/admin')



@section('posts')

<x-nav-admin/>


{{-- {{ route('cabinet_statistic') }} --}}

{{-- created_at --}}
<hr>
<form action="{{ route('admin_posts') }}" method="GET">
    <input type="text" size="20" name="count" placeholder = "Показывать по {{$count}} id">
</form>
<hr>
<table class="table table-striped">
    <thead>
        <tr>
            <th class="ps-0 pe-1" scope="col"><a href="{{route('admin_posts', ['page' => $posts->currentPage(), 'count' => $count, 'sorting' => 'id_'.$sort])}}"> Id</a>
                <form action="{{ route('admin_posts') }}" method="GET">
                    <input type="text" class="form-control p-1" name="id_search" placeholder = "id">
                </form>
            </th>
            <th class="ps-0 pe-1" scope="col"><a href="{{route('admin_posts', ['page' => $posts->currentPage(), 'count' => $count, 'sorting' => 'id_user_'.$sort])}}">id user</a>
                <form action="{{ route('admin_posts') }}" method="GET">
                    <input type="text" class="form-control p-1" name="id_user_search" placeholder = "id">
                </form>
            </th>
            <th class="ps-1 pe-1"  scope="col"><a href="{{route('admin_posts', ['page' => $posts->currentPage(), 'count' => $count, 'sorting' => 'date_cr_'.$sort])}}">Дата созд.</a>
                <form action="{{ route('admin_posts') }}" method="GET">
                    <input type="text" class="form-control p-1" name="date_cr_search" placeholder = "д-м-г">
                </form>
            </th>
            <th class="ps-1 pe-1" scope="col"><a href="{{route('admin_posts', ['page' => $posts->currentPage(), 'count' => $count, 'sorting' => 'date_up_'.$sort])}}">Дата обн.</a>
                <form action="{{ route('admin_posts') }}" method="GET">
                    <input type="text" class="form-control p-1" name="date_up_search" placeholder = "д-м-г">
                </form>
            </th>
            <th class="ps-1 pe-1" scope="col">Название поста
                <form action="{{ route('admin_posts') }}" method="GET">
                    <input type="text"  class="form-control p-1"  name="name_post_search" placeholder = "Название поста">
                </form>

            </th>

            <th scope="col"><a href="{{route('admin_posts', ['page' => $posts->currentPage(), 'count' => $count, 'sorting' => 'activ_'.$sort])}}">ban</a></th>
            
            <th scope="col">cor</th>
           
        
            
        </tr>
    </thead>

<tbody>
@foreach ($posts as $post)

    <tr>
        <th scope="row" >{{ $post->id }}</th>  
        <th scope="row"><a href="{{route('admin_users', ['id_search' => $post->id_user])}}" >{{ $post->id_user }}</a> </th>
        <td>{{date('d-m-Y', strtotime($post->created_at))}}</td>
        <td>{{date('d-m-Y', strtotime($post->updated_at))}}</td>
        <td>{{Str::limit($post->name_post , 18)}}</td>
        <td>{{$post->stuff}}</td>
        <td> <a href="" data-bs-toggle="modal" data-bs-target="#Modal_{{$post->id}}">cor</a> </td>

    </tr>

    <!-- Модальное окно -->
    <div class="modal fade" id="Modal_{{$post->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
        
                    <ul>
                        <li>id пост {{ $post->id }}</li>
                        <li>дата созд. {{ date('d-m-Y', strtotime($post->created_at)) }}</li>
                        <li>дата изм. {{ date('d-m-Y', strtotime($post->created_at)) }}</li>
                        <li>id юзера {{$post->id_user}}</li>
                        <li>имя юзера {{$post->user_name}}</li>
                        <li>название {{$post->name_post}}</li>
                        <li>текст 1 {{$post->text_post}}</li>
                        <li>разрешения {{$post->stuff}}</li>
                    </ul>
                    <a href="{{ route('admin_post_update', [$post->id, '1', 'page' => $posts->currentPage(), 'count' => $count]) }}" class="btn btn-secondary">бан</a>
                    <a href="{{ route('admin_post_update', [$post->id, '0', 'page' => $posts->currentPage(), 'count' => $count]) }}" class="btn btn-secondary" >дебан</a>
                </div>
            </div>
        </div>
    </div>


   



@endforeach

</tbody>
</table>









<div> {{ $posts->links()}}  </div> 
@endsection
