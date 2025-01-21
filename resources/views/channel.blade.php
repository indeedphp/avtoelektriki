@extends('layouts/main') 

@section('comments')  



<x-posts :posts="$posts"/>

<x-hidden-comment />
<x-hidden-reply />

 @endsection 