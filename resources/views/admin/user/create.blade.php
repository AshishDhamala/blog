@extends('admin.layouts.app')

@section('content')
  {!! success_or_failure_message() !!}
  {!! validation_error_message($errors) !!}

  {!! crud_for_every_page('user') !!}

  <form action="{{route('user.store')}}" method="post" id="asdh-create">
    {{csrf_field()}}
    <div class="row">
      <div class="col-sm-7">
        <div class="panel panel-default">
          <div class="panel-heading">
            <label for="category">Create a new user</label>
          </div>

          <div class="panel-body row">
            <!-- name -->
            <div class="form-group col-sm-6">
              <label for="name">Name</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="{{old('name')}}">
            </div>
            <!-- email -->
            <div class="form-group col-sm-6">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="example@example.com" value="{{old('email')}}">
            </div>
            <!-- password -->
            <div class="form-group col-sm-6">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" value="{{old('password')}}">
            </div>
            <!-- password confirmation -->
            <div class="form-group col-sm-6">
              <label for="password_confirmation">Confirm password</label>
              <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm password" value="{{old('password_confirmation')}}">
            </div>
            <!-- twitter username -->
            <div class="form-group col-sm-12">
              <label for="twitter_username">Twitter Username</label>
              <input type="text" class="form-control" id="twitter_username" name="twitter_username" placeholder="@johnSena" value="{{old('twitter_username')}}">
            </div>
            <!-- facebook profile url -->
            <div class="form-group col-sm-6">
              <label for="facebook_profile_url">Facebook Profile Url</label>
              <input type="url" class="form-control" id="facebook_profile_url" name="facebook_profile_url" placeholder="https://www.facebook.com/johnSena" value="{{old('facebook_profile_url')}}">
            </div>
            <!-- facebook page url -->
            <div class="form-group col-sm-6">
              <label for="facebook_page_url">Facebook Page Url</label>
              <input type="url" class="form-control" id="facebook_page_url" name="facebook_page_url" placeholder="https://www.facebook.com/johnSenaPage" value="{{old('facebook_page_url')}}">
            </div>
            <!-- admin role -->
            <div class="col-sm-12">
              <label for="role">Select user type</label>
              <select name="role" id="role" class="form-control">
                @foreach($roles as $role)
                  @if((current_user_role() != 'core' && $role->name == 'core') || $role->name == 'normal')
                    @continue
                  @endif
                  <option value="{{$role->id}}">{{$role->name()}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <!-- submit -->
          <div class="panel-footer">
            <input type="submit" class="btn btn-primary btn-block" value="Create">
          </div>
          {{--</div>--}}
        </div>
      </div>
      <!-- Edit category -->

    </div>
  </form>
@endsection

@push('script')
<script>
  $(document).ready(function () {
    var $asdhCreate = $('#asdh-create');
    $asdhCreate.validate({
      rules   : {
        name                 : {
          required: true
        },
        email                : 'required',
        password             : {
          required : true,
          minlength: 6
        },
        password_confirmation: {
          required : true,
          minlength: 6
        }
      },
      messages: {
        name                 : {
          required: '*Name field is required'
        },
        email                : {
          required: '*Email is required'
        },
        password             : {
          required : '*Password is required',
          minlength: '*Password must be of minimum six characters long'
        },
        password_confirmation: {
          required : '*Password confirmation field is required',
          minlength: '*Password must be of minimum six characters long'
        }
      }
    });
    $('#name').focus();
  });
</script>
@endpush