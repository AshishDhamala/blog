@extends('admin.layouts.app')

@section('title', '- Users')

@section('content')
  <div id="asdh-index_user">
    {!! success_or_failure_message() !!}
    {!! validation_error_message($errors) !!}
    {!! success_or_failure_message_ajax() !!}

    <form action="{{route('user.delete')}}" method="post">
      {!! crud_for_every_page('user') !!}
      {{csrf_field()}}
      {{method_field('DELETE')}}
      {{--<input type="submit" value="Delete Multiple" class="btn btn-danger">--}}
      <table class="table table-striped table-responsive table-bordered">
        <thead>
        <tr>
          <th></th>
          <th>S.N.</th>
          <th>Name</th>
          <th>Role</th>
          <th>Created at</th>
          <th>Last updated</th>
          <th style="text-align: center;">Others</th>
        </tr>
        </thead>
        <tbody>
        @php $count = 1 @endphp
        @foreach($users as $user)
          @if(current_user_role() != 'core' && $user->role->name == 'core')
            @continue
          @endif
          <tr id="asdh-{{$user->id}}">
            <td style="text-align: center;">
              <div class="form-group">
                <input type="checkbox" name="deleteMultiple[]" value="{{$user->id}}" style="width: 15px; height: 15px; cursor: pointer;">
              </div>
            </td>
            <td>{{$count}}</td>
            <td>{{$user->name()}}</td>
            <td>{{$user->role->name()}}</td>
            <td>{{$user->created_at('Y/m/d , H:i')}}</td>
            <td>{{$user->updated_at('Y/m/d , H:i')}}</td>
            <td class="asdh-edit_and_delete">
              <a href="{{route('user.edit', $user->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
              <a href="#" class="btn btn-danger asdh-delete_confirmation_dialogue_toggle"><i class="fa fa-trash"></i> Delete</a>
              <div class="asdh-delete_confirmation_dialogue">
                <h3>Are you sure?</h3>
                <p style="padding: 0 20px; color: gray;">All the posts of this user will be assigned to "<b>Default</b>" user.</p>
                <button type="submit" value="{{$user->id}}" name="delete" class="btn btn-danger btn-lg">Delete</button>
                <a href="#" class="btn btn-primary btn-lg">No</a>
              </div>
            </td>
          </tr>
          @php $count++ @endphp
        @endforeach
        </tbody>
      </table>
    </form>
  </div>

  <div class="my-pagination text-center">
    {{ $users->links() }}
  </div>
@endsection

@push('script')
<script>
  $(document).ready(function () {
    $('#asdh-index_user').find('table').dataTable({
      'info'      : false,
      'paging'    : false,
      'searching' : false,
      'columnDefs': [{
        'orderable': false,
        'targets'  : [0,6]
      }]
    });
  });
</script>
@endpush