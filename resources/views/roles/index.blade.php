
@extends('layouts.app')

@section('content')

<div class="container-fluid">
<h2>{{trans('Manage Users')}}</h2>
<div class="row">
    <div class="col-md-6">
       <a href="{{route('createrole')}}"><div class="btn btn-primary">{{trans('New Role')}}</div></a>
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
                  <th>Tools</th>
                  <th>ID</th>
                  <th>Role_Title</th>
                  <th>Role_Slug</th>
                </tr>
            </thead>
               <tbody>
               @foreach($roles as $role)
              <tr>
                <td>
             
              <form method="post" action="{{route('deleterole',['id'=>$role->id])}}" >
               {!! csrf_field() !!}
              <input type="hidden" name="_method" value="DELETE" >
              <a href="{{route('editrole',['id'=>$role->id])}}"><div class="btn btn-xs btn btn-info">
                <span class="glyphicon glyphicon-pencil"></span>
              </div></a>
                </form>
 
                </td>
              <td>{{$role->id}}</td>
              <td>{{$role->role_title}}</td>
              <td>{{$role->role_slug}}</td>

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
