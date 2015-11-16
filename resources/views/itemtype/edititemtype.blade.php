@extends('layouts.app')
@section('title', 'Users')
@section('content')

<section class="content-header">
    <h1>
      {{trans('New Item_Group')}}
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
    <form method="post" action="{{route('updateitemtype',['id'=>$itemtype->id,'gametype'=>$gametype])}}" id="edditemgroup">
    <input type="hidden" name="_method" value="PUT">
    	   {!! csrf_field() !!}
    	<div class="form-group">
    		<label for="name">{{trans('Name')}}</label>
    		<input type="text" name="name" class="form-control" id="name" value="{{$itemtype->name}}">
  		</div>
		  <button type="submit" class="btn btn-primary">{{trans('Save')}}</button>
      </form>
    </div>
</div><br/>
</section>

@endsection
