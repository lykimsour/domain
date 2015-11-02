
@extends('layouts.app')

@section('content')

<div class="container-fluid">
<h2>{{trans('Manage Permissions')}}</h2>
<div class="row">
    <div class="col-md-6">
       <a href="{{route('createpermission')}}"><div class="btn btn-primary">{{trans('New Permission')}}</div></a>
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
                  <th>ID</th>
                  <th>Permission_Title</th>
                  <th>Permission_Slug</th>
                   <th>Permission_Description</th>
                </tr>
            </thead>
               <tbody>
              @foreach($permissions as $permission)
              <tr>
              <td>
            
              <a href="{{route('editpermission',['id'=>$permission->id])}}"><div class="btn btn-xs btn btn-info">
                <span class="glyphicon glyphicon-pencil"></span>
              </div></a>
                </td>
                    <td>{{$permission->id}}</td>
                    <td>{{$permission->permission_title}}</td>
                    <td>{{$permission->permission_slug}}</td>
                    <td>{{$permission->permission_description}}</td>
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
