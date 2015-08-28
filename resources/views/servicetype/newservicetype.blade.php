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
<h2>{{trans('New ServiceType')}}</h2>
<div class="row">
   <div class="col-md-6">
    <form method="post" action="{{route('storeservicetype')}}">
    {!! csrf_field() !!}
            
      <div class="form-group">
        <label for="name">{{trans('Name')}}</label>
        <input type="text" name="name" class="form-control" id="name">
      </div>
       <button type="submit" class="btn btn-primary">{{trans('Add ServiceType')}}</button>
 	</form>
 </div>
 </div>
 </div>
@endsection
