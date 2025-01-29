@extends('layouts/main') 

@section('posts')  

<div id="posts">

</div>

@endsection 

@section('hidden') 
<x-hidden-post />
<x-hidden-comment />
<x-hidden-reply />
<div id="page_url" hidden>/api_post/{{$id}}</div>
@endsection 
