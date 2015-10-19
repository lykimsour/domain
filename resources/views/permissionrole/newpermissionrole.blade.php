@extends('layouts.app')
<?php
use App\PermissionRole;
use App\Permission;
?>

@section('content')
<div class="container-fluid">
@if($errors->any())
    <ul class="alert alert-danger">
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
    @endif
<h2>{{trans('Assign Permission')}}</h2>
<div class="row">
   <div class="col-md-8">
    <form method="post" action="{{route('storepermissionrole')}}" id="createform">
    <input type="hidden" name="_method" value="POST" id="method" >
   
     {!! csrf_field() !!}
      <div class="form-group">
        <label for="name">{{trans('Roles')}}</label>
         {!! Form::select('roleid', $roles, $roleid,['class'=>'form-control','id'=>'roleid']) !!} 
         <br/>
        <button type="submit" class="btn btn-primary">{{trans('Assign')}}</button></a>
      </div>

       <div class="form-group">
      <div class="checkbox">
    <b>Permissions:</b><br/><br/>
    <div class="table-responsive list-group-item">     
     <table class="table table-bordered table-hover table-condensed" >
      <thead>
          <tr>
          <th>Users_Manager</th>
          </tr>
      </thead>
     <tr>
      	@foreach($managers as $manager)
        <?php
          $check = PermissionRole::where(['role_id'=>$roleid,'permission_id'=>$manager->id])->get();
        ?>
        @if($check->first())
         <td><label><input type="checkbox" name="{{$manager->permission_slug}}" id="{{$manager->permission_slug}}" value="{{$manager->id}}" checked="true"><b>{{$manager->permission_title}}</b></label></td>
        @else
        <td><label><input type="checkbox" name="{{$manager->permission_slug}}" id="{{$manager->permission_slug}}" value="{{$manager->id}}"><b>{{$manager->permission_title}}</b></label></td>
        @endif
        @endforeach
        </tr>
      </table>
      </div><br/>
      <div class="table-responsive list-group-item">     
     <table class="table table-bordered table-hover table-condensed" >
       <thead>
          <tr>
          <th>Cashier_Management</th>
          </tr>
      </thead>
     <tr>
        @foreach($cashiers as $cashier)
         <?php
          $check = PermissionRole::where(['role_id'=>$roleid,'permission_id'=>$cashier->id])->get();
        ?>
        @if($check->first())
         <td><label><input type="checkbox" name="{{$cashier->permission_slug}}" id="{{$cashier->permission_slug}}" value="{{$cashier->id}}" checked="true"><b>{{$cashier->permission_title}}</b></label></td>
        @else
        <td><label><input type="checkbox" name="{{$cashier->permission_slug}}" id="{{$cashier->permission_slug}}" value="{{$cashier->id}}"><b>{{$cashier->permission_title}}</b></label></td>
        @endif
        @endforeach
        </tr>
      </table>
      </div><br/>
     <div class="table-responsive list-group-item">     
     <table class="table table-bordered table-hover table-condensed" >
       <thead>
          <tr>
          <th>Service_Management</th>
          </tr>
      </thead>
     <tr>
        @foreach($services as $service)
         <?php
          $check = PermissionRole::where(['role_id'=>$roleid,'permission_id'=>$service->id])->get();
        ?>
        @if($check->first())
         <td><label><input type="checkbox" name="{{$service->permission_slug}}" id="{{$service->permission_slug}}" value="{{$service->id}}" checked="true"><b>{{$service->permission_title}}</b></label></td>
        @else
         <td><label><input type="checkbox" name="{{$service->permission_slug}}" id="{{$service->permission_slug}}" value="{{$service->id}}"><b>{{$service->permission_title}}</b></label></td>
        @endif
        @endforeach
        </tr>
      </table>
      </div><br/>
     <div class="table-responsive list-group-item">     
     <table class="table table-bordered table-hover table-condensed" >
     <thead>
          <tr>
          <th>Online_shop_Management</th>
          </tr>
      </thead>
     <tr>
        @foreach($onlineshops as $onlineshop)
         <?php
          $check = PermissionRole::where(['role_id'=>$roleid,'permission_id'=>$onlineshop->id])->get();
        ?>
        @if($check->first())
         <td><label><input type="checkbox" name="{{$onlineshop->permission_slug}}" id="{{$onlineshop->permission_slug}}" value="{{$onlineshop->id}}" checked="true"><b>{{$onlineshop->permission_title}}</b></label></td>
        @else
         <td><label><input type="checkbox" name="{{$onlineshop->permission_slug}}" id="{{$onlineshop->permission_slug}}" value="{{$onlineshop->id}}"><b>{{$onlineshop->permission_title}}</b></label></td>

        @endif
        @endforeach
        </tr>
      </table>
      </div><br/>
     <div class="table-responsive list-group-item">     
     <table class="table table-bordered table-hover table-condensed" >
     <thead>
          <tr>
          <th>Promotion_Management</th>
          </tr>
      </thead>
     <tr>
        @foreach($promotions as $promotion)
         <?php
          $check = PermissionRole::where(['role_id'=>$roleid,'permission_id'=>$promotion->id])->get();
        ?>
        @if($check->first())
         <td><label><input type="checkbox" name="{{$promotion->permission_slug}}" id="{{$promotion->permission_slug}}" value="{{$promotion->id}}" checked="true"><b>{{$promotion->permission_title}}</b></label></td>
        @else
         <td><label><input type="checkbox" name="{{$promotion->permission_slug}}" id="{{$promotion->permission_slug}}" value="{{$promotion->id}}"><b>{{$promotion->permission_title}}</b></label></td>
        @endif
        @endforeach
        </tr>
      </table>
      </div><br/>
       <div class="table-responsive list-group-item">     
     <table class="table table-bordered table-hover table-condensed" >
     <thead>
          <tr>
          <th>Merchant_Management</th>
          </tr>
      </thead>
     <tr>
        @foreach($merchants as $merchant)
         <?php
          $check = PermissionRole::where(['role_id'=>$roleid,'permission_id'=>$merchant->id])->get();
        ?>
        @if($check->first())
         <td><label><input type="checkbox" name="{{$merchant->permission_slug}}" id="{{$merchant->permission_slug}}" value="{{$merchant->id}}" checked="true"><b>{{$merchant->permission_title}}</b></label></td>
        @else
         <td><label><input type="checkbox" name="{{$merchant->permission_slug}}" id="{{$merchant->permission_slug}}" value="{{$merchant->id}}"><b>{{$merchant->permission_title}}</b></label></td>
        @endif
        @endforeach
        </tr>
      </table>
      </div><br/>
     <div class="table-responsive list-group-item">     
     <table class="table table-bordered table-hover table-condensed" >
     <thead>
          <tr>
          <th>Report_Management</th>
          </tr>
      </thead>
     <tr>
        @foreach($reports as $report)
         <?php
          $check = PermissionRole::where(['role_id'=>$roleid,'permission_id'=>$report->id])->get();
        ?>
        @if($check->first())
         <td><label><input type="checkbox" name="{{$report->permission_slug}}" id="{{$report->permission_slug}}" value="{{$report->id}}" checked="true"><b>{{$report->permission_title}}</b></label></td>
        @else
         <td><label><input type="checkbox" name="{{$report->permission_slug}}" id="{{$report->permission_slug}}" value="{{$report->id}}"><b>{{$report->permission_title}}</b></label></td>
        @endif
        @endforeach
        </tr>
      </table>
      </div>
      </div>
    </div>
       
 	</form>
 </div>
 
 </div>



 
@endsection