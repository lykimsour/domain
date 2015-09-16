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
    <form method="post" action="{{route('updatepermissionrole',['id'=>$permissionrole->id])}}">
     {!! csrf_field() !!}
      <input type="hidden" name="_method" value="PUT">
      <div class="form-group">
        <label>{{trans('Role')}}</label>
        {!! Form::select('roles', $roles,$permissionrole->role_id,['class'=>'form-control']) !!}
      </div>
      <div class="form-group">
        <label>{{trans('Permission')}}</label>
        {!! Form::select('permissions', $permissions,$permissionrole->permission_id,['class'=>'form-control']) !!}
      </div>
       <button type="submit" class="btn btn-primary">{{trans('Update')}}</button>
 	</form>
 </div>
 </div>
 </div>
@endsection