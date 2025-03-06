@extends('layouts/admin')



@section('posts')
<x-nav-admin/>


{{$notviewed}} непросмотренных жалоб

<hr>
<table class="table table-striped">
    <thead>
        <tr>
            <th class="ps-0 pe-1" scope="col"><a
                    href=""> Id</a>
        
            </th>
            <th class="ps-1 pe-1" scope="col"><a
                    href="">Дата</a>

                </th>
                <th class="ps-1 pe-1" scope="col">id поста
                </th>   
  
            </th>
            <th class="ps-1 pe-1" scope="col"><a
                    href="">Жалоба</a>
       
            </th>
            <th class="ps-1 pe-1" scope="col">id написавшего
            </th>
        </th>
        <th class="ps-1 pe-1" scope="col">id плохиша
 

        </th>


            <th scope="col">тип</th>

            



        </tr>
    </thead>

    <tbody>
        @foreach($complaints as $complaint)
            <tr>
                <th class="@if($complaint->viewed == null) bg-warning-subtle @endif" scope="row">{{ $complaint->id }}</th>
                <td class="@if($complaint->viewed == 1) bg-warning-subtle @endif">{{ date('d-m-Y', strtotime($complaint->created_at)) }}</td>
                <td> <a href="{{ url('/post/'.$complaint->id_post) }}" target="_blank">{{ $complaint->id_post }}</a></td>
                <td><a href="" data-bs-toggle="modal" data-bs-target="#Modal_{{$complaint->id}}">{{ Str::limit($complaint->complaint, 20) }}</a></td>
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
                        <li class="bg-light p-2 rounded">{{ $complaint->complaint }}</li>
        </div>
    </div>






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