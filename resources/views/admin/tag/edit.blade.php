@extends('admin.layouts.app')

@section('content')
  {!! validation_error_message($errors) !!}

  {{--{!! crud_for_every_page('tag') !!}--}}

  <form action="{{route('tag.update', $tag->id)}}" method="post" enctype="multipart/form-data" id="asdh-edit">
    {{csrf_field()}}
    {{method_field('PUT')}}
    <div class="row">
      <div class="col-sm-7" id="left_side">
        <!-- name -->
        <div class="form-group panel panel-default">
          <div class="panel-heading">
            <label for="name">Title</label>
          </div>
          <div class="panel-body">
            <input type="text" class="form-control" id="name" name="name" value="{{$tag->name}}">
          </div>
          {{--<input type="hidden" id="page_number" name="page_number" value="1">--}}
          <div class="panel-footer">
            <button type="submit" class="btn btn-primary btn-block">Update</button>
          </div>
        </div>
      </div>
      <!-- tag information -->
      <div class="col-sm-4 col-sm-offset-1" id="right_side">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3>Tag information</h3>
          </div>
          <div class="panel-body row">
            <div class="col-xs-5"><label>Name:</label></div>
            <div class="col-xs-7">{{$tag->name()}}</div>
          </div>
          <div class="panel-body row">
            <div class="col-xs-5"><label>Number of posts:</label></div>
            <div class="col-xs-7"><a href="{{route('tag.show', $tag->id)}}" title="Show all the posts with {{$tag->name}} tag">{{count($tag->posts)}}</a></div>
          </div>
          <div class="panel-body row">
            <div class="col-xs-5"><label>Created at:</label></div>
            <div class="col-xs-7">{{$tag->created_at()}}</div>
          </div>
          <div class="panel-body row">
            <div class="col-xs-5"><label>Last updated:</label></div>
            <div class="col-xs-7">{{$tag->updated_at()}}</div>
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
          required: '*Name field is required'
        }
      }
    });
    $('#name').focus();
  });
</script>
@endpush