@extends('public.knowledge-layout')
@section('title', $videosOnly ? 'Knowledge Centre Videos' : 'Knowledge Centre Articles')
@section('content')
    @include('public.partials.knowledge-posts')
@endsection
