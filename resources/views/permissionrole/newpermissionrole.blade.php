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
    <form method="post" action="{{route('storepermissionrole')}}">
     {!! csrf_field() !!}
      <div class="form-group">
        <label for="name">{{trans('Roles')}}</label>
         {!! Form::select('roleid', $roles, Input::old('serviceclassid'),['class'=>'form-control',]) !!}
      </div>
       <div class="form-group">
      <div class="checkbox">
    <b>Permissions:</b><br/><br/>
      	@foreach($permissions as $permission)
        <label><input type="checkbox" name="{{$permission->permission_slug}}" id="{{$permission->permission_slug}}" value="{{$permission->id}}"><b>{{$permission->permission_title}}<b/></label>
        @if($permission->id==1) 
          <br/>
        @endif
        @endforeach
      </div>
    </div>
       <button type="submit" class="btn btn-primary">{{trans('Assign')}}</button>
 	</form>
 </div>
 </div>
 </div>
@endsection