<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  {{--<title>Admin - {{isset($company) ? $company->name : ""}} @yield('title')</title>--}}
  <title>Admin @yield('title')</title>

  <!-- Styles -->
  <link href="{{asset("public/css/app.css")}}" rel="stylesheet">
  <link href="{{asset("public/css/jquery-ui.css")}}" rel="stylesheet">
  <link href="{{asset("public/css/font-awesome.css")}}" rel="stylesheet">
  <link href="{{asset("public/plugins/tokenfield/css/tokenfield-typeahead.css")}}" rel="stylesheet">
  <link href="{{asset("public/plugins/tokenfield/css/bootstrap-tokenfield.css")}}" rel="stylesheet">
  <link href="{{asset("public/plugins/data-table/css/jquery.dataTables.css")}}" rel="stylesheet">
  <link href="{{asset("public/plugins/data-table/css/dataTables.bootstrap4.css")}}" rel="stylesheet">
  <link href="{{asset("public/plugins/select2/css/select2.css")}}" rel="stylesheet">
  <link href="{{asset("public/plugins/bootstrap-fileinput/css/fileinput.css")}}" rel="stylesheet">
  <link href="{{asset("public/css/asdh_admin.css")}}" rel="stylesheet">
  @stack('css')

<!-- Scripts -->
  <script>
    window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
  </script>
  {{--<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>--}}

</head>
<body>
<div id="app">

  <nav class="navbar navbar-default navbar-static-top">
    <div class="container">
      <div class="navbar-header @if(Request::is('admin')) asdh-active_nav_admin @endif">

        <!-- Collapsed Hamburger -->
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
          <span class="sr-only">Toggle Navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>

        <!-- Branding Image -->
        <a class="navbar-brand" href="{{ route('admin_home') }}">
        <!-- {{ config('app.name', 'Laravel') }} -->
          <i class="fa fa-home"></i> Home
        </a>
      </div>

      <div class="collapse navbar-collapse" id="app-navbar-collapse">
        <!-- Left Side Of Navbar -->
        <ul class="nav navbar-nav">
        @if (!Auth::guest())
          <!--
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Category<span class="caret"></span>
              </a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="{{ route('category.index') }}">Show all</a></li>
                <li><a href="{{ route('category.create') }}">Create</a></li>
              </ul>
            </li>
            -->
            @if(count($admin_nav_items))
              @foreach($admin_nav_items as $admin_nav_item)
                @if((current_user_role() != 'core' && current_user_role() != 'main') && ($admin_nav_item->name == 'user' || $admin_nav_item->name == 'company'))
                  @continue
                @endif
{{--                <li @if($admin_nav_item->name == get_route_name_at_index(1)) class="asdh-active_nav_admin" @endif>--}}
                <li @if($admin_nav_item->link == Request::url()) class="asdh-active_nav_admin" @endif>
                  <a href="{{$admin_nav_item->link}}">{{$admin_nav_item->name()}}</a>
                </li>
              @endforeach
            @endif
          @endif
        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="nav navbar-nav navbar-right">
          <!-- Authentication Links -->
          @if (Auth::guest())
            <li><a href="{{ url('/login') }}">Login</a></li>
            {{--<li><a href="{{ url('/register') }}">Register</a></li>--}}
            <li><a href="{{ route('home') }}" target="_blank">Client section</a></li>
          @else
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                {{ Auth::user()->name() }} <b>({{ucfirst(current_user_role())}})</b> <span class="caret"></span>
              </a>

              <ul class="dropdown-menu" role="menu">
                <!-- client section -->
                <li><a href="{{ route('home') }}">Client section</a></li>
                <!-- change password -->
                <li><a href="{{ route('change_password') }}">Change password</a></li>
                <!-- logout -->
                <li>
                  <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                  </a>

                  <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                  </form>
                </li>
              </ul>
            </li>
          @endif
        </ul>
      </div>
    </div>
  </nav>

  <div class="container asdh-common_min_height">
    @yield('content')
  </div>

</div>

<!-- Scripts -->
<script src="{{asset("public/js/app.js")}}"></script>
<script src="{{asset("public/js/jquery-ui.js")}}"></script>
<script src="{{asset('public/js/plugins/tinymce/tinymce.min.js')}}"></script>
<script src="{{asset('public/plugins/tokenfield/js/bootstrap-tokenfield.js')}}"></script>
<script src="{{asset('public/plugins/formvalidation/dist/jquery.validate.js')}}"></script>
<script src="{{asset('public/plugins/formvalidation/dist/additional-methods.js')}}"></script>
<script src="{{asset('public/plugins/data-table/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('public/plugins/data-table/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('public/plugins/select2/js/select2.full.js')}}"></script>
<script src="{{asset('public/plugins/bootstrap-fileinput/js/fileinput.js')}}"></script>
<script src="{{asset("public/js/common.js")}}"></script>
<script src="{{asset("public/js/asdh_admin.js")}}"></script>
<script>
  tinymce.init({selector: 'textarea'});
  {{--@if(session('success_message'))
    add_black_background();
  @endif--}}
</script>
@stack('script')
</body>
</html>
