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
    <form method="post" action="{{route('updateonlineshop')}}" enctype="multipart/form-data">
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
        <label>{{trans('Description')}}</label>
        <input type="text" name="description" class="form-control" id="description" value="{{$arraydetail->description}}">
      </div>
        <div class="form-group">
        <label>{{trans('Help Note')}}</label>
        <input type="text" name="helpnote" class="form-control" id="helpnote" value="{{$arraydetail->help_note}}">
      </div>
       <div class="form-group">
        <label>{{trans('Special Note')}}</label>
        <input type="text" name="specialnote" class="form-control" id="specialnote" value="{{$arraydetail->special_note}}">
      </div>
        <div class="form-group">
              {!! Form::label('image', 'Icon') !!}<br/>
              <img src="{{url($arraydetail->icon)}}" />
              {!! Form::file('image') !!}
           </div>
       <div class="form-group">
        <div class="checkbox">

      @if($onlineshop->status)
      <label><input type="checkbox" name="status" id="status" checked="true">status</label>
      @else
      <label><input type="checkbox" name="status" id="status">status</label>
      @endif
      </div>
      </div>
		  <button type="submit" class="btn btn-primary">{{trans('Add Online_Shop')}}</button>
      </form>
    </div>
</div><br/>
</section>

@endsection
