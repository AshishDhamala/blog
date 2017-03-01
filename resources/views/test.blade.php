@extends('master')

@section('title', '- Test')

@section('body')
  <form action="{{route('test.store')}}" method="post">
    {{csrf_field()}}
    <input type="checkbox" name="multipleDelete[]" value="1">
    <input type="checkbox" name="multipleDelete[]" value="2">
    <input type="checkbox" name="multipleDelete[]" value="3">

    <button type="submit" name="delete" value="1" class="btn btn-primary">Delete</button>
    <button type="submit" name="delete" value="2" class="btn btn-primary">Delete</button>
    <button type="submit" name="delete" value="3" class="btn btn-primary">Delete</button>

    <input type="submit" value="submit">
  </form>
@endsection
