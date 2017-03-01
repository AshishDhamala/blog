@extends('admin.layouts.app')

@section('title', '- Navigation')

@section('content')
  <div id="asdh-index_navigation">
    {!! success_or_failure_message() !!}
    {!! validation_error_message($errors) !!}
    {!! success_or_failure_message_ajax() !!}

    <form action="{{route('navigation.delete')}}" method="post">
      {!! crud_for_every_page('navigation') !!}
      {{csrf_field()}}
      {{method_field('DELETE')}}
      <table class="table table-striped table-responsive table-bordered">
        <thead>
        <tr>
          <th></th>
          <th>S.N.</th>
          <th>Name</th>
          <th>Shown on</th>
          <th>Created at</th>
          <th>Last updated</th>
          <th style="text-align: center;">Others</th>
        </tr>
        </thead>
        <tbody>
        @foreach($nav_items as $key=>$nav_item)
          @if(current_user_role() != 'core' && $nav_item->admin == 1)
            @continue
          @endif
          <tr id="asdh-{{$nav_item->id}}">
            <td style="text-align: center;">
              <div class="form-group">
                <input type="checkbox" name="deleteMultiple[]" value="{{$nav_item->id}}" style="width: 15px; height: 15px; cursor: pointer;">
              </div>
            </td>
            <td>{{$key+1}}</td>
            <td>{{$nav_item->name()}}</td>
            <td>{{$nav_item->shown_on()}}</td>
            <td>{{$nav_item->created_at('Y/m/d , H:i')}}</td>
            <td>{{$nav_item->updated_at('Y/m/d , H:i')}}</td>
            <td class="asdh-edit_and_delete">
              <a href="{{route('navigation.edit', $nav_item->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
              <a href="#" class="btn btn-danger asdh-delete_confirmation_dialogue_toggle"><i class="fa fa-trash"></i> Delete</a>

              <div class="asdh-delete_confirmation_dialogue">
                <h3>Are you sure?</h3>
                <button type="submit" value="{{$nav_item->id}}" name="delete" class="btn btn-danger btn-lg">Delete</button>
                <a href="#" class="btn btn-primary btn-lg">No</a>
              </div>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </form>
  </div>

  <div class="my-pagination text-center">
    {{ $nav_items->links() }}
  </div>
@endsection

@push('script')
<script>
  $(document).ready(function () {
    $('#asdh-index_navigation').find('table').dataTable({
      'info'      : false,
      'paging'    : false,
      'searching' : false,
      'columnDefs': [{
        'orderable': false,
        'targets'  : [0, 6]
      }]
    });
  });
</script>
@endpush