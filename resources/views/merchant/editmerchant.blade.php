@extends('layouts.app')
@section('title', 'Users')
@section('content')

<section class="content-header">
    <h1>
      {{trans('Edit Merchant')}}
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
    <form method="post" action="{{route('updatemerchant',['id'=>$merchant->id])}}" enctype="multipart/form-data">
    	   {!! csrf_field() !!}
      <input type="hidden" name="_method" value="PUT">
    	<div class="form-group">
    		<label for="name">{{trans('Name')}}</label>
    		<input type="text" name="name" class="form-control" id="name" value="{{$merchant->name}}">
  		</div>
  		<div class="form-group">
    		<label for="username">{{trans('email')}}</label>
    		<input type="text" name="email" class="form-control" id="email" value="{{$merchant->email}}">
  		</div>
         <div class="form-group">
        <label for="name">{{trans('Service_Code')}}</label>
               {!! Form::select('servicecode', $servicecode,$merchant->service_code,['class'=>'form-control',]) !!}
      </div>
  		<div class="form-group">
    		<label for="pwd">Password</label>
    		<input type="password" name="password" class="form-control" id="password" value="{{$merchant->password}}">
  		</div>
      <div class="form-group">
        <label >Confirm Password</label>
        <input type="password" class="form-control" name="password_confirmation" value="{{$merchant->password}}">
        </div>
  		<div class="form-group">
    		<label for="commision">Coin</label>
    		<input type="text" name="coin" class="form-control" id="coin" value="{{$merchant->coin}}">
  		</div>
        <div class="form-group">
        <label for="commision">Currency</label>
        <input type="text" name="currency" class="form-control" id="currency" value="{{$merchant->currency}}">
      </div>
        <div class="form-group">
        <label for="commision">Comission</label>
        <input type="text" name="comission" class="form-control" id="comission" value="{{$merchant->commission}}" >
      </div>
       <div class="form-group">
  		<div class="checkbox">
      @if($merchant->status)
    		<label><input type="checkbox" name="status" id="status" checked="true">status</label>
      @else

       <label><input type="checkbox" name="status" id="status">status</label>
      @endif 
  		</div>
      </div>
       <div class="form-group">
              {!! Form::label('image', 'Logo') !!} <br/>
                 <img src="{{url($logo->logo)}}" />
                 <br/>
              {!! Form::file('image') !!}
           </div>
		  <button type="submit" class="btn btn-primary">{{trans('Edit Merchant')}}</button>
      </form>
    </div>
</div><br/>
</div>
</section>

@endsection
