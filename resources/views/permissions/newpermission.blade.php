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
<h2>{{trans('New Permission')}}</h2>
<div class="row">
   <div class="col-md-6">
    <form method="post" action="{{route('storepermission')}}">
     {!! csrf_field() !!}
        
      <div class="form-group">
        <label for="name">{{trans('Permission_Title')}}</label>
        <input type="text" name="permissiontitle" class="form-control" id="permissiontitle">
      </div>  
      <div class="form-group">
        <label for="name">{{trans('Permission_Slug')}}</label>
        <input type="text" name="permissionslug" class="form-control" id="permissionslug">
      </div>  
       <button type="submit" class="btn btn-primary">{{trans('Add Permission')}}</button>
 	</form>
 </div>
 </div>
 </div>
@endsection