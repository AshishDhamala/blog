@extends('admin.layouts.app')

@section('title', '| Company Information')

@section('content')
  <div id="asdh-index_category">
    {!! success_or_failure_message() !!}
    {!! validation_error_message($errors) !!}
    {!! success_or_failure_message_ajax() !!}
    {{--{!! crud_for_every_page('category') !!}--}}

    <div class="panel panel-default">
      <div class="panel-heading">
        <h2>Company Description</h2>
      </div>
      <ul class="panel-body">
        <li><b>Name:</b> {{$company->name}}</li>
        <li><b>Email:</b> {{$company->email}}</li>
        <li><b>Address:</b> {{$company->address}}</li>
        <li><b>Phone:</b> <a href="tel:{{$company->phone}}">{{$company->phone}}</a></li>
      </ul>
      <div class="panel-footer">
        <b>Established on:</b> {{format_date($company->established_date, 'M d, Y')}}
      </div>
    </div>

  </div>
@endsection

@push('script')
<script>
  $(document).ready(function () {

  });
</script>
@endpush