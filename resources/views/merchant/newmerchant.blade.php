@extends('layouts.app')
@section('title', 'Users')
@section('content')

<section class="content-header">
    <h1>
      {{trans('New Merchant')}}
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
     <div class="table-responsive list-group-item"> 
    <form method="post" action="{{route('storemerchant')}}" enctype="multipart/form-data">
    	   {!! csrf_field() !!}
    	<div class="form-group">
    		<label for="name">{{trans('Name')}}</label>
    		<input type="text" name="name" class="form-control" id="name">
  		</div>
  		<div class="form-group">
    		<label for="username">{{trans('email')}}</label>
    		<input type="text" name="email" class="form-control" id="email">
  		</div>
      <div class="form-group">
        <label for="name">{{trans('Service_Code')}}</label>
               {!! Form::select('servicecode', $servicecode,Input::old('servicecode'),['class'=>'form-control',]) !!}
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
    		<label for="commision">Coin</label>
    		<input type="text" name="coin" class="form-control" id="coin">
  		</div>
        <div class="form-group">
        <label for="commision">Currency</label>
        <input type="text" name="currency" class="form-control" id="currency">
      </div>
        <div class="form-group">
        <label for="commision">Comission</label>
        <input type="text" name="comission" class="form-control" id="comission" >
      </div>
       <div class="form-group">
  		<div class="checkbox">
    		<label><input type="checkbox" name="status" id="status">status</label>
  		</div>
      </div>
       <div class="form-group">
              {!! Form::label('image', 'Logo') !!}
              {!! Form::file('image') !!}
           </div>
		  <button type="submit" class="btn btn-primary">{{trans('Add Merchant')}}</button>
      </form>
    </div>
    </div>
</div><br/>

</section>

@endsection
