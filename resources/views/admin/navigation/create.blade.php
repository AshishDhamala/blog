@extends('admin.layouts.app')

@section('content')
  {!! success_or_failure_message() !!}
  {!! validation_error_message($errors) !!}

  {!! crud_for_every_page('navigation') !!}

  <form action="{{route('navigation.store')}}" method="post" id="asdh-create_navigation">
    {{csrf_field()}}
    <div class="row">
      <div class="col-sm-8">
        <div class="panel panel-default">
          <div class="panel-heading">
            <label for="category">Create a new navigation item</label>
          </div>
          <!-- name -->
          <div class="panel-body">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter new name" value="{{old('name')}}">
          </div>
          <!-- url -->
          <div class="panel-body">
            <label for="link">Url</label>
            <input type="url" class="form-control" id="link" name="link" placeholder="Enter a url" value="{{old('link')}}">
          </div>
          <!-- admin -->
          @if(current_user_role() == 'core')
            <div class="panel-body">
              <input type="checkbox" id="admin" name="admin">
              <label for="admin">admin</label>
            </div>
          @endif
          <div class="panel-footer">
            <button type="submit" class="btn btn-primary btn-block">Create</button>
          </div>
        </div>
      </div>
      <!-- Edit navigation -->
      <div class="col-sm-3 col-sm-offset-1">
        <div class="panel panel-default">
          <div class="panel-heading">
            <label>Your present navigation items</label>
          </div>
          <ul class="panel-body asdh-right_side_edit_nav">
            @foreach($all_nav_items as $nav_item)
              @if(current_user_role() != 'core' && $nav_item->admin == 1)
                @continue
              @endif
              <li>
                <a class="btn-block" href="{{route('navigation.edit', $nav_item->id)}}" title="Click here to edit this navigation item">{{$nav_item->name()}}
                  <span class="label label-primary">{{$nav_item->admin()}}</span></a>
              </li>
            @endforeach
          </ul>
          <div class="panel-footer">
            <small id="fileHelp" class="form-text text-muted">Click on the navigation item to edit it</small>
          </div>
        </div>
      </div>
    </div>
  </form>
@endsection

@push('script')
<script>
  $(document).ready(function () {
    var $createNavigation = $('#asdh-create_navigation');
    $createNavigation.validate({
      rules   : {
        name: {
          required: true
        },
        link: 'required'
      },
      messages: {
        name: {
          required: 'Navigation item name is required'
        },
        link: {
          required: 'Url field is required'
        }
      }
    });

    var $name = $('#name');
    $name.focus();
  });
</script>
@endpush