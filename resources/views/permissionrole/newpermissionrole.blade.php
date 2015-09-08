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
    <form method="post" action="">
     {!! csrf_field() !!}
         <input type="hidden" name="_method" value="PUT">
         <input type="hidden" name="id" id="id" value="">
      <div class="form-group">
        <label for="name">{{trans('Users')}}</label>
         {!! Form::select('userid', $users, Input::old('serviceclassid'),['class'=>'form-control',]) !!}
        

      </div>
       <button type="submit" class="btn btn-primary">{{trans('Edit Service')}}</button>
 	</form>
 </div>
 </div>
 </div>
@endsection