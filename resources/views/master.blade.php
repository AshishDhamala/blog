<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title') - {{$company->name()}}</title>

  <!-- SEO starts -->
  @yield('seo')
  <!-- SEO ends -->

  <link rel="stylesheet" href="{{asset("public/css/font-awesome.css")}}">
  <link rel="stylesheet" href="{{asset("public/css/app.css")}}">
  <link rel="stylesheet" href="{{asset("public/css/asdh.css")}}">
  @stack('style')
</head>

<body>

@include('partials.header')

<div class="asdh-common_min_height">
  <div class="container">
    <div class="row">
      <div class="col-sm-8">
        @yield('body')
      </div>
      <!-- Right side bar -->
      <div class="col-sm-4">
        <!-- bootstrap tabs -->
        <ul class="nav nav-tabs recent_popular">
          <li data-toggle="asdh-recent_posts" role="presentation" class="active"><a href="#">Recent</a></li>
          <li data-toggle="asdh-popular_posts" role="presentation"><a href="#">Popular</a></li>
        </ul>
        <div class="nav-contents">
          <!-- recent posts -->
          <div id="asdh-recent_posts">
            @foreach($recent_posts as $post)
              <div class="">
                <h4><a href="{{route('post.detail', $post->slug)}}">{{$post->title()}}</a></h4>
                <div>{!! $post->content_stripped(50) !!}</div>
              </div>
            @endforeach
          </div>
          <!-- popular posts -->
          <div id="asdh-popular_posts" class="">
            @foreach($popular_posts as $post)
              <div class="">
                <h4><a href="{{route('post.detail', $post->slug)}}">{{$post->title()}}</a></h4>
                {{--<p>({{$post->view_count}} views)</p>--}}
                <div>{!! $post->content_stripped(50) !!}</div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@include('partials.footer')

<script src="{{asset("public/js/jquery-3.1.0.js")}}"></script>
<script src="{{asset("public/js/app.js")}}"></script>
<script src="{{asset("public/js/common.js")}}"></script>
<script src="{{asset("public/js/asdh.js")}}"></script>
<script>
  $(document).ready(function () {
    $('li[role="presentation"]').click(function (e) {
      e.preventDefault();
      var id = $(this).attr('data-toggle');
      $(this).addClass('active');
      $(this).siblings().removeClass('active');

      var $element = $('#' + id);
      $element.show();
      $element.siblings().hide();
    });
  });
</script>
@stack('script')
</body>
</html>