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
    <form method="post" action="{{route('storeonlineshopitem')}}">
    	   {!! csrf_field() !!}
    	<div class="form-group">
    		<label>{{trans('Online_Shop_Code')}}</label>
        {!! Form::select('onlineshops', $onlineshops , Input::old('onlineshops'),['class'=>'form-control',]) !!}
  		</div>
  		<div class="form-group">
    		<label>{{trans('Item')}}</label>
    		<input type="text" name="item" class="form-control" id="item">
  		</div> 
      <div class="form-group">
        <label>{{trans('Ordering')}}</label>
        <input type="text" name="ordering" class="form-control" id="ordering">
      </div> 
      <div class="checkbox">
        <label><input type="checkbox" name="status" id="status">status</label>
      </div>
		  <button type="submit" class="btn btn-primary">{{trans('Add Online_Shop_item')}}</button>
      </form>
    </div>
</div><br/>
</section>

@endsection
