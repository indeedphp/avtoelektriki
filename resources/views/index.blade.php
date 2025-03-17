@extends('layouts/main') 

@section('posts')  

<div id="posts">

</div>





@endsection 

@section('hidden') 
<x-hidden-post />
<x-hidden-comment />
<x-hidden-reply />
<div id="page_url" hidden>/api_index</div>
@endsection 

@section('js') 
<script defer src="{{ url('client2.js') }}"></script>
<script defer src="{{ url('client.js') }}"></script>
@endsection  