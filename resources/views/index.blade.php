@extends('master')

@section('title', 'Home')

@section('seo')
  {!! $company->seo() !!}
@endsection

@section('body')
  {!! success_or_failure_message() !!}
  <div class="">
    @foreach($posts as $post)
      <div class="asdh-public_posts">
        <section class="row">
          <!-- left side -->
          <div class="col-sm-3 left_side">
            <div class="asdh-center_image_inside_me">
              <img src="{{$post->image()}}" alt="{{$post->title}}">
            </div>
          </div>
          <!-- right side -->
          <div class="col-sm-9 right_side">
            <h2><a href="{{route('post.detail', $post->slug)}}">{{$post->title_modified()}}</a></h2>
            <div class="asdh-content">
              {!! $post->content_stripped(100) !!}
            </div>
            <div class="tags">
              <b>Tags: </b>
              @foreach($post->tags as $tag)
                <a href="{{route('tag.detail',$tag->slug)}}" class="label label-success">{{$tag->name}}</a>
              @endforeach
            </div>
            <ul class="">
              <li><b>Category:</b>
                <a href="{{route('category.detail', $post->category->slug)}}">{{$post->category->name()}}</a></li>
              {{--<li><b>Created at:</b> {{$post->created_at()}}</li>--}}
            </ul>
          </div>
        </section>
      </div>
    @endforeach
  </div>
@endsection
