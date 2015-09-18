@extends('layouts.app')

@section('content')


<div class="container-fluid">
<h2>{{trans('Manage Cashier')}}</h2>
<div class="row">
    <div class="col-md-6">
       <a href="{{route('createmerchant')}}"><div class="btn btn-primary">{{trans('New Merchant')}}</div></a>
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
        					<th>E-Mail</th>
        					<th>Coin</th>
        					<th>Currency</th>
                  <th>Commission</th>
                  <th>Key</th>
                  <th>Seed</th>
                  <th>Callback_url</th>
        					<th>Status</th>
        					<th>Created_at</th>
        					<th>Updated_at</th>
      					</tr>
    				</thead>
    				 <tbody>

   						 @foreach($merchants as $merchant)  

      				<tr>
      					<td>
      				<form method="post" action="" >
               {!! csrf_field() !!}
              <input type="hidden" name="_method" value="DELETE" >
             <button type="submmit" class="btn btn-xs btn btn-danger"  onclick="return confirm('Are you sure?')">
  						<span class="glyphicon glyphicon-remove"></span>
  						</button>
              <a href=""><div class="btn btn-xs btn btn-info">
                <span class="glyphicon glyphicon-pencil"></span>
              </div></a>
              </form>
  						
        				</td>
        				<td>{{$merchant->id}}</td>
        				<td>{{$merchant->name}}</td>
        				<td>{{$merchant->email}}</td>
        				<td>{{$merchant->coin}}</td>
        				<td>{{$merchant->currency}}</td>
                <td>{{$merchant->comission}}</td>
                <td>{{$merchant->key}}</td>
                <td>{{$merchant->seed}}</td>
                <td>{{$merchant->callback_url}}</td>
        				<td>{{$merchant->status}}</td>
        			   <td>{{$merchant->created_at->format('M-d-Y')}}</td>
                <td>{{$merchant->updated_at->diffForHumans()}}</td>
        				<td></td>
      				</tr>
     			
              @endforeach
    				</tbody>
    			</table>

    		</div>

		</ul>
    </div>
</div><br/>
</div>
 <!---->
@endsection
