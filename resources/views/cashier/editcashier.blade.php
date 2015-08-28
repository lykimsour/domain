@extends('layouts.app')

@section('content')


<div class="container-fluid">
<h2>{{trans('Edit Cashier')}}</h2>
@if($errors->any())
    <ul class="alert alert-danger">
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
    @endif
<div class="row">
   <div class="col-md-6">
    <form method="post" action="{{route('puteditcashier')}}">
         {!! csrf_field() !!}
         <input type="hidden" name="_method" value="PUT">
         <input type="hidden" name="id" id="id" value="{{$cashiers->id}}">
      <div class="form-group">

        <label for="name">{{trans('Name')}}</label>
        <input type="text" name="name" class="form-control" id="name" value="{{$cashiers->name}}">
      </div>
      <div class="form-group">
        <label for="username">{{trans('User Name')}}</label>
        <input type="text" name="username" class="form-control" id="username" value="{{$cashiers->username}}">
      </div>
      <div class="form-group">
        <label for="commision">Commission_rate</label>
        <input type="text" name="commission" class="form-control" id="commission" value="{{$cashiers->commission_rate}}">
      </div>
       <div class="form-group">
        <label for="commision">Bonus_Balance</label>
        <input type="text" name="bonusbalance" class="form-control" id="bonusbalance" value="{{$cashiers->bonus_balance}}">
      </div>
      <div class="form-group">
        <label for="pwd">Password</label>
        <input type="password" name="password" class="form-control" id="password" value="{{$cashiers->password}}">
      </div>
      <div class="form-group">
        <label >Confirm Password</label>
        <input type="password" class="form-control" name="password_confirmation" value="{{$cashiers->password}}">
        </div>
      <div class="checkbox">
   
      @if($cashiers->status)
      <label><input type="checkbox" name="status" id="status" checked="true">status</label>
      @else
      <label><input type="checkbox" name="status" id="status">status</label>
      @endif
      </div>
      <button type="submit" class="btn btn-primary">{{trans('Edit Cashier')}}</button>
      </form>
    </div>
</div><br/>

</div>
 <!---->
@endsection

