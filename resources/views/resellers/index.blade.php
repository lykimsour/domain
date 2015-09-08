
@extends('layouts.app')

@section('content')

<div class="container-fluid">
<h2>{{trans('Manage Reseller')}}</h2>
<div class="row">
    <div class="col-md-6">
       <a href="{{route('createonlineshop')}}"><div class="btn btn-primary">{{trans('New Reseller')}}</div></a>
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
        					<th>Name</th>
        					<th>Certificate_Install_Password</th>
        					<th>Coin</th>
        					<th>Status</th>
        					<th>Certificate_pem</th>
        					<th>Certificate_p12</th>
        					<th>Phone</th>
        					<th>Email</th>
        					<th>Message</th>
        					<th>Attachment</th>
        					<th>Logged_in</th>
        					<th>Request_Date</th>
      					</tr>
    				</thead>
    				   <tbody>
            	@foreach($resellers as $reseller)
              <tr>
                <td>
              <form method="post" action="" >
               {!! csrf_field() !!}
              <input type="hidden" name="_method" value="DELETE" >
              <button type="summit" class="btn btn-xs btn btn-danger" onclick="return confirm('Are you sure?')" >
              <span class="glyphicon glyphicon-remove"></span>
              </button>
              <a href=""><div class="btn btn-xs btn btn-info">
                <span class="glyphicon glyphicon-pencil"></span>
              </div></a>
                </form>
                </td>
               		<td>{{$reseller->id}}</td>
        			<td>{{$reseller->name}}</td>
        			<td>{{$reseller->certificate_cnstall_password}}</td>
        			<td>{{$reseller->coin}}</td>
        			<td>{{$reseller->status}}</td>
        			<td>{{$reseller->certificate_pem}}</td>
        			<td>{{$reseller->certificate_p12}}</td>
        			<td>{{$reseller->phone}}</td>
        			<td>{{$reseller->email}}</td>
        			<td>{{$reseller->message}}</td>
        			<td>{{$reseller->logged_in}}</td>
        			<td>{{$reseller->request_date}}</td>
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
