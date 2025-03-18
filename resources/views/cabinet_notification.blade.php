@extends('layouts/main')

@section('posts')
    <x-nav-cabinet /> {{-- вставляем навигацию --}}
    <p>Новые уведомления: {{$count_nots}}</p>
    <hr>
    @if (empty($nots))
        <p>Новых уведомлений нет</p>
    @endif
    @foreach ($nots as $not)
        <div class="card my-2">
            <div class="card-body">
                <a class="nav-link text-black p-0" href="{{ url('/post/' . $not['post_id']) }}">
                    <p>{{ $not['type'] }}</p>
                    <hr>
                    <p>{{ Str::limit($not['message'], 200) }}</p>
                </a>
            </div>
        </div>
    @endforeach
@endsection
