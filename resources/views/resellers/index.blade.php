
@extends('layouts.app')

@section('content')
<?php use App\ResellerRequest; ?>
<div class="container-fluid">
<h2>{{trans('Manage Reseller')}}</h2>
<div class="row">
    <div class="col-md-6">
       <a href="{{route('createonlineshop')}}"><div class="btn btn-primary">{{trans('New Reseller')}}</div></a>
    </div>
</div><br/>
<div class="row">

    <div class="col-md-12">
     {!! $resellers->render()  !!}
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
        					<th>Name</th>
        					<th>Coin</th>
        					<th>Status</th>
        					<th>Phone</th>
        					<th>Email</th>
                  <th></th>
      					</tr>
    				</thead>
    				   <tbody>
            	@foreach($resellers as $reseller)
              <tr>
                <td>
              <form method="post" action="{{route('requesttoken')}}" >
               {!! csrf_field() !!}
              <input type="hidden" name="_method" value="post"  >
              <button type="summit" class="btn btn-xs btn btn-danger" onclick="return confirm('Are you sure?')" >
              <span class="glyphicon glyphicon-remove"></span>
              </button>
               </form>
              <a href=""><div class="btn btn-xs btn btn-info">
                <span class="glyphicon glyphicon-pencil"></span>
              </div></a>
                </td>
                     <td>{{$reseller->id}}</td>
        			       <td>{{$reseller->name}}</td>
        			       <td>{{$reseller->coin}}</td>
        			       <td>{{$reseller->status}}</td>
        			       <td>{{$reseller->phone}}</td>
        			       <td>{{$reseller->email}}</td>
                     <?php $resellerrequest = ResellerRequest::where('reseller_id','=',$reseller->id)->first(); ?>
                     @if(!$resellerrequest)
                     <td><a href="{{route('requesttoken',['id'=>$reseller->id])}}"><div class="btn btn-xs btn btn-info">re-enable certificate installation</td>
                     @endif
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
