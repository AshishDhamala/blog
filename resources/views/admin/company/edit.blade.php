@extends('admin.layouts.app')

@section('title', ' | Company Information')

@section('content')
  {!! success_or_failure_message() !!}
  {!! validation_error_message($errors) !!}
  <div class="row">
    <div class="col-sm-8">
      <form action="{{route('company.update', $company->id)}}" method="post" class="panel panel-default" id="asdh-edit">
        {{csrf_field()}}
        {{method_field('PUT')}}
        <div class="panel-body">
          <!-- name -->
          <div class="form-group">
            <label for="name">Company name</label>
            <input type="text" name="name" class="form-control" id="name" value="{{$company->name}}">
          </div>
          <!-- email -->
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email" value="{{$company->email}}">
          </div>
          <div class="row">
            <!-- phone number -->
            <div class="form-group col-sm-6">
              <label for="phone">Phone number</label>
              <input type="number" name="phone" class="form-control" id="phone" value="{{$company->phone}}">
            </div>
            <!-- established date -->
            <div class="form-group col-sm-6">
              <label for="established_date">Established date</label>
              <input type="date" name="established_date" class="form-control" id="established_date" value="{{format_date($company->established_date,'Y-m-d')}}">
            </div>
          </div>
          <!-- address -->
          <div class="form-group">
            <label for="address">Address</label>
            <input type="text" name="address" class="form-control" id="address" value="{{$company->address}}">
          </div>
        </div>
        <!-- submit -->
        <div class="panel-footer">
          <input type="submit" value="Update" class="btn btn-primary btn-block">
        </div>
      </form>
    </div>
    <div class="col-sm-4">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4>All information</h4>
        </div>
        <div class="panel-body row">
          <div class="col-xs-7">
            <p><b>Total users:</b></p>
            <p><b>Total categories:</b></p>
            <p><b>Total posts:</b></p>
            <p><b>Total tags:</b></p>
            <p><b>Total navigation items:</b></p>
          </div>
          <div class="col-xs-5">
            <p>{{\App\User::count()}}</p>
            <p>{{\App\Category::count()}}</p>
            <p>{{\App\Post::count()}}</p>
            <p>{{\App\Tag::count()}}</p>
            @if(current_user_role() == 'core')
              <p>Admin: {{\App\Navigation::where('admin',1)->count()+1}}</p>
              <p>Public: {{\App\Navigation::where('admin',0)->count()}}</p>
            @else
              <p>{{\App\Navigation::where('admin',0)->count()}}</p>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('script')
<script>
  $(document).ready(function () {
    $('#asdh-edit').validate({
      rules   : {
        name   : {
          required: true
        },
        address: 'required'
      },
      messages: {
        name   : {
          required: '*Company name is required.'
        },
        address: {
          required: '*Address field is required.'
        }
      }
    });
  });
</script>
@endpush