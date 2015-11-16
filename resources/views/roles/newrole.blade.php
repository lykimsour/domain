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
<h2>{{trans('New Role')}}</h2>
<div class="row">
   <div class="col-md-6">
    <form method="post" action="{{route('storerole')}}">
     {!! csrf_field() !!}
        
      <div class="form-group">
        <label for="name">{{trans('Role_Title')}}</label>
        <input type="text" name="roletitle" class="form-control" id="roletitle">
      </div>  
      <div class="form-group">
        <label for="name">{{trans('Role_Slug')}}</label>
        <input type="text" name="roleslug" class="form-control" id="roleslug">
      </div>  
       <button type="submit" class="btn btn-primary">{{trans('Add Role')}}</button>
 	</form>
 </div>
 </div>
 </div>
@endsection