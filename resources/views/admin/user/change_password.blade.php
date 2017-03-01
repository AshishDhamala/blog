@extends('admin.layouts.app')

@section('title', ' | Change password')

@section('content')
  {!! success_or_failure_message() !!}
  {!! validation_error_message($errors) !!}
  <div class="row">
    <div class="col-sm-6 col-sm-offset-3">
      <form action="{{route('change_password')}}" method="post" id="asdh-change_password">
        {{csrf_field()}}
        {{method_field('PUT')}}
        <div class="panel panel-default">
          <div class="panel-heading">Change Password</div>
          <div class="panel-body">
            <div class="form-group">
              <label for="old_password">Old password</label>
              <input type="password" name="old_password" class="form-control" id="old_password">
            </div>
            <div class="form-group">
              <label for="new_password">New password</label>
              <input type="password" name="new_password" class="form-control" id="new_password">
            </div>
            <div class="form-group">
              <label for="new_password_confirmation">Confirm new password</label>
              <input type="password" name="new_password_confirmation" class="form-control" id="new_password_confirmation">
            </div>
          </div>
          <div class="panel-footer">
            <input type="submit" class="btn btn-primary btn-block">
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection

@push('script')
<script>
  $(document).ready(function () {
    var $changePassword = $('#asdh-change_password');
    $changePassword.validate({
      rules   : {
        old_password             : {
          required : true,
          minlength: 6
        },
        new_password             : {
          required : true,
          minlength: 6
        },
        new_password_confirmation: {
          required : true,
          minlength: 6
        }
      },
      messages: {
        old_password             : {
          required : '*Old password is required',
          minlength: '*Password must be of minimum six characters long'
        },
        new_password             : {
          required : '*New password is required',
          minlength: '*Password must be of minimum six characters long'
        },
        new_password_confirmation: {
          required : '*New password confirmation field is required',
          minlength: '*Password must be of minimum six characters long'
        }
      }
    });
    $('#old_password').focus();
  });
</script>
@endpush