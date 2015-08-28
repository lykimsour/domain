@extends('layouts.app')


@section('content')



<div class="container-fluid">
<h2>{{trans('Manage ServiceType')}}</h2>
<div class="row">
    <div class="col-md-6">
       <a href="{{route('createservicetype')}}"><div class="btn btn-primary">{{trans('New ServiceType')}}</div></a>
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
      					</tr>
    				</thead>
    				   <tbody>
              @foreach($servicetypes as $servicetype)
              <tr>
                <td>
              <form method="post" action="{{route('deleteservicetype',['id'=>$servicetype->id])}}" >
               {!! csrf_field() !!}
              <input type="hidden" name="_method" value="DELETE" >
              <button type="summit" class="btn btn-xs btn btn-danger" onclick="return confirm('Are you sure?')"  >
              <span class="glyphicon glyphicon-remove"></span>
              </button>
              <a href="{{route('editservicetype',['id'=>$servicetype->id])}}"><div class="btn btn-xs btn btn-info">
                <span class="glyphicon glyphicon-pencil"></span>
              </div></a>
                </form>
              
         
                </td>
                <td>{{$servicetype->id}}</td>
                <td>{{$servicetype->name}}</td>
               
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

@endsection