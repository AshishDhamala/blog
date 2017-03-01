{{--<nav id="asdh-navigation">
  <div class="asdh-top_bar visible-xs">
    <h1><a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a></h1>
    <i class="fa fa-align-justify fa-2x"></i>
  </div>
  <div class="container">
    <ul class="asdh-navigation_items">
      <li class="active">
        <a href="{{route('home')}}"><i class="fa fa-home hidden-sm hidden-xs"></i> Home</a>
      </li>
      <li><a href="{{route('company.create')}}">Company Create</a></li>
      <li><a href="{{route('company.edit',1)}}">Company Edit</a></li>
      <li><a href="#">Item 04</a></li>
      <li><a href="#">Item 05</a></li>
      <li><a href="{{route('admin_home')}}">Admin</a></li>
    </ul>
  </div>
</nav>--}}

<nav class="navbar navbar-default asdh-nav_bar">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand @if(Request::url() == route('home')) pro-nav_bar_active @endif" href="{{route('home')}}"><i class="fa fa-home"></i> Home</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        @foreach($nav_items as $nav_item)
          <li class="@if($nav_item->link == Request::url()) pro-nav_bar_active @endif"><a href="{{$nav_item->link}}">{{$nav_item->name()}}</a></li>
          {{--<li class="pro-nav_bar_active"><a href="{{$nav_item->link}}">{{$nav_item->name()}} {{Request::url()}}</a></li>--}}
        @endforeach
        {{--<li class=""><a href="#">Menu 1</a></li>
        <li class=""><a href="#">Menu 2</a></li>
        <li class=""><a href="#">Menu 3</a></li>
        <li class=""><a href="#">Menu 4</a></li>
        <li class=""><a href="#">Menu 5</a></li>
        <li class=""><a href="#">Menu 6</a></li>--}}
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Menu drop down
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="#">menu 1</a></li>
            <li><a href="#">menu 2</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="{{route('admin_home')}}" target="_blank">Admin</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>