@extends('admin.layouts.app')

@section('content')
  <div id="asdh-index_post">
    {!! success_or_failure_message() !!}
    {!! validation_error_message($errors) !!}
    {!! success_or_failure_message_ajax() !!}

    {!! crud_for_every_page('post') !!}

    <table class="table table-striped table-responsive table-bordered">
      <thead>
      <tr>
        <th>S.N.</th>
        <th>Image</th>
        <th>Title</th>
        <th>Category</th>
        <th>Tags</th>
        <th>Status</th>
        <th>Created at</th>
        <th>Last updated</th>
        <th style="text-align: center;">Other</th>
      </tr>
      </thead>

      <tbody>
      @foreach($posts as $key=>$post)
        <tr id="asdh-{{$post->id}}" data-index="{{$key+1}}">
          <td>{{$key+1}}</td>
          <td>
            <div class="asdh-center_image_inside_me">
              <img src="{{$post->image()}}" alt="post image {{$key+1}}">
            </div>
          </td>
          <td><a href="{{route('post.edit', $post->id)}}" title="Edit">{{$post->title}} ({{$post->view_count}} views)</a></td>
          <td>
            <a href="{{route('category.show', $post->category->id)}}" title="See all the posts in this category">{{$post->category->name()}}</a>
          </td>
          <td>
            @foreach($post->tags as $tag)
              <a href="{{route('tag.show', $tag->id)}}" class="label label-success">{{$tag->name()}}</a>
            @endforeach
          </td>
          <td>{{$post->active()}}</td>
          <td>{{$post->created_at('Y/m/d , H:i')}}<br/>By: {{$post->user->name()}}</td>
          <td>{{$post->updated_at('Y/m/d , H:i')}}</td>
          <td class="asdh-edit_and_delete">
            <a href="{{route('post.edit', $post->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
            <a href="#" class="btn btn-danger asdh-delete_confirmation_dialogue_toggle"><i class="fa fa-trash"></i> Delete</a>

            <form action="{{route('post.destroy', $post->id)}}" method="post" class="asdh-delete_confirmation_dialogue" data-url="{{route('post.destroy', $post->id)}}" data-id="{{$post->id}}">
              {{csrf_field()}}
              {{method_field('DELETE')}}
              <h3>Are you sure?</h3>
              <input type="submit" value="Yes" class="btn btn-danger btn-lg">
              <button class="btn btn-primary btn-lg">No</button>
            </form>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>

  <div class="my-pagination text-center">
    {{ $posts->links() }}
  </div>
@endsection

@push('script')
<script>
  $(document).ready(function () {
    $('#asdh-index_post').children('table').dataTable({
      'info'      : false,
      'paging'    : false,
      'searching' : false,
      'columnDefs': [{
        'orderable': false,
        'targets'  : [1, 4, 8]
      }]
    });
  });
</script>
@endpush