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
<h2>{{trans('Edit Service')}}</h2>
<div class="row">
   <div class="col-md-6">
    <form method="post" action="{{route('updateservice')}}">
     {!! csrf_field() !!}
         <input type="hidden" name="_method" value="PUT">
         <input type="hidden" name="id" id="id" value="{{$service->id}}">
      <div class="form-group">
        <label for="name">{{trans('Code')}}</label>
        <input type="text" name="code" class="form-control" id="code" value="{{$service->code}}">
      </div>
      <div class="form-group">
        <label for="username">{{trans('Service_class_id:')}}</label>
        <select id="serviceclassid" name="serviceclassid" class="selectpicker">
        <option selected="{{$service->service_class_id}}">{{$service->service_class_id}}</option>
         @foreach($serviceclasses as $serviceclass)
         	@if($serviceclass->id!=$service->service_class_id)
        	<option>{{$serviceclass->id}}</option>
        	@endif
        	
        @endforeach
        </select>
      </div>
      <div class="form-group">
        <label>{{trans('Service_type_id:')}}</label>
        <select class="selectpicker" id="servicetypeid" name="servicetypeid" >
        <option selected="{{$service->service_type_id}}">{{$service->service_type_id}}</option>
          @foreach($servicetypes as $servicetype)
          	@if($servicetype->id!=$service->service_type_id)
        	<option>{{$servicetype->id}}</option>
        	@endif
        	@endforeach
        </select>

      </div>
      <div class="form-group">
        <label for="pwd">Password</label>
        <input type="password" name="password" class="form-control" id="password" value="{{$service->password}}">
      </div>
      <div class="form-group">
        <label >Confirm Password</label>
        <input type="password" class="form-control" name="password_confirmation" value="{{$service->password}}">
        </div>
       <div class="form-group">
        <label for="commision">{{trans('Info')}}</label>
        <input type="text" name="info" class="form-control" id="info" value="{{$service->info}}">
      </div>
       <button type="submit" class="btn btn-primary">{{trans('Edit Service')}}</button>
 	</form>
 </div>
 </div>
 </div>
@endsection