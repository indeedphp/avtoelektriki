@extends('layouts/main') 

@section('posts')  



<x-posts :posts="$posts"/>

@section('hidden') 
<x-hidden-comment />
<x-hidden-reply />
@endsection 

 @endsection 