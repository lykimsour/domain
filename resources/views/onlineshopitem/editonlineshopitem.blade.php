@extends('layouts.app')
@section('content')

<section class="content-header">
    <h1>
      {{trans('Edit OnlineShopItem')}}
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
    <form method="post" action="{{route('updateonlineshopitem',['id'=>$onlineshopitem->id])}}" enctype="multipart/form-data">
    	   {!! csrf_field() !!}
      <input type="hidden" name="_method" value="PUT">
    	<div class="form-group">
    		<label>{{trans('Online_Shop_Code')}}</label>
        {!! Form::select('onlineshops', $onlineshops,$onlineshopitem->online_shop_code,['class'=>'form-control']) !!}
  		</div>
  		<div class="form-group">
    		<label>{{trans('Name')}}</label>
    		<input type="text" name="name" class="form-control" id="name" value="{{$arrayitem->name}}">
  		</div> 
      <div class="form-group">
        <label>{{trans('SKU')}}</label>
        <input type="text" name="sku" class="form-control" id="sku" value="{{$arrayitem->sku}}">
      </div> 
      <div class="form-group">
      <label>{{trans('Currency')}}</label>
        {!! Form::select('currency',['coin'=>'coin'],$onlineshops,['class'=>'form-control']) !!}
      </div> 
       <div class="form-group">
        <label>{{trans('Value')}}</label>
        <input type="text" name="value" class="form-control" id="value" value="{{$arrayitem->value}}">
      </div> 
       <div class="form-group">
        <label>{{trans('Max')}}</label>
        <input type="text" name="max" class="form-control" id="max" value="{{$arrayitem->max}}">
      </div> 
      <div class="form-group">
        <label>{{trans('Ordering')}}</label>
        <input type="text" name="ordering" class="form-control" id="ordering" value="{{$onlineshopitem->ordering}}">
      </div> 
       <div class="form-group">
      <div class="checkbox">
      @if($onlineshopitem->status)
      <label><input type="checkbox" name="status" id="status" checked="true">status</label>
      @else
      <label><input type="checkbox" name="status" id="status">status</label>
      @endif
      </div>
    </div>
      <div class="form-group">
      {!! Form::label('image', 'Image') !!}<br/>
        <img src="{{url($arrayitem->image)}}" /><br/><br/>
              {!! Form::file('image') !!}

           </div>
		  <button type="submit" class="btn btn-primary">{{trans('Edit Online_Shop_item')}}</button>

      </form>

        
    </div>
</div><br/>
</section>

@endsection
