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
<h2>{{trans('Edit ServiceType')}}</h2>
<div class="row">
   <div class="col-md-6">
    <form method="post" action="{{route('updateservicetype')}}">
         {!! csrf_field() !!}
    <input type="hidden" name='_method' value="PUT">
    <input type="hidden" name="id" id="id" value="{{$servicetype->id}}">
      <div class="form-group">
        <label for="name">{{trans('Name')}}</label>
        <input type="text" name="name" id="name" class="form-control" id="name" value="{{$servicetype->name}}">
      </div>
       <button type="submit" class="btn btn-primary">{{trans('Add ServiceType')}}</button>
 	</form>
 </div>
 </div>
 </div>

@endsection