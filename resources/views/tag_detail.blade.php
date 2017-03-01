@extends('master')

@section('title', $tag->name() . ' Tag')

@section('seo')
  {!! $tag->seo() !!}
@endsection

@section('body')
  <div>
    @foreach($tag->posts as $post)
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
            <div>
              {!! $post->content_stripped() !!}
            </div>
            <div class="tags">
              <b>Tags: </b>
              @foreach($post->tags as $tagg)
                <a href="{{route('tag.detail',$tagg->slug)}}" class="label @if($tagg->name == $tag->name) label-primary @else label-success @endif">{{$tagg->name}}</a>
              @endforeach
            </div>
            <ul class="">
              <li><b>Category:</b>
                <a href="{{route('category.detail', $post->category->slug)}}">{{$post->category->name()}}</a></li>
              <li><b>Created at:</b> {{$post->created_at()}}</li>
            </ul>
          </div>
        </section>
        <footer>
        </footer>
      </div>
    @endforeach
  </div>
@endsection
