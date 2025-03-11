@extends('students.layout')
@section('content')
 
<div class="card">
  <div class="card-header">Contactus Page</div>
  <div class="card-body">
      
     <form action="{{ url('student/' . $students->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method("PATCH")
    <input type="hidden" name="id" value="{{$students->id}}" />

    <label>Name</label></br>
    <input type="text" name="name" value="{{$students->name}}" class="form-control"></br>

    <label>Address</label></br>
    <input type="text" name="address" value="{{$students->address}}" class="form-control"></br>

    <label>Mobile</label></br>
    <input type="text" name="mobile" value="{{$students->mobile}}" class="form-control"></br>

    <label>Image</label></br>
    <input type="file" name="image" class="form-control"></br>

    @if($students->image)
        <img src="{{ asset($students->image) }}" width="100" class="mt-2">
    @endif</br>

    <input type="submit" value="Update" class="btn btn-success"></br>
</form>

   
  </div>
</div>
 
@stop