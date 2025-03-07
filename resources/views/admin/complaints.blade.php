@extends('layouts/admin')



@section('posts')
<x-nav-admin/>

<hr>
<p>{{$notviewed}} непросмотренных жалоб</p> 
<hr>
<form action="{{ route('admin_complaints') }}" method="GET">
    <input type="text" size="20" name="count" placeholder = "Показывать по {{ $count }} id">
</form>
<hr>


<table class="table table-striped">
    <thead>
        <tr>
            <th class="ps-0 pe-1" scope="col"><a
                href="{{ route('admin_complaints', ['page' => $complaints->currentPage(), 'count' => $count, 'sorting' => 'id_' . $sort]) }}"> Id</a>
                    <form action="{{ route('admin_complaints') }}" method="GET">
                        <input type="text" class="form-control p-1" name="id_search" placeholder = "id">
                    </form>
        
            </th>
            <th class="ps-1 pe-1" scope="col"><a
                href="{{ route('admin_complaints', ['page' => $complaints->currentPage(), 'count' => $count, 'sorting' => 'date_cr_' . $sort]) }}">Дата</a>
                    <form action="{{ route('admin_complaints') }}" method="GET">
                        <input type="text" class="form-control p-1" name="date_cr_search" placeholder = "д-м-г">
                    </form>

                </th>
                <th class="ps-1 pe-1" scope="col"><a
                    href="{{ route('admin_complaints', ['page' => $complaints->currentPage(), 'count' => $count, 'sorting' => 'id_post_' . $sort]) }}">id поста</a>
                    <form action="{{ route('admin_complaints') }}" method="GET">
                        <input type="text" class="form-control p-1" name="id_post_search" placeholder = "id">
                    </form>
                </th>   
  
            </th>
            <th class="ps-1 pe-1" scope="col"><a
                href="{{ route('admin_complaints', ['page' => $complaints->currentPage(), 'count' => $count, 'sorting' => 'complaint_' . $sort]) }}">Жалоба</a>
                    <form action="{{ route('admin_complaints') }}" method="GET">
                        <input type="text" class="form-control p-1" name="complaint_search" placeholder = "Жалоба">
                    </form>
       
            </th>
            <th class="ps-1 pe-1" scope="col"><a
                href="{{ route('admin_complaints', ['page' => $complaints->currentPage(), 'count' => $count, 'sorting' => 'complainer_' . $sort]) }}">id написавшего</a>
                <form action="{{ route('admin_complaints') }}" method="GET">
                    <input type="text" class="form-control p-1" name="complainer_search" placeholder = "id">
                </form>
            </th>
        </th>
        <th class="ps-1 pe-1" scope="col"><a
            href="{{ route('admin_complaints', ['page' => $complaints->currentPage(), 'count' => $count, 'sorting' => 'untrue_' . $sort]) }}">id плохиша</a>
            <form action="{{ route('admin_complaints') }}" method="GET">
                <input type="text" class="form-control p-1" name="untrue_search" placeholder = "id">
            </form>
        </th>

            <th scope="col">
                <a href="{{ route('admin_complaints', ['page' => $complaints->currentPage(), 'count' => $count, 'sorting' => 'type_' . $sort]) }}">тип</a>
            </th>

            



        </tr>
    </thead>

    <tbody>
        @foreach($complaints as $complaint)
            <tr>
                <th class="@if($complaint->viewed == null) bg-warning-subtle @endif" scope="row">{{ $complaint->id }}</th>
                <td class="@if($complaint->viewed == 1) bg-warning-subtle @endif">{{ date('d-m-Y', strtotime($complaint->created_at)) }}</td>
                <td> <a href="{{ url('/post/'.$complaint->id_post) }}" target="_blank">{{ $complaint->id_post }}</a></td>
                <td><a href="" data-bs-toggle="modal" data-bs-target="#Modal_{{$complaint->id}}">{{ Str::limit($complaint->complaint, 18) }}</a></td>
                <td><a href="{{route('admin_users', ['id_search' => $complaint->id_user_complaint])}}">{{ $complaint->id_user_complaint }}</a></td>
                <td><a href="{{route('admin_users', ['id_search' => $complaint->id_user_untrue])}}">{{ $complaint->id_user_untrue }}</a></td>
                <th>
                    @if($complaint->essence == 1)
                    <a href="{{ route('admin_posts', ['id_search' => $complaint->id_pcr]) }}">пост</a>
                    @elseif ($complaint->essence == 2)
                    <a href="{{route('admin_comments', ['id_search' => $complaint->id_pcr])}}">комент</a> 
                    @else
                    <a href="{{route('admin_replys', ['id_search' => $complaint->id_pcr])}}">комент.</a> 
                      @endif
                </th>

                {{-- <td> <a href="" data-bs-toggle="modal" data-bs-target="#Modal_{{$complaint->id}}">cor</a> </td> --}}

                {{-- <th class="ps-0 pe-1" scope="col"><a href="{{route('admin_replys', ['page' => $replys->currentPage(), 'count' => $count, 'sorting' => 'id_'.$sort])}}"> Id</a>
                    <form action="{{ route('admin_replys') }}" method="GET">
                        <input type="text" class="form-control p-1" name="id_search" placeholder = "id">
                    </form>
                     --}}
                    
            </tr>


    <!-- Модальное окно -->
    <div class="modal fade" id="Modal_{{$complaint->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                        <li class=" p-2 rounded">{{ $complaint->complaint }}</li>
    </div></div></div>






            @endforeach
            {{-- 'complaint',
            'id_user_complaint',
            'id_user_untrue',
            'essence',
            'id_pcr',
            'viewed',
            'stuff', --}}
        



        </table>

{{-- {{$complaints['message']}} --}}
<div> {{ $complaints->links() }} </div>
@endsection