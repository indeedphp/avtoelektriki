

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
            <th class="ps-0 pe-1" scope="col"><a href="{{route('admin_sites', ['page' => $sites->currentPage(), 'count' => $count, 'sorting' => 'id_'.$sort])}}"> Id</a>
                <form action="{{ route('admin_sites') }}" method="GET">
                    <input type="text" class="form-control p-1" name="id_search" placeholder = "id">
                </form>
            </th>
            <th class="ps-0 pe-1" scope="col"><a href="{{route('admin_sites', ['page' => $sites->currentPage(), 'count' => $count, 'sorting' => 'id_user_'.$sort])}}"> Id user</a>
                <form action="{{ route('admin_sites') }}" method="GET">
                    <input type="text" class="form-control p-1" name="id_user_search" placeholder = "id">
                </form>
            </th>
            <th class="ps-1 pe-1"  scope="col"><a href="{{route('admin_sites', ['page' => $sites->currentPage(), 'count' => $count, 'sorting' => 'date_cr_'.$sort])}}">Дата созд.</a>
                <form action="{{ route('admin_sites') }}" method="GET">
                    <input type="text" class="form-control p-1" name="date_cr_search" placeholder = "д-м-г">
                </form>
            </th>
            <th class="ps-1 pe-1" scope="col"><a href="{{route('admin_sites', ['page' => $sites->currentPage(), 'count' => $count, 'sorting' => 'date_up_'.$sort])}}">Дата обн.</a>
                <form action="{{ route('admin_sites') }}" method="GET">
                    <input type="text" class="form-control p-1" name="date_up_search" placeholder = "д-м-г">
                </form>
            </th>
            <th class="ps-1 pe-1" scope="col">Заголовок
                <form action="{{ route('admin_sites') }}" method="GET">
                    <input type="text"  class="form-control p-1"  name="name_search" placeholder = "Заголовок">
                </form>

            </th>

            <th scope="col"><a href="{{route('admin_sites', ['page' => $sites->currentPage(), 'count' => $count, 'sorting' => 'activ_'.$sort])}}">ban</a></th>
            
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
        <td>{{$site->active}}</td>
        
        <td> <a href="" data-bs-toggle="modal" data-bs-target="#Modal_{{$site->id}}">cor</a> </td>

      

    </tr>


    <!-- Модальное окно -->
    <div class="modal fade" id="Modal_{{$site->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
        
                    <ul>
                        <li>id сайт: {{ $site->id }}</li>
                        <li>дата созд.: {{ date('d-m-Y', strtotime($site->created_at)) }}</li>
                        <li>дата изм.: {{ date('d-m-Y', strtotime($site->created_at)) }}</li>
                        <li>id юзера: {{$site->id_user}}</li>
                        <li>имя юзера: {{$site->user_name}}</li>
                        <li>комментарий: {{$site->reply}}</li>
                        <li>разрешения: {{$site->active}}</li>
                        <li>заголовок: {{$site->heading}}</li>
                        <li>верхний текст: {{$site->top_text}}</li>
                        <li>заголовок карточки 1: {{$site->text_1_a}}</li>
                        <li>текст карточки 1: {{$site->text_1_b}}</li>
                        <li>заголовок карточки 2: {{$site->text_2_a}}</li>
                        <li>текст карточки 2: {{$site->text_2_b}}</li>
                    </ul>
                    <a href="{{ route('admin_site_update', [$site->id, '1', 'page' => $sites->currentPage(), 'count' => $count]) }}" class="btn btn-secondary">бан</a>
                    <a href="{{ route('admin_site_update', [$site->id, '0', 'page' => $sites->currentPage(), 'count' => $count]) }}" class="btn btn-secondary" >дебан</a>
                </div>
            </div>
        </div>
    </div>




@endforeach

</tbody>
</table>









<div> {{ $sites->links()}}  </div> 
@endsection
