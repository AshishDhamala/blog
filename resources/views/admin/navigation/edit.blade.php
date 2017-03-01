@extends('admin.layouts.app')

@section('content')
  {!! crud_for_every_page('navigation') !!}

  <form action="{{route('navigation.update',$nav_item->id)}}" method="post" id="asdh-edit">
    {{csrf_field()}}
    {{method_field('PUT')}}
    <div class="row">
      <div class="col-sm-5 col-sm-offset-2">
        {!! validation_error_message($errors) !!}

        <div class="panel panel-default">
          <div class="panel-heading">
            <label>Edit navigation item</label>
          </div>
          <!-- name -->
          <div class="panel-body">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Create a new nav_item" value="{{$nav_item->name}}">
          </div>
          <!-- url -->
          <div class="panel-body">
            <label for="link">Url</label>
            <input type="url" class="form-control" id="link" name="link" placeholder="Enter a url" value="{{$nav_item->link}}">
          </div>
          <!-- admin -->
          @if(current_user_role() == 'core')
            <div class="panel-body">
              <input type="checkbox" id="admin" name="admin" @if($nav_item->admin) checked @endif>
              <label for="admin">admin</label>
            </div>
        @endif
        <!-- submit -->
          <div class="panel-footer">
            <button type="submit" class="btn btn-primary btn-block">Update</button>
          </div>
        </div>
      </div>
      <!-- Edit nav_item -->
      <div class="col-sm-3 col-sm-offset-1">
        <div class="panel panel-default">
          <div class="panel-heading">
            <label>Your current navigation items</label>
          </div>
          <ul class="panel-body asdh-right_side_edit_nav">
            @foreach($nav_items as $nav_item_list)
              @if(current_user_role() != 'core' && $nav_item_list->admin == 1)
                @continue
              @endif
              <li @if($nav_item->id === $nav_item_list->id) class="asdh-active" @endif>
                <a href="{{route('navigation.edit', $nav_item_list->id)}}" title="Click here to edit this navigation item">{{$nav_item_list->name()}}</a>
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
    var $asdhEdit = $('#asdh-edit');
    $asdhEdit.validate({
      rules   : {
        name: {
          required: true
        }
      },
      messages: {
        name: {
          required: 'nav_item name is required'
        }
      }
    });

    var $name = $('#name');
    $name.focus();
  });
</script>
@endpush