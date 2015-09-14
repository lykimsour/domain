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
       <a href="{{route('createpermissionrole')}}"><div class="btn btn-primary">{{trans('Assign Role_Permission')}}</div></a>
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
                 <th>ID</th>
                  <th>Role_ID</th>
                  <th>Permission_ID</th>
                </tr>
            </thead>
               <tbody>
             @foreach($permissionroles as $permissionrole)
             <?php
              $roletitle = Role::findOrFail($permissionrole->role_id);
              $permissionslug = Permission::findOrFail($permissionrole->permission_id);
             ?>
              <tr>
              
              @if($roletitle->id!=1)
                  @endif
              <form method="post" action="" >
               {!! csrf_field() !!}
              <input type="hidden" name="_method" value="DELETE" >
                    <td>{{$permissionrole->id}}</td>
                    <td>{{$roletitle->role_title}}</td>
                    <td>{{$permissionslug->permission_slug}} </td>
            
              </tr>
              </form>
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
