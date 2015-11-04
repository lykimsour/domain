@extends('layouts.app')

@section('content')
<div class="container-fluid">
<h2>{{trans('Manage Item')}}</h2>
<div class="row">
    <div class="col-md-6">
       <a href="{{route('createitem')}}"><div class="btn btn-primary">{{trans('New Item')}}</div></a>
    </div>
</div><br/>
<div class="row">

    <div class="col-md-12">
    {!! $items->render() !!}
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
                  <th>Updated_AT</th>
                  <th>Date_Added</th>
      					</tr>
    				</thead>
    				 <tbody>
   				   @foreach($items as $item)

             <?php
              if($item->date_added){
               $date = strtotime($item->date_added);
               $date = date('d-M-Y',$date); 
              }
             else $date = '';
             
            ?>
      				<tr>
      					<td>
      				<form method="post" action="{{route('destroyitem',['id'=>$item->id])}}" >
               {!! csrf_field() !!}
              <input type="hidden" name="_method" value="DELETE" >
             <button type="submmit" class="btn btn-xs btn btn-danger"  onclick="return confirm('Are you sure?')">
  						<span class="glyphicon glyphicon-remove"></span>
  						</button>
              <a href="{{route('edititem',['id'=>$item->id])}}"><div class="btn btn-xs btn btn-info">
                <span class="glyphicon glyphicon-pencil"></span>
              </div></a>
              </form>
  						</td>
                <td>{{$item->id}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->type}}</td>
                <td>{{$item->duration}}</td>
                <td>{{$item->price}}</td>
                <td>{{$item->itemgroup->name}}</td>
                <td>{{$item->created_at->format('d-M-Y')}}</td>
                <td>{{$item->updated_at->diffForHumans()}}</td>
                <td>{{$date}}</td>
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