@extends('layouts.app')



@section('content')
<div class="container-fluid">
@if($errors->any())
    <ul class="alert alert-danger">
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
    @endif
<h2>{{trans('New ServiceClass')}}</h2>
<div class="row">
   <div class="col-md-6">
    <form method="post" action="{{route('storeserviceclass')}}">
    {!! csrf_field() !!}
            
      <div class="form-group">
        <label for="name">{{trans('Name')}}</label>
        <input type="text" name="name" class="form-control" id="name">
      </div>
       <div class="form-group">
        <label>{{trans('Commission_rate')}}</label>
        <input type="text" name="commissionrate" class="form-control" id="commissionrate">
      </div>
      <div class="form-group">
        <label>{{trans('Payout_rate')}}</label>
        <input type="text" name="payoutrate" class="form-control" id="payoutrate">
      </div>
       <button type="submit" class="btn btn-primary">{{trans('Add ServiceClass')}}</button>
 	</form>
 </div>
 </div>
 </div>
@endsection
