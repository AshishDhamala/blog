@extends('admin.layouts.app')

@section('content')
  <div id="asdh-index_tag">
    {!! success_or_failure_message() !!}
    {!! validation_error_message($errors) !!}
    {!! success_or_failure_message_ajax() !!}

    {{--{!! crud_for_every_page('tag') !!}--}}

    <table class="table table-striped table-responsive table-bordered">
      <thead>
      <tr>
        <th>S.N.</th>
        <th>Name</th>
        <th>Created at</th>
        <th>Last updated</th>
        <th style="text-align: center;">Other</th>
      </tr>
      </thead>

      <tbody>
      @foreach($tags as $key=>$tag)
        <tr id="asdh-{{$tag->id}}" data-index="{{$key+1}}">
          <td>{{$key+1}}</td>
          <td>{{$tag->name}}</td>
          <td>{{$tag->created_at('Y/m/d , H:i')}}</td>
          <td>{{$tag->updated_at('Y/m/d , H:i')}}</td>
          <td class="asdh-edit_and_delete">
            <a href="{{route('tag.edit', $tag->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
            <a href="#" class="btn btn-danger asdh-delete_confirmation_dialogue_toggle"><i class="fa fa-trash"></i> Delete</a>

            <form action="{{route('tag.destroy', $tag->id)}}" method="post" class="asdh-delete_confirmation_dialogue" data-url="{{route('tag.destroy', $tag->id)}}" data-id="{{$tag->id}}">
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
    {{ $tags->links() }}
  </div>
@endsection

@push('script')
<script>
  $(document).ready(function () {
    $('#asdh-index_tag').children('table').dataTable({
      'info'      : false,
      'paging'    : false,
      'searching' : false,
      'columnDefs': [{
        'orderable': false,
        'targets'  : [4]
      }]
    });
  });
</script>
@endpush