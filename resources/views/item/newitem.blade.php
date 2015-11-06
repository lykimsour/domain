@extends('layouts.app')
@section('title', 'Users')
@section('content')

<section class="content-header">
    <h1>
      {{trans('New Item')}}
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
    <form method="post" action="{{route('storeitem')}}" id="additem">
    	   {!! csrf_field() !!}
      <div class="form-group">
       <?php $gametypes = ["ak"=>"ak","jx2"=>"jx2"]; ?>
        <label for="username">{{trans('Game_Type')}}</label>
        {!! Form::select('gametypes',$gameservice, Input::old('gametypes'),['class'=>'form-control','id'=>'gametypes']) !!}
      </div>
      <div class="form-group">
        <label for="name">{{trans('ID')}}</label>
        <input type="text" name="id" class="form-control" id="id">
      </div>
    	<div class="form-group">
    		<label for="name">{{trans('Name')}}</label>
    		<input type="text" name="name" class="form-control" id="name">
  		</div>
       <div class="form-group">
        <label for="username">{{trans('Item_Type')}}</label>
        {!! Form::select('itemtype',$itemtype, Input::old('itemtype'),['class'=>'form-control','id'=>'itemtype']) !!}
      </div>
        <div class="form-group" id="duration">
        <label>Duration</label>
        <input type="text" name="duration" class="form-control" value="0">
      </div>
  		<div class="form-group">
    		<label>Price</label>
    		<input type="text" name="price" class="form-control" id="price">
  		</div>
      <div class="form-group">
              <label for="name" >{{trans('Date_Add')}}</label><br/>
                <div class="input-group date" data-date-format="yyyy-M-dd" id="dateadded"  >
                    <input type='text' class="form-control" name="dateadded" id="dateadded1" />
                    <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
          </div>
        <input type="hidden" value="null" id="datevalue">
  	

       <div class="form-group">
        <label for="username">{{trans('Group_ID')}}</label>
        {!! Form::select('itemgroup',$itemgroup, Input::old('itemgroup'),['class'=>'form-control',]) !!}
      </div>
  	
		  <button type="submit" class="btn btn-primary">{{trans('Save')}}</button>
      </form>
    </div>
</div><br/>
</section>

@endsection

@section('script')
  <script type="text/javascript">
    /*$(document).ready(function(){
       $('form#additem').validate({
        rules: {
          name: {
             required : true
          },
          price: {
            number: true,required : true
          }
        }
      });
    });*/
  </script>
@endsection