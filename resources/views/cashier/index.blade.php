@extends('layouts.app')

@section('content')


<div class="container-fluid">
<h2>{{trans('Manage Cashier')}}</h2>
<div class="row">
    <div class="col-md-6">
       <a href="{{route('getcashier')}}"><div class="btn btn-primary">{{trans('New Cashier')}}</div></a>
    </div>
</div><br/>
<div class="row">

    <div class="col-md-12">
    {!! $cashiers->render() !!}
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
        					<th>User_name</th>
        					<th>Commission_rate</th>
        					<th>Only2service</th>
        					<th>Pay_bonus</th>
        					<th>Bonus_balance</th>
        					<th>Status</th>
                  <th>Allow_Send_Gold</th>
        					<th>Created_at</th>
        					<th>Updated_at</th>
      					</tr>
    				</thead>
    				 <tbody>
   						 @foreach($cashiers as $cashier)
      				<tr>
      					<td>
      				<form method="post" action="{{route('destroycashier',['id'=>$cashier->id])}}" >
               {!! csrf_field() !!}
              <input type="hidden" name="_method" value="DELETE" >
             <button type="submmit" class="btn btn-xs btn btn-danger"  onclick="return confirm('Are you sure?')">
  						<span class="glyphicon glyphicon-remove"></span>
  						</button>
              <a href="{{route('editcashier',['id'=>$cashier->id])}}"><div class="btn btn-xs btn btn-info">
                <span class="glyphicon glyphicon-pencil"></span>
              </div></a>
              </form>
  						
        				</td>
        				<td><b>{{$cashier->id}}</b></td>
        				<td>{{$cashier->name}}</td>
        				<td>{{$cashier->type}}</td>
                <td>{{$cashier->username}}</td>
        				<td>{{$cashier->commission_rate}}</td>
        				<td>{{$cashier->only2service}}</td>
        				<td>{{$cashier->pay_bonus}}</td>
        				<td>{{$cashier->bonus_balance}}</td>
        				<td>{{$cashier->status}}</td>
                <td>{{$cashier->allow_send_gold}}</td>
        				<td>{{$cashier->created_at->format('M-d-Y')}}</td>
        				<td>{{$cashier->updated_at->diffForHumans()}}</td>
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
