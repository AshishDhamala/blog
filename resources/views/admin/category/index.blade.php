@extends('admin.layouts.app')

@section('content')
  <div id="asdh-index_category">
    {!! success_or_failure_message() !!}
    {!! validation_error_message($errors) !!}
    {!! success_or_failure_message_ajax() !!}

    {!! crud_for_every_page('category') !!}

    <table class="table table-striped table-responsive table-bordered">
      <thead>
      <tr>
        <th>S.N.</th>
        <th>Name</th>
        <th>Created at</th>
        <th>Last updated</th>
        <th style="text-align: center;">Others</th>
      </tr>
      </thead>
      <tbody>
      @foreach($categories as $key=>$category)
        <tr id="asdh-{{$category->id}}">
          <td>{{$key+1}}</td>
          <td>
            @if($category->has_posts())
              <a href="{{route('category.show', $category->id)}}" title="Show posts in this category">{{$category->name()}}</a>
              @else
              <span title="It has no posts to show">{{$category->name()}}</span>
            @endif
          </td>
          <td>{{$category->created_at('Y/m/d , H:i')}}</td>
          <td>{{$category->updated_at('Y/m/d , H:i')}}</td>
          <td class="asdh-edit_and_delete">
            <a href="{{route('category.edit', $category->id)}}" class="btn btn-primary" @if($category->is_default()) disabled title="{{$category->name()}} category cannot be edited." @endif><i class="fa fa-edit"></i> Edit</a>
            <a href="#" class="btn btn-danger asdh-delete_confirmation_dialogue_toggle" @if($category->is_default()) disabled title="{{$category->name()}} category cannot be deleted." @endif><i class="fa fa-trash"></i> Delete</a>

            <form action="{{route('category.destroy', $category->id)}}" method="post" class="asdh-delete_confirmation_dialogue" data-url="{{route('category.destroy', $category->id)}}" data-id="{{$category->id}}">
              {{csrf_field()}}
              {{method_field('DELETE')}}
              <h3>Are you sure?</h3>
              <p style="padding: 0 20px; color: gray;">All the posts of this category will be assigned to "<b>Default</b>" category.</p>
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
    {{ $categories->links() }}
  </div>
@endsection

@push('script')
<script>
  $(document).ready(function () {
    $('#asdh-index_category').children('table').dataTable({
      'info': false,
      'paging': false,
      'searching': false,
      'columnDefs': [{
        'orderable': false,
        'targets'  : [4]
      }]
    });
  });
</script>
@endpush