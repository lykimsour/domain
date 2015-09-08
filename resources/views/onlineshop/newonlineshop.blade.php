@extends('layouts.app')
@section('content')

<section class="content-header">
    <h1>
      {{trans('New OnlineShop')}}
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
    <form method="post" action="{{route('storeonlineshop')}}" enctype="multipart/form-data">
    	   {!! csrf_field() !!}
    	<div class="form-group">
    		<label>{{trans('Name')}}</label>
    		<input type="text" name="name" class="form-control" id="name">
  		</div>
  		<div class="form-group">
    		<label>{{trans('Code')}}</label>
    		<input type="text" name="code" class="form-control" id="code">
  		</div>
  		<div class="form-group">
    		<label>{{trans('Description')}}</label>
    		<input type="text" name="description" class="form-control" id="description">
  		</div>
        <div class="form-group">
        <label>{{trans('Help Note')}}</label>
        <input type="text" name="helpnote" class="form-control" id="helpnote">
      </div>
       <div class="form-group">
        <label>{{trans('Special Note')}}</label>
        <input type="text" name="specialnote" class="form-control" id="specialnote">
      </div>
       <div class="form-group">
              {!! Form::label('image', 'Icon') !!}
              {!! Form::file('image') !!}
           </div>
       <div class="form-group">
      <div class="checkbox">
        <label><input type="checkbox" name="status" id="status">status</label>
      </div>
      </div>
		  <button type="submit" class="btn btn-primary">{{trans('Add Online_Shop')}}</button>
      </form>
    </div>
</div><br/>
</section>

@endsection
