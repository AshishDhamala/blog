@extends('admin.layouts.app')

@section('content')
  {!! validation_error_message($errors) !!}

  {!! crud_for_every_page('post') !!}

  <form action="{{route('post.update', $post->id)}}" method="post" enctype="multipart/form-data" id="asdh-edit">
    {{csrf_field()}}
    {{method_field('PUT')}}
    <div class="row">
      <div class="col-sm-8" id="left_side">
        <div>
          <!-- title -->
          <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{$post->title}}">
          </div>
          <!-- slug -->
          <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" class="form-control" id="slug" name="slug" value="{{$post->slug}}">
          </div>
          <!-- image -->
          <div class="form-group">
            <label for="image" class="control-label">Insert media</label>
            <div class="asdh-center_image_inside_me asdh-previous_post_image_container">
              <img src="{{$post->image()}}" alt="previous post image">
            </div>
            <span class="previous_post_image_label">Previous image</span>
            <input type="file" accept="image/*" class="form-control-file file-loading" id="image" aria-describedby="fileHelp" name="image">
            <small id="fileHelp" class="form-text text-muted">Upload an image file with size less than 5MB</small>
          </div>
          <!-- content -->
          <div class="form-group">
            <label for="content">Content</label>
            <textarea class="form-control" id="content" rows="3" name="content">{{$post->content}}</textarea>
          </div>
        </div>
      </div>
      <div class="col-sm-3 col-sm-offset-1" id="right_side">
        <!-- categories -->
        <div class="panel panel-default">
          <div class="panel-heading">
            <label for="category">Categories</label>
          </div>
          <div class="panel-body">
            <select class="form-control" id="category" name="category">
              @foreach($categories as $category)
                <option @if($post->category==$category) selected @endif value="{{$category->id}}">{{$category->name()}}</option>
              @endforeach
            </select>
            <small id="fileHelp" class="form-text text-muted">Choose a category</small>
          </div>
        </div>
        <!-- tags -->
        <div class="panel panel-default">
          <div class="panel-heading">
            <label for="tag">Tags</label>
          </div>
          <div class="panel-body">
            <input type="text" class="form-control tokenfield" id="tag" name="tag" placeholder="Enter tags here..." value="@foreach($post->tags as $tag) {{$tag->name}}, @endforeach">
          </div>
          <div class="panel-footer">
            <small id="fileHelp" class="form-text text-muted">Separate tags by using comma</small>
          </div>
        </div>
        <!-- status/active -->
        <div class="panel panel-default">
          <div class="panel-heading">
            <label for="active">Status</label>
          </div>
          <div class="panel-body">
            <input type="checkbox" id="active" name="active" @if($post->active) checked @endif>
            <label for="active">active</label>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
    </div>
  </form>
@endsection

@push('script')
<script>
  $(document).ready(function () {
    $('.tokenfield').tokenfield({
      autocomplete           : {
        source: @php echo json_encode($tag_names) @endphp,
        delay : 100
      },
      showAutocompleteOnFocus: true,
      limit                  : 10,
      createTokensOnBlur     : true
    });

    var $asdhEdit = $('#asdh-edit');
    $asdhEdit.validate({
      rules   : {
        title   : {
          required: true
        },
        slug    : 'required',
        content : 'required',
        category: 'required'
      },
      messages: {
        title: {
          required: '*Title field is required'
        },
        slug : {
          required: '*Slug field is required'
        }
      }
    });

    var $title = $('#title');
    var $slug  = $('#slug');

    $title.focus();

    $title.keyup(function () {
      var title      = $(this).val();
      var smallTitle = title.toLowerCase();
      // all the fields from a to z , A to Z and 0 to 9 is kept and every other is replaced with empty string,
      // also spaces will be transformed into dashes
      $slug.val(smallTitle.replace(/[^a-zA-z0-9 ]/gi, '').replace(/ /gi, '-'));
    });

    $("#image").fileinput({
      previewFileType: "image",
      browseIcon: "<i class=\"glyphicon glyphicon-picture\"></i> ",
      showUpload: false,
      maxFileSize: 1024*5
    });

  });
</script>
@endpush