@extends('layouts.app')
@section('content')

<section class="content-header">
    <h1>
      {{trans('Edit OnlineShop')}}
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
    <form method="post" action="{{route('updateonlineshop')}}">
    	   {!! csrf_field() !!}
      <input type="hidden" name="_method" value="PUT">
      <input type="hidden" name="id" id="id" value="{{$onlineshop->id}}">
    	<div class="form-group">
    		<label>{{trans('Name')}}</label>
    		<input type="text" name="name" class="form-control" id="name" value="{{$onlineshop->name}}">
  		</div>
  		<div class="form-group">
    		<label>{{trans('Code')}}</label>
    		<input type="text" name="code" class="form-control" id="code" value="{{$onlineshop->code}}">
  		</div>
  		<div class="form-group">
    		<label >Detail</label>
    		<textarea name="detail" class="form-control" id="detail">{{$onlineshop->detail}}</textarea>
  		</div>
        <div class="checkbox">

      @if($onlineshop->status)
      <label><input type="checkbox" name="status" id="status" checked="true">status</label>
      @else
      <label><input type="checkbox" name="status" id="status">status</label>
      @endif
      </div>
		  <button type="submit" class="btn btn-primary">{{trans('Add Online_Shop')}}</button>
      </form>
    </div>
</div><br/>
</section>

@endsection
