
@extends('layouts.app')

@section('content')

<div class="container-fluid">
<h2>{{trans('Manage OnlineShop')}}</h2>
<div class="row">
    <div class="col-md-6">
       <a href="{{route('createonlineshop')}}"><div class="btn btn-primary">{{trans('New OnlineShop')}}</div></a>
    </div>
</div><br/>
<div class="row">

    <div class="col-md-12">
      {!! $onlineshops->render() !!}
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
        					<th>Code</th>
        					<th>Detail</th>
        					<th>Status</th>
      					</tr>
    				</thead>
    				   <tbody>
               @foreach($onlineshops as $onlineshop)
              <tr>
                <td>
              <form method="post" action="{{route('deleteonlineshop',['id'=>$onlineshop->id])}}" >
               {!! csrf_field() !!}
              <input type="hidden" name="_method" value="DELETE" >
              <button type="summit" class="btn btn-xs btn btn-danger" onclick="return confirm('Are you sure?')" >
              <span class="glyphicon glyphicon-remove"></span>
              </button>
              <a href="{{route('editonlineshop',['id'=>$onlineshop->id])}}"><div class="btn btn-xs btn btn-info">
                <span class="glyphicon glyphicon-pencil"></span>
              </div></a>
                </form>
                </td>
                <td>{{$onlineshop->id}}</td>
                <td>{{$onlineshop->name}}</td>
                <td>{{$onlineshop->code}}</td>
                <td>{{$onlineshop->detail}}</td>
                <td>{{$onlineshop->status}}</td>
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
