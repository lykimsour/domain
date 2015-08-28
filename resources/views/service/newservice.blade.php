@extends('layouts.app')

@section('content')
<div class="container-fluid">
@if($errors->any())
    <ul class="alert alert-danger">
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
    @endif
<h2>{{trans('New Service')}}</h2>
<div class="row">
   <div class="col-md-6">
    <form method="post" action="{{route('storeservice')}}">
         {!! csrf_field() !!}
      <div class="form-group">
        <label for="name">{{trans('Code')}}</label>
        <input type="text" name="code" class="form-control" id="code">
      </div>
      <div class="form-group">
        <label for="username">{{trans('Service_class_id:')}}</label>
        <select id="serviceclassid" name="serviceclassid" class="selectpicker">
         @foreach($serviceclasses as $serviceclass)
        	<option>{{$serviceclass->id}}</option>
        @endforeach
        </select>
      </div>
      <div class="form-group">
        <label>{{trans('Service_type_id:')}}</label>
      
        <select class="selectpicker" id="servicetypeid" name="servicetypeid" >
          @foreach($servicetypes as $servicetype)
        	<option>{{$servicetype->id}}</option>
        	@endforeach
        </select>

      </div>
      <div class="form-group">
        <label for="pwd">Password</label>
        <input type="password" name="password" class="form-control" id="password" >
      </div>
      <div class="form-group">
        <label >Confirm Password</label>
        <input type="password" class="form-control" name="password_confirmation">
        </div>
       <div class="form-group">
        <label for="commision">{{trans('Info')}}</label>
        <input type="text" name="info" class="form-control" id="info">
      </div>
       <button type="submit" class="btn btn-primary">{{trans('Add Service')}}</button>
 	</form>
 </div>
 </div>
 </div>
@endsection
 @section('script')



