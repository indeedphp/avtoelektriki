
@extends('layouts/admin')



@section('posts')

<x-nav-admin/>

{{-- {{ route('cabinet_statistic') }} --}}

{{-- created_at --}}
<hr>
<form action="{{ route('admin_replys') }}" method="GET">
    <input type="text" size="20" name="count" placeholder = "Показывать по {{$count}} id">
</form>
<hr>
<table class="table table-striped">
    <thead>
        <tr>
            <th class="ps-0 pe-1" scope="col"><a href="{{route('admin_replys', ['page' => $replys->currentPage(), 'count' => $count, 'sorting' => 'id_'.$sort])}}"> Id</a>
                <form action="{{ route('admin_replys') }}" method="GET">
                    <input type="text" class="form-control p-1" name="id_search" placeholder = "id">
                </form>
            </th>
            <th class="ps-0 pe-1" scope="col"><a href="{{route('admin_replys', ['page' => $replys->currentPage(), 'count' => $count, 'sorting' => 'user_id_'.$sort])}}">user id</a>
                <form action="{{ route('admin_replys') }}" method="GET">
                    <input type="text" class="form-control p-1" name="user_id_search" placeholder = "id">
                </form>
            </th>
            <th class="ps-0 pe-1" scope="col"><a href="{{route('admin_replys', ['page' => $replys->currentPage(), 'count' => $count, 'sorting' => 'comment_id_'.$sort])}}">comment id</a>
                <form action="{{ route('admin_replys') }}" method="GET">
                    <input type="text" class="form-control p-1" name="comment_id_search" placeholder = "id">
                </form>
            </th>


            <th class="ps-1 pe-1"  scope="col"><a href="{{route('admin_replys', ['page' => $replys->currentPage(), 'count' => $count, 'sorting' => 'date_cr_'.$sort])}}">Дата созд.</a>
                <form action="{{ route('admin_replys') }}" method="GET">
                    <input type="text" class="form-control p-1" name="date_cr_search" placeholder = "д-м-г">
                </form>
            </th>
            <th class="ps-1 pe-1" scope="col"><a href="{{route('admin_replys', ['page' => $replys->currentPage(), 'count' => $count, 'sorting' => 'date_up_'.$sort])}}">Дата обн.</a>
                <form action="{{ route('admin_replys') }}" method="GET">
                    <input type="text" class="form-control p-1" name="date_up_search" placeholder = "д-м-г">
                </form>
            </th>
            <th class="ps-1 pe-1" scope="col">Имя
                <form action="{{ route('admin_replys') }}" method="GET">
                    <input type="text"  class="form-control p-1"  name="name_search" placeholder = "name">
                </form>

            </th>
<th scope="col">Ответ</th>
            <th scope="col"><a href="{{route('admin_replys', ['page' => $replys->currentPage(), 'count' => $count, 'sorting' => 'activ_'.$sort])}}">ban</a></th>
            
            <th scope="col">cor</th>
           
        
            
        </tr>
    </thead>

<tbody>
@foreach ($replys as $reply)

    <tr>
        <th scope="row">{{ $reply->id }} </th>  
        <th scope="row"><a href="{{route('admin_users', ['id_search' => $reply->user_id])}}" >{{ $reply->user_id }}</a> </th>
        <th scope="row"><a href="{{route('admin_comments', ['id_search' => $reply->comment_id])}}" >{{ $reply->comment_id }}</a> </th>
        <td>{{date('d-m-Y', strtotime($reply->created_at))}}</td>
        <td>{{date('d-m-Y', strtotime($reply->updated_at))}}</td>
        <td>{{Str::limit($reply->user_name , 12)}}</td>
        <td>{{$reply->reply}}</td>
        <td>{{$reply->activ}}</td>
        <td> <a href="" data-bs-toggle="modal" data-bs-target="#Modal_{{$reply->id}}">cor</a> </td>

    </tr>


    <!-- Модальное окно -->
    <div class="modal fade" id="Modal_{{$reply->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
        
                    <ul>
                        <li>id пост {{ $reply->id }}</li>
                        <li>дата созд. {{ date('d-m-Y', strtotime($reply->created_at)) }}</li>
                        <li>дата изм. {{ date('d-m-Y', strtotime($reply->created_at)) }}</li>
                        <li>id юзера {{$reply->id_user}}</li>
                        <li>имя юзера {{$reply->user_name}}</li>
                        <li>комментарий {{$reply->reply}}</li>
                        <li>разрешения {{$reply->activ}}</li>
                    </ul>
                    <a href="{{ route('admin_reply_update', [$reply->id, '1', 'page' => $replys->currentPage(), 'count' => $count]) }}" class="btn btn-secondary">бан</a>
                    <a href="{{ route('admin_reply_update', [$reply->id, '0', 'page' => $replys->currentPage(), 'count' => $count]) }}" class="btn btn-secondary" >дебан</a>
                </div>
            </div>
        </div>
    </div>




@endforeach

</tbody>
</table>









<div> {{ $replys->links()}}  </div> 
@endsection
