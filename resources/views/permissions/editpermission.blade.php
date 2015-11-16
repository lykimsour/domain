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
<h2>{{trans('Edit Permission')}}</h2>
<div class="row">
   <div class="col-md-6">
    <form method="post" action="{{route('updatepermission',['id'=>$permission->id])}}">
    <input type="hidden" name="_method" value="PUT">
     {!! csrf_field() !!}
        
      <div class="form-group">
        <label for="name">{{trans('Permission_Title')}}</label>
        <input type="text" name="permissiontitle" class="form-control" id="permissiontitle" value="{{$permission->permission_title}}">
      </div>  
      <div class="form-group">
        <label for="name">{{trans('Permission_Slug')}}</label>
        <input type="text" name="permissionslug" class="form-control" id="permissionslug" value="{{$permission->permission_slug}}">
      </div>  
       <button type="submit" class="btn btn-primary">{{trans('Edit Permission')}}</button>
  </form>
 </div>
 </div>
 </div>
@endsection