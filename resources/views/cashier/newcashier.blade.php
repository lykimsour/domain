@extends('layouts.app')
@section('title', 'Users')
@section('content')

<section class="content-header">
    <h1>
      {{trans('New Cashier')}}
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
    <form method="post" action="{{route('postcashier')}}">
    	   {!! csrf_field() !!}
    	<div class="form-group">
    		<label for="name">{{trans('Name')}}</label>
    		<input type="text" name="name" class="form-control" id="name">
  		</div>
  		<div class="form-group">
    		<label for="username">{{trans('User Name')}}</label>
    		<input type="text" name="username" class="form-control" id="username">
  		</div>
  		<div class="form-group">
    		<label for="pwd">Password</label>
    		<input type="password" name="password" class="form-control" id="password">
  		</div>
      <div class="form-group">
        <label >Confirm Password</label>
        <input type="password" class="form-control" name="password_confirmation">
        </div>
  		<div class="form-group">
    		<label for="commision">Commission_rate</label>
    		<input type="text" name="commission" class="form-control" id="commission">
  		</div>
  		<div class="checkbox">
    		<label><input type="checkbox" name="status" id="status">status</label>
  		</div>
		  <button type="submit" class="btn btn-primary">{{trans('Add Cashier')}}</button>
      </form>
    </div>
</div><br/>
</section>

@endsection
