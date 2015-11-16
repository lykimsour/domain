@extends('layouts.app')

@section('content')

<div class="container-fluid">
<h2>{{trans('Manage Service')}}</h2>
<div class="row">
    <div class="col-md-6">
       <a href="{{route('createservice')}}"><div class="btn btn-primary">{{trans('New Service')}}</div></a>
    </div>
</div><br/>
<div class="row">

    <div class="col-md-12">
        {!! $services->render()  !!}
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
        					<th>Code</th>
        					<th>Service_class_id</th>
        					<th>Service_type_id</th>
        					<th>Info</th>
      					</tr>
    				</thead>
    				   <tbody>
               @foreach($services as $service)
              <tr>
                <td>
              <form method="post" action="{{route('deleteservice',['id'=>$service->id])}}" >
               {!! csrf_field() !!}
              <input type="hidden" name="_method" value="DELETE" >
              <button type="summit" class="btn btn-xs btn btn-danger" onclick="return confirm('Are you sure?')" >
              <span class="glyphicon glyphicon-remove"></span>
              </button>
              <a href="{{route('editservice',['id'=>$service->id])}}"><div class="btn btn-xs btn btn-info">
                <span class="glyphicon glyphicon-pencil"></span>
              </div></a>
                </form>
              
            
                </td>
                <td>{{$service->id}}</td>
                <td>{{$service->code}}</td>
                <td>{{$service->service_class_id}}</td>
                <td>{{$service->service_type_id}}</td>
                <td>{{$service->info}}</td>
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
