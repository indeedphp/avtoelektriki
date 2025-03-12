@extends('layouts/admin')



@section('posts')
<x-nav-admin/>


    {{-- {{ route('cabinet_statistic') }} --}}

    {{-- created_at --}}
    <hr>
    <form action="{{ route('admin_users') }}" method="GET">
        <input type="text" size="20" name="count" placeholder = "Показывать по {{ $count }} id">
    </form>
    <hr>
    <table class="table table-striped">
        <thead>
            <tr>
                <th class="ps-0 pe-1" scope="col"><a
                        href="{{ route('admin_users', ['page' => $users->currentPage(), 'count' => $count, 'sorting' => 'id_' . $sort]) }}"> Id</a>
                    <form action="{{ route('admin_users') }}" method="GET">
                        <input type="text" class="form-control p-1" name="id_search" placeholder = "id">
                    </form>
                </th>
                <th class="ps-1 pe-1" scope="col"><a
                        href="{{ route('admin_users', ['page' => $users->currentPage(), 'count' => $count, 'sorting' => 'date_cr_' . $sort]) }}">Дата
                        созд.</a>
                    <form action="{{ route('admin_users') }}" method="GET">
                        <input type="text" class="form-control p-1" name="date_cr_search"
                            placeholder = "д-м-г">
                    </form>
                </th>
                <th class="ps-1 pe-1" scope="col"><a
                        href="{{ route('admin_users', ['page' => $users->currentPage(), 'count' => $count, 'sorting' => 'date_up_' . $sort]) }}">Дата
                        обн.</a>
                    <form action="{{ route('admin_users') }}" method="GET">
                        <input type="text" class="form-control p-1" name="date_up_search"
                            placeholder = "д-м-г">
                    </form>
                </th>
                <th class="ps-1 pe-1" scope="col">Имя
                    <form action="{{ route('admin_users') }}" method="GET">
                        <input type="text" class="form-control p-1" name="name_search" placeholder = "name">
                    </form>

                </th>

                <th scope="col"><a href="{{ route('admin_users', ['page' => $users->currentPage(), 'count' => $count, 'sorting' => 'activ_' . $sort]) }}">ban</a></th>

                <th scope="col">cor</th>



            </tr>
        </thead>

        <tbody>
            @foreach ($users as $user)
                <tr>
                    <th scope="row"><a
                            href="{{ route('admin_posts', ['id_user_search' => $user->id]) }}">{{ $user->id }}</a>
                    </th>
                    <td>{{ date('d-m-Y', strtotime($user->created_at)) }}</td>
                    <td>{{ date('d-m-Y', strtotime($user->updated_at)) }}</td>
                    <td>{{ Str::limit($user->name, 12) }}</td>
                    <td>{{ $user->activ }}</td>

                    <td> <a href="" data-bs-toggle="modal" data-bs-target="#Modal_{{$user->id}}">cor</a> </td>


                </tr>

    <!-- Модальное окно -->
    <div class="modal fade" id="Modal_{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
        
                    <ul>
                        <li>id юзер {{ $user->id }}</li>
                        <li>дата созд. {{ date('d-m-Y', strtotime($user->created_at)) }}</li>
                        <li>дата изм. {{ date('d-m-Y', strtotime($user->created_at)) }}</li>
                        <li>имя станд. {{$user->name}}</li>
                        <li>имя измен. {{$user->user_name}}</li>
                        <li>разрешения {{$user->activ}}</li>
                    </ul>
                    <a href="{{ route('admin_user_update', [$user->id, '1', 'page' => $users->currentPage(), 'count' => $count]) }}" class="btn btn-secondary">бан</a>
                    <a href="{{ route('admin_user_update', [$user->id, '0', 'page' => $users->currentPage(), 'count' => $count]) }}" class="btn btn-secondary" >дебан</a>
                </div>
            </div>
        </div>
    </div>



            @endforeach

        </tbody>
    </table>



    <div> {{ $users->links() }} </div>
@endsection
