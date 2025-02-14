

@extends('layouts/admin')



@section('posts')

<nav class="navbar navbar-expand-lg  p-0 pe-2">

    <a class="navbar-brand p-0 m-0">Админка:</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ps-2">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin_index')}}">Начальная</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin_users')}}">Все пользователи</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin_posts')}}">Все посты</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin_comments')}}">Все комментарии</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin_replys')}}">Все ответы на комментарии</a>
            </li>
            <li class="nav-item">
                <a class="nav-link link-danger" href="{{ route('admin_sites')}}">Все сайты</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin_settings')}}">Настройки</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin_statistics')}}">Статистика</a>
            </li>
        </ul>
    </div>
</nav>


{{-- {{ route('cabinet_statistic') }} --}}

{{-- created_at --}}
<hr>
<form action="{{ route('admin_sites') }}" method="GET">
    <input type="text" size="20" name="count" placeholder = "Показывать по {{$count}} id">
</form>
<hr>
<table class="table table-striped">
    <thead>
        <tr>
            <th class="ps-0 pe-1" scope="col"><a href="{{route('admin_sites', ['count' => $count, 'sorting' => 'id_'.$sort])}}"> Id</a>
                <form action="{{ route('admin_sites') }}" method="GET">
                    <input type="text" class="form-control p-1" name="id_search" placeholder = "id">
                </form>
            </th>
            <th class="ps-0 pe-1" scope="col"><a href="{{route('admin_sites', ['count' => $count, 'sorting' => 'id_user_'.$sort])}}"> Id user</a>
                <form action="{{ route('admin_sites') }}" method="GET">
                    <input type="text" class="form-control p-1" name="id_user_search" placeholder = "id">
                </form>
            </th>
            <th class="ps-1 pe-1"  scope="col"><a href="{{route('admin_sites', ['count' => $count, 'sorting' => 'date_cr_'.$sort])}}">Дата созд.</a>
                <form action="{{ route('admin_sites') }}" method="GET">
                    <input type="text" class="form-control p-1" name="date_cr_search" placeholder = "д-м-г">
                </form>
            </th>
            <th class="ps-1 pe-1" scope="col"><a href="{{route('admin_sites', ['count' => $count, 'sorting' => 'date_up_'.$sort])}}">Дата обн.</a>
                <form action="{{ route('admin_sites') }}" method="GET">
                    <input type="text" class="form-control p-1" name="date_up_search" placeholder = "д-м-г">
                </form>
            </th>
            <th class="ps-1 pe-1" scope="col">Заголовок
                <form action="{{ route('admin_sites') }}" method="GET">
                    <input type="text"  class="form-control p-1"  name="name_search" placeholder = "Заголовок">
                </form>

            </th>

            <th scope="col"><a href="{{route('admin_sites', ['sorting' => 'activ_'.$sort])}}">ban</a></th>
            
            <th scope="col">cor</th>
           
        
            
        </tr>
    </thead>

<tbody>
@foreach ($sites as $site)

    <tr>
        <th scope="row">{{ $site->id }} </th>  
        <th scope="row"><a href="{{route('admin_users', ['id_search' => $site->id_user])}}" >{{ $site->id_user }}</a> </th>
        <td>{{date('d-m-Y', strtotime($site->created_at))}}</td>
        <td>{{date('d-m-Y', strtotime($site->updated_at))}}</td>
        <td>{{Str::limit($site->heading , 25)}}</td>
        <td>{{$site->activ}}</td>
        
        <td> <a href="" >cor</a> </td>
      

    </tr>

@endforeach

</tbody>
</table>









<div> {{ $sites->links()}}  </div> 
@endsection
