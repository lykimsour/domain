@extends('layouts.app')
@section('title', 'Users')
@section('content')

<section class="content-header">
    <h1>
      {{trans('Change Profile')}}
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
    <form method="post" action="">
    	   {!! csrf_field() !!}
    <input type="hidden" name="_method" value="PUT">
    <div class="form-group">
        <label for="pwd">Name</label>
        <input type="text" class="form-control" name="name" value="{{$user->name}}">
      </div>
    <div class="form-group">
      <label for="pwd">Email</label>
        <input type="text" class="form-control" name="email" value="{{$user->email}}">
      </div>
  		<div class="form-group">
    		<label for="pwd">New Password</label>
    		<input type="password" class="form-control" name="password" value="{{$user->password}}">
  		</div>
      <div class="form-group">
        <label >Confirm Password</label>
        <input type="password" class="form-control" name="password_confirmation" value="{{$user->password}}">
        </div>
          <div class="form-group">
        <label for="commision">Role_Id</label>
        {!! Form::select('roleid', $roles, $user->role_id,['class'=>'form-control']) !!}
      </div>
		  <button type="submit" class="btn btn-primary">{{trans('Update My Profile')}}</button>
      </form>
    </div>
</div><br/>
</section>

@endsection
