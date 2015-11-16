@extends('layouts.app')

@section('content')

<div class="container-fluid">
<h2>{{trans('Manage Promotion')}}</h2>
<div class="row">
    <div class="col-md-6">
       <a href="{{route('createpromotion')}}"><div class="btn btn-primary">{{trans('New Promotion')}}</div></a>
    </div>
</div><br/>
<div class="row">

    <div class="col-md-12">
        {!! $promotions->render() !!}
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
        					<th>Service_Code</th>
        					<th>Service_Name</th>
        					<th>image</th>
        					<th>Option_name</th>
                  <th>Value</th>
                  <th>Description</th>
      					</tr>
    				</thead>

    				   <tbody>
             
             @foreach($promotions as $promotion)

              <tr>
                <td>
              <form method="post" action="{{route('deletepromotion',['id'=>$promotion->id])}}" >
               {!! csrf_field() !!}
              <input type="hidden" name="_method" value="DELETE" >
              <button type="summit" class="btn btn-xs btn btn-danger" onclick="return confirm('Are you sure?')" >
              <span class="glyphicon glyphicon-remove"></span>
              </button>
              <a href="{{route('editpromotion',['id'=>$promotion->id])}}"><div class="btn btn-xs btn btn-info">
                <span class="glyphicon glyphicon-pencil"></span>
              </div></a>
                </form>
    
                </td>
                <td>{{$promotion->id}}</td>
                <td>{{$promotion->service_code}}</td>
                <td>{{$promotion->service_name}}</td>
                <td>{{$promotion->image}}</td>
                <td>{{$promotion->option_name}}</td>
                 <td>{{$promotion->value}}</td>
                  <td>{{$promotion->description}}</td>
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
