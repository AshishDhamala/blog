@extends('admin.layouts.app')

@section('content')
  {!! success_or_failure_message() !!}
  {!! validation_error_message($errors) !!}

  {!! crud_for_every_page('category') !!}

  <form action="{{route('category.store')}}" method="post" id="asdh-create_category">
    {{csrf_field()}}
    <div class="row">
      <div class="col-sm-5 col-sm-offset-2">
      <!-- name -->
        <div class="panel panel-default">
          <div class="panel-heading">
            <label for="category">Create a new category</label>
          </div>
          <div class="panel-body">
            <label for="category">Name</label>
            <input type="text" class="form-control" id="category" name="name" placeholder="Create a new category" value="{{old('name')}}">
          </div>
          <div class="panel-footer">
            <button type="submit" class="btn btn-primary btn-block">Create</button>
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
            @foreach($categories as $category)
              @if(!$category->is_default())
                <li>
                  <a class="btn-block" href="{{route('category.edit', $category->slug)}}" title="Click here to edit this category">{{$category->name()}}</a>
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
    var $createCategory = $('#asdh-create_category');
    $createCategory.validate({
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
    $('#category').focus();
  });
</script>
@endpush