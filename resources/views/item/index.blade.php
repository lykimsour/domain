@extends('layouts.app')

@section('content')
<div class="container-fluid">
<h2>{{trans('Manage Cashier')}}</h2>
<div class="row">
    <div class="col-md-6">
       <a href="{{route('createitem')}}"><div class="btn btn-primary">{{trans('New Item')}}</div></a>
    </div>
</div><br/>
<div class="row">

    <div class="col-md-12">
       <ul class="list-group">
  		<li class="list-group-item"><span class="glyphicon glyphicon-list-alt"></span>
  				<span>List</span> 
  		</li>
			<div class="table-responsive list-group-item">          
  				<table class="table table-bordered table-hover table-condensed">
    				<thead>
      					<tr>
        					<th>Tools</th>
        					<th>ID</th>
        					<th>Name</th>
                  <th>Type</th>
        					<th>Duration</th>
                  <th>Price</th>
                  <th>Group_ID</th>
                  <th>Created_AT</th>
                  <th>Date_Added</th>
      					</tr>
    				</thead>
    				 <tbody>
   				   @foreach($items as $item)
      				<tr>
      					<td>
      				<form method="post" action="#" >
               {!! csrf_field() !!}
              <input type="hidden" name="_method" value="DELETE" >
             <button type="submmit" class="btn btn-xs btn btn-danger"  onclick="return confirm('Are you sure?')">
  						<span class="glyphicon glyphicon-remove"></span>
  						</button>
              <a href="#"><div class="btn btn-xs btn btn-info">
                <span class="glyphicon glyphicon-pencil"></span>
              </div></a>
              </form>
  						</td>
        				<td>{{$item->id}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->type}}</td>
                <td>{{$item->duration}}</td>
                <td>{{$item->price}}</td>
                <td>{{$item->group_id}}</td>
                <td>{{$item->created_at}}</td>
                <td>{{$item->date_added}}</td>
      				</tr>
     			  @endforeach
    				</tbody>
    			</table>

    		</div>

		</ul>
    </div>
</div><br/>
</div>


@endsection