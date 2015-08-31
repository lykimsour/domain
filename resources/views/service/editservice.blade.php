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
               {!! Form::select('serviceclassid', $serviceclasses,$service->service_class_id,['class'=>'form-control',]) !!}
      </div>
      <div class="form-group">
               {!! Form::select('servicetypeid', $servicetypes , $service->service_type_id,['class'=>'form-control',]) !!}
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