@extends('layouts.app')
@section('content')

<section class="content-header">
    <h1>
      {{trans('New OnlineShopItem')}}
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
    <form method="post" action="{{route('storeonlineshopitem')}}" enctype="multipart/form-data">
    	   {!! csrf_field() !!}
    	<div class="form-group">
    		<label>{{trans('Online_Shop_Code')}}</label>
        {!! Form::select('onlineshops', $onlineshops , Input::old('onlineshops'),['class'=>'form-control']) !!}
  		</div>
  		<div class="form-group">
    		<label>{{trans('Name')}}</label>
    		<input type="text" name="name" class="form-control" id="name">
  		</div> 
      <div class="form-group">
        <label>{{trans('SKU')}}</label>
        <input type="text" name="sku" class="form-control" id="sku">
      </div> 
      <div class="form-group">
      <label>{{trans('Currency')}}</label>
        {!! Form::select('currency',['coin'=>'coin'],Input::old('currency'),['class'=>'form-control']) !!}
      </div> 
       <div class="form-group">
        <label>{{trans('Value')}}</label>
        <input type="text" name="value" class="form-control" id="value">
      </div> 
       <div class="form-group">
        <label>{{trans('Max')}}</label>
        <input type="text" name="max" class="form-control" id="max">
      </div> 
      <div class="form-group">
        <label>{{trans('Ordering')}}</label>
        <input type="text" name="ordering" class="form-control" id="ordering">
      </div> 
       <div class="form-group">
      <div class="checkbox">
        <label><input type="checkbox" name="status" id="status">status</label>
      </div>
    </div>
      <div class="form-group">
              {!! Form::label('image', 'Image') !!}
              {!! Form::file('image') !!}
           </div>
		  <button type="submit" class="btn btn-primary">{{trans('Add Online_Shop_item')}}</button>

      </form>

        
    </div>
</div><br/>
</section>

@endsection
