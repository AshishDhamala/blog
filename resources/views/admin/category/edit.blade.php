@extends('admin.layouts.app')

@section('content')
  {!! crud_for_every_page('category') !!}

  <form action="{{route('category.update',$category->id)}}" method="post" id="asdh-edit">
    {{csrf_field()}}
    {{method_field('PUT')}}
    <div class="row">
      <div class="col-sm-5 col-sm-offset-2">
      {!! validation_error_message($errors) !!}

      <!-- name -->
        <div class="panel panel-default">
          <div class="panel-heading">
            <label>Edit category</label>
          </div>
          <div class="panel-body">
            <label for="category">Name</label>
            <input type="text" class="form-control" id="category" name="name" placeholder="Create a new category" value="{{$category->name}}" @if($category->is_default()) disabled @endif>
            @if($category->is_default())
              <small><label for="ashish dhamala">Sorry, <b>{{$category->name()}}</b> category cannot be edited.</label>
              </small>
            @endif
          </div>
          <div class="panel-footer">
            <button type="submit" class="btn btn-primary btn-block" @if($category->is_default()) disabled @endif>Update</button>
          </div>
        </div>
      </div>
      <!-- Edit category -->
      <div class="col-sm-3 col-sm-offset-1">
        <div class="panel panel-default">
          <div class="panel-heading">
            <label>Your Categories</label>
          </div>
          <ul class="panel-body asdh-right_side_edit_nav">
            @foreach($categories as $category_list)
              @if(!$category_list->is_default())
                <li @if($category->id === $category_list->id) class="asdh-active" @endif>
                  <a href="{{route('category.edit', $category_list->id)}}" title="Click here to edit this category">{{$category_list->name()}}</a>
                </li>
              @endif
            @endforeach
          </ul>
          <div class="panel-footer">
            <small id="fileHelp" class="form-text text-muted">Click on the category to edit it</small>
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
          required: 'Category name is required'
        }
      }
    });
  });
</script>
@endpush