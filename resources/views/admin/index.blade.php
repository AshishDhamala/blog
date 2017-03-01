@extends('admin.layouts.app')

@push('css')
<link href="https://fonts.googleapis.com/css?family=Acme" rel="stylesheet">
@endpush

@section('title', '- '. $company->name)

@section('content')
  {!! success_or_failure_message() !!}
  <div class="asdh-admin_index">
    <div class="row">
      <div class="col-md-8">
        <div class="row">
          <!-- Dashboard -->
          <div class="col-md-12">
            <div class="panel panel-default dashboard">
              <div class="panel-heading">Dashboard</div>
              <div class="panel-body">
                <p>You are logged in! {{Auth::user()->name()}}</p>
                <p><b>User type: </b>{{current_user_role()}}</p>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- Categories -->
          <div class="col-md-6">
            <div class="panel panel-default categories">
              <div class="panel-heading">Categories (Total: {{\App\Category::count()}})</div>
              <ul class="panel-body">
                @foreach($categories as $category)
                  <li><a href="{{route('category.edit', $category->id)}}" title="Edit">{{$category->name()}}</a></li>
                @endforeach
              </ul>
              <ul class="panel-footer">
                <li><a href="{{route('category.index')}}">See all</a></li>
              </ul>
            </div>
          </div>
          <!-- Navigations -->
          <div class="col-md-6">
            <div class="panel panel-default navigations">
              @if(current_user_role() == 'core')
                <div class="panel-heading">Navigations (Total: {{\App\Navigation::count()}})</div>
              @else
                <div class="panel-heading">Navigations (Total: {{\App\Navigation::where('admin',0)->count()}})</div>
              @endif
              <ul class="panel-body">
                @if(current_user_role() == 'core')
                  @foreach($navigations as $navigation)
                    <li><a href="{{route('navigation.edit', $navigation->id)}}" title="Edit">{{$navigation->name()}}</a>
                    </li>
                  @endforeach
                @else
                  @foreach($public_navigations as $navigation)
                    <li><a href="{{route('navigation.edit', $navigation->id)}}" title="Edit">{{$navigation->name()}}</a>
                    </li>
                  @endforeach
                @endif
              </ul>
              <ul class="panel-footer">
                <li><a href="{{route('navigation.index')}}">See all</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- Posts -->
          <div class="col-md-12">
            <div class="panel panel-default posts">
              <div class="panel-heading">Posts (Total: {{\App\Post::count()}})</div>
              <ul class="panel-body">
                @foreach($posts as $post)
                  <li><a href="{{route('post.edit', $post->id)}}" title="Edit">{{$post->title()}}</a></li>
                @endforeach
              </ul>
              <ul class="panel-footer">
                <li><a href="{{route('post.index')}}">See all</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <!-- your contribution -->
        <div class="panel panel-default contribution">
          <div class="panel-heading">Your Contribution</div>
          <ul class="panel-body">
            <li id="contribution_time"></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('script')
<script>
  var $asdhAdminIndex = $('.asdh-admin_index');
  var $panel          = $asdhAdminIndex.find('.panel');
  var $panelHeading   = $panel.children('.panel-heading');
  //  makeUpperHalfGlossy($panelHeading);
  $panelHeading.makeUpperHalfGlossy({
    'top'  : '2px',
    'left' : '2px',
    'right': '2px'
  });

  $(document).ready(function () {
    var time = @php echo Auth::user()->contribution_time() @endphp ;
    setInterval(function () {
      seconds_to_time(time);
      time++;
    }, 1000);

  });
</script>
@endpush
