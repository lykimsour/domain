@extends('layouts.app')
@section('title', 'Users')
@section('content')

<div class="container">
<h2>User's Information</h2>
  <div class="table-responsive">          
  <table class="table table-bordered table-hover table-condensed">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>E-mail</th>
        <th>Role_ID</th>
      </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
      <tr>
        <td>{{$user->id}}</td>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
         <td>{{$user->role_id}}</td>
      </tr>
     @endforeach
    </tbody>
  </table>
  </div>
  <h2>Roles</h2>
   <div class="table-responsive">          
  <table class="table table-bordered table-hover table-condensed">
    <thead>
      <tr>
        <th>Role_ID</th>
        <th>Role_title</th>
        <th>Role_slug</th>
      </tr>
    </thead>
    <tbody>
    @foreach($roles as $role)
      <tr>
        <td>{{$role->id}}</td>
        <td>{{$role->role_title}}</td>
        <td>{{$role->role_slug}}</td>
      </tr>
     @endforeach
    </tbody>
  </table>
  </div>
  <h2>Permissions</h2>
   <div class="table-responsive">          
  <table class="table table-bordered table-hover table-condensed">
    <thead>
      <tr>
        <th>Permission_ID</th>
        <th>Permission_title</th>
        <th>Permission_slug</th>
      </tr>
    </thead>
    <tbody>
    @foreach($permissions as $permission)
      <tr>
        <td>{{$permission->id}}</td>
        <td>{{$permission->permission_title}}</td>
        <td>{{$permission->permission_slug}}</td>
      </tr>
     @endforeach
    </tbody>
  </table>
  </div>
</div>
@endsection

@section('script')

@endsection
