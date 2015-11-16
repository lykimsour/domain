<?php
use App\Permission;
use App\Role;
?>
@extends('layouts.app')

@section('content')

<div class="container-fluid">
<h2>{{trans('Manage Permissions')}}</h2>
<div class="row">
    <div class="col-md-6">
       <a href="{{route('createpermissionrole',['roleid'=>'1'])}}"><div class="btn btn-primary">{{trans('Assign Role_Permission')}}</div></a>
    </div>
</div><br/>
<div class="row">

    <div class="col-md-12">
       <ul class="list-group">
      <li class="list-group-item"><span class="glyphicon glyphicon-list-alt"></span>
          <span>List</span> 
      </li>
      <div class="table-responsive list-group-item">          
          <table class="table table-bordered table-hover table-condensed" >
            <thead>
                <tr>
                <th>Tool</th>
                  <th>Role_ID</th>
                  <th>Permission_ID</th>
                </tr>
            </thead>
               <tbody>
             @foreach($permissionroles as $permissionrole)
              <tr>
              <td>
              @if($permissionrole->permissions->id!=1)
              <form method="post" action="{{route('deletepermissionrole',['id'=>$permissionrole->id])}}" >
               {!! csrf_field() !!}
              <input type="hidden" name="_method" value="DELETE" >
              <button type="summit" class="btn btn-xs btn btn-danger" onclick="return confirm('Are you sure?')" >
              <span class="glyphicon glyphicon-remove"></span>
              </button>

              <a href="{{route('editpermissionrole',['id'=>$permissionrole->id])}}"><div class="btn btn-xs btn btn-info">
                <span class="glyphicon glyphicon-pencil"></span>
              </div></a>
                  @endif
               </form>
               </td>
              <input type="hidden" name="_method" value="DELETE" >
                    <td>{{$permissionrole->roles->role_title}}</td>
                    <td>{{$permissionrole->permissions->permission_slug}} </td>
              </tr>
              
             @endforeach
            </tbody>
          </table>
          </table>

        </div>

    </ul>
    </div>
</div><br/>
</div>
@endsection
