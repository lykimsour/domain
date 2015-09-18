@extends('layouts.app')
@section('content')

<section class="content-header">
    <h1>
      {{trans('New Promotion')}}
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
    <form method="post" action="{{route('storepromotion')}}" enctype="multipart/form-data">
    	   {!! csrf_field() !!}
    	<div class="form-group">
    		<label>{{trans('service_code')}}</label>
    		<input type="text" name="servicecode" class="form-control" id="servicecode">
  		</div>
  		<div class="form-group">
    		<label>{{trans('service_name')}}</label>
    		<input type="text" name="servicename" class="form-control" id="servicename">
  		</div>
  		<div class="form-group">
    		<label>{{trans('image')}}</label>
    		<input type="text" name="image1" class="form-control" id="image1">
  		</div>
        <div class="form-group">
        <label>{{trans('option_name')}}</label>
        <input type="text" name="optionname" class="form-control" id="optionname">
      </div>
       <div class="form-group">
              {!! Form::label('image', 'Value') !!}
              {!! Form::file('image[]',['multiple'=>true]) !!}
           </div>
     <div class="form-group">
        <label>{{trans('Description')}}</label>
        <input type="text" name="description" class="form-control" id="description">
      </div>
		  <button type="submit" class="btn btn-primary">{{trans('Add Online_Shop')}}</button>
      </form>
    </div>
</div><br/>
</section>

@endsection
