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
    <form method="post" action="{{route('storeitem')}}">
    	   {!! csrf_field() !!}
    	<div class="form-group">
    		<label for="name">{{trans('Name')}}</label>
    		<input type="text" name="name" class="form-control" id="name">
  		</div>
       <div class="form-group">
       <?php $itemtypes = ["durable"=>"Durable","consumable"=>"Consumable","periodic"=>"Periodic"]; ?>
        <label for="username">{{trans('Cashier_Type')}}</label>
        {!! Form::select('itemtype',$itemtypes, Input::old('itemtype'),['class'=>'form-control',]) !!}
      </div>
  		<div class="form-group">
    		<label for="pwd">Price</label>
    		<input type="text" name="price" class="form-control" id="price">
  		</div>
      <div class="form-group">
              <label for="name" >{{trans('Start_Date')}}</label><br/>
                <div class="input-group date" data-date-format="dd-M-yy" id="startdate"  >
                    <input type='text' class="form-control" name="dateadded" id="sdateid" />
                    <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
          </div>
  		<div class="form-group">
    		<label>Group_ID</label>
    		<input type="text" name="groupid" class="form-control" id="groupid">
  		</div>
  	
		  <button type="submit" class="btn btn-primary">{{trans('Add Cashier')}}</button>
      </form>
    </div>
</div><br/>
</section>

@endsection
