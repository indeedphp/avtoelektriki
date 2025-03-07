@extends('layouts/admin')



@section('posts')
<x-nav-admin/>


    {{-- {{ route('cabinet_statistic') }} --}}

    {{-- created_at --}}
    <hr>
    <form action="{{ route('admin_comments') }}" method="GET">
        <input type="text" size="20" name="count" placeholder = "Показывать по {{ $count }} id">
    </form>
    <hr>
    <table class="table table-striped">
        <thead>
            <tr>
                <th class="ps-0 pe-1" scope="col"><a
                        href="{{ route('admin_comments', ['page' => $comments->currentPage(), 'count' => $count, 'sorting' => 'id_' . $sort]) }}">
                        Id</a>
                    <form action="{{ route('admin_comments') }}" method="GET">
                        <input type="text" class="form-control p-1" name="id_search" placeholder = "id">
                    </form>
                </th>
                <th class="ps-0 pe-1" scope="col"><a
                        href="{{ route('admin_comments', ['page' => $comments->currentPage(), 'count' => $count, 'sorting' => 'user_id_' . $sort]) }}">user
                        id</a>
                    <form action="{{ route('admin_comments') }}" method="GET">
                        <input type="text" class="form-control p-1" name="user_id_search" placeholder = "id">
                    </form>
                </th>
                <th class="ps-0 pe-1" scope="col"><a
                        href="{{ route('admin_comments', ['page' => $comments->currentPage(), 'count' => $count, 'sorting' => 'post_id_' . $sort]) }}">post
                        id</a>
                    <form action="{{ route('admin_comments') }}" method="GET">
                        <input type="text" class="form-control p-1" name="post_id_search" placeholder = "id">
                    </form>
                </th>
                <th class="ps-1 pe-1" scope="col"><a
                        href="{{ route('admin_comments', ['page' => $comments->currentPage(), 'count' => $count, 'sorting' => 'date_cr_' . $sort]) }}">Дата
                        созд.</a>
                    <form action="{{ route('admin_comments') }}" method="GET">
                        <input type="text" class="form-control p-1" name="date_cr_search" placeholder = "д-м-г">
                    </form>
                </th>
                <th class="ps-1 pe-1" scope="col"><a
                        href="{{ route('admin_comments', ['page' => $comments->currentPage(), 'count' => $count, 'sorting' => 'date_up_' . $sort]) }}">Дата
                        обн.</a>
                    <form action="{{ route('admin_comments') }}" method="GET">
                        <input type="text" class="form-control p-1" name="date_up_search" placeholder = "д-м-г">
                    </form>
                </th>
                <th class="ps-1 pe-1" scope="col">Имя
                    <form action="{{ route('admin_comments') }}" method="GET">
                        <input type="text" class="form-control p-1" name="name_search" placeholder = "name">
                    </form>

                </th>
                <th scope="col">текст</th>
                <th scope="col"><a href="{{ route('admin_comments', ['page' => $comments->currentPage(), 'count' => $count, 'sorting' => 'activ_' . $sort]) }}">cor</a>
                </th>





            </tr>
        </thead>

        <tbody>
            @foreach ($comments as $comment)
                <tr>
                    <th scope="row">{{ $comment->id }}</th>
                    <th scope="row"><a
                            href="{{ route('admin_users', ['id_search' => $comment->user_id]) }}">{{ $comment->user_id }}</a>
                    </th>
                    <th scope="row"><a
                            href="{{ route('admin_posts', ['id_search' => $comment->post_id]) }}">{{ $comment->post_id }}</a>
                    </th>
                    <td>{{ date('d-m-Y', strtotime($comment->created_at)) }}</td>
                    <td>{{ date('d-m-Y', strtotime($comment->updated_at)) }}</td>
                    <td>{{ Str::limit($comment->user_name, 12) }}</td>
                    <td>{{ Str::limit($comment->comment, 12) }}</td>
                    <td>{{ $comment->activ }}</td>
                    <td> <a href="" data-bs-toggle="modal" data-bs-target="#Modal_{{ $comment->id }}">cor</a>
                    </td>

                </tr>


                <!-- Модальное окно -->
                <div class="modal fade" id="Modal_{{ $comment->id }}" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">

                                <ul>
                                    <li>id пост {{ $comment->id }}</li>
                                    <li>дата созд. {{ date('d-m-Y', strtotime($comment->created_at)) }}</li>
                                    <li>дата изм. {{ date('d-m-Y', strtotime($comment->created_at)) }}</li>
                                    <li>id юзера {{ $comment->id_user }}</li>
                                    <li>имя юзера {{ $comment->user_name }}</li>
                                    <li>комментарий {{ $comment->comment }}</li>
                                    <li>разрешения {{ $comment->activ }}</li>
                                </ul>
                                <a href="{{ route('admin_comment_update', [$comment->id, '1', 'page' => $comments->currentPage(), 'count' => $count]) }}"
                                    class="btn btn-secondary">бан</a>
                                <a href="{{ route('admin_comment_update', [$comment->id, '0', 'page' => $comments->currentPage(), 'count' => $count]) }}"
                                    class="btn btn-secondary">дебан</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </tbody>
    </table>









    <div> {{ $comments->links() }} </div>
@endsection
