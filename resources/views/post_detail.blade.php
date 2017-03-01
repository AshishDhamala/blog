@extends('master')
@section('title',$post->title())
@section('seo')
  {!! $post->seo() !!}
@endsection

@section('body')
  <h1>{{$post->title}}</h1>
  <div>{!! $post->content !!}</div>
@endsection