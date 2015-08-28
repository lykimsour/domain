@extends('layouts.app')


@section('content')

<div class="container-fluid">
<h2>{{trans('Manage ServiceClass')}}</h2>
<div class="row">
    <div class="col-md-6">
       <a href="{{route('createserviceclass')}}"><div class="btn btn-primary">{{trans('New ServiceClass')}}</div></a>
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
        					<th>Commission_rate</th>
        					<th>Payout_rate</th>
      					</tr>
    				</thead>
    				   <tbody>
    		  @foreach($serviceclasses as $serviceclass)
              <tr>
                <td>
              <form method="post" action="{{route('deleteserviceclass',['id'=>$serviceclass->id])}}">
               {!! csrf_field() !!}
              <input type="hidden" name="_method" value="DELETE" >
              <button type="summit" class="btn btn-xs btn btn-danger" onclick="return confirm('Are you sure?')"  >
              <span class="glyphicon glyphicon-remove"></span>
              </button>
              <a href="{{route('editserviceclass',['id'=>$serviceclass])}}"><div class="btn btn-xs btn btn-info">
                <span class="glyphicon glyphicon-pencil"></span>
              </div></a>
                </form>
                </td>
                <td><b>{{$serviceclass->id}}</b></td>
                <td>{{$serviceclass->name}}</td>
               	<td>{{$serviceclass->commission_rate}}</td>
               	<td>{{$serviceclass->payout_rate}}</td>
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