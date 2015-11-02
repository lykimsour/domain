@extends('layouts.app')
@section('title', 'Users')
@section('content')

<section class="content-header">
    <h1>
      {{trans('New User')}}
    </h1>
  </section>
<section class="content">
 @if($errors->any())
    <ul class="alert alert-danger">
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
    @endif
<div class="row">
    <div class="col-md-6">
    <form  method="post" action="{{route('storeusers')}}" id="newuserform">
    	   {!! csrf_field() !!}
    	<div class="form-group">
    		<label for="name">{{trans('Name')}}</label>
    	<input type="text" class="form-control" name="name" value="{{ old('name') }}">
  		</div>
  		<div class="form-group">
    		<label for="username">{{trans('Email')}}</label>
    		<input type="email" class="form-control" name="email" value="{{ old('email') }}">
  		</div>
  		<div class="form-group">
    		<label for="pwd">Password</label>
    		<input type="password" class="form-control" name="password">
  		</div>
      <div class="form-group">
        <label >Confirm Password</label>
        <input type="password" class="form-control" name="password_confirmation">
        </div>
  		<div class="form-group">
    		<label for="commision">Role_Id</label>
    		{!! Form::select('roleid', $roles, Input::old('roleid'),['class'=>'form-control',]) !!}
  		</div>
  		<div class="checkbox">
    		<label><input type="checkbox" name="status" id="status">status</label>
  		</div>
		  <button type="submit" class="btn btn-primary" name="submit">{{trans('Add Users')}}</button>
      </form>
    </div>
</div><br/>
</section>

@endsection
