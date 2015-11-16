@extends('layouts.app')

@section('content')
<div class="container-fluid">
<h2>{{trans('Manage Item')}}</h2>
<div class="row">
    <div class="col-md-6">
       <a href="{{route('createitem',['gametype'=>$gametype])}}"><div class="btn btn-primary">{{trans('New Item')}}</div></a>
       <br/><br/>
       <form method="GET" action="#" id="getgametype">
        <div class="form-group">
        {!! Form::select('gametype',$gameservice, $gametype,['class'=>'form-control','id'=>'gametype']) !!}
      </div>
      </form>
    </div>
</div><br/>
<div class="row">

    <div class="col-md-12">
    @if(strtolower($gametype) == 'ak')
    {!!$items->render()!!}
    @endif
       <ul class="list-group">
  		<li class="list-group-item"><span class="glyphicon glyphicon-list-alt"></span>
  				<span>{{$gametype}} ITEMS</span> 
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

             <?php
              if($item->date_added){
               $date = strtotime($item->date_added);
               $date = date('d-M-Y',$date); 
              }
             else $date = '';
             
            ?>
      				<tr>
      					<td>

      				<form method="post" action="{{route('destroyitem',['id'=>$item->id,'gametype'=>$gametype])}}" >
               {!! csrf_field() !!}
              <input type="hidden" name="_method" value="DELETE" >
             <button type="submmit" class="btn btn-xs btn btn-danger"  onclick="return confirm('Are you sure?')">
  						<span class="glyphicon glyphicon-remove"></span>
  						</button>
              <a href="{{route('edititem',['id'=>$item->id,'gametype'=>$gametype])}}"><div class="btn btn-xs btn btn-info">
                <span class="glyphicon glyphicon-pencil"></span>
              </div></a>
              </form>
  						</td>
                <td>{{$item->id}}</td>
                <td>{{$item->name}}</td>
                 @if($gametype == 'AK')
                 <td>{{$item->itemtype->name}}</td>
                @else
                <td>{{$item->typename}}</td>
                @endif
                <td>{{$item->duration}}</td>
                <td>{{$item->price}}</td>
                @if($gametype == 'AK')
                <td>{{$item->itemgroup->name}}</td>
                @else
                <td>{{$item->groupname}}</td>
                @endif
                <td>{{$item->created_at}}</td>
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