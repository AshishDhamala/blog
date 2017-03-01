@extends('master')

@section('title', '| Posts')

@section('body')
  <div class="container">
    <div class="asdh-public_posts">
      @foreach($posts as $post)
        <article>
          <section class="row">
            <!-- left side -->
            <div class="col-sm-2 left_side">
              <div class="asdh-center_image_inside_me">
                <img src="{{$post->image()}}" alt="{{$post->title}}">
              </div>
            </div>
            <!-- right side -->
            <div class="col-sm-10 right_side">
              <h2><a href="{{route('post.detail', $post->slug)}}">{{$post->title_modified()}}</a></h2>
              <div>
                {!! $post->content !!}
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
                <li><b>Created at:</b> {{$post->created_at()}}</li>
              </ul>
            </div>
          </section>
          <footer>
          </footer>
        </article>
      @endforeach
    </div>
  </div>

  <div class="text-center">
    {{$posts->links()}}
  </div>
@endsection
