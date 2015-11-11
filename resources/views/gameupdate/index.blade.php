@extends('layouts.app')

@section('content')
<?php use Carbon\Carbon;?>
<div class="container-fluid">
<h2>{{trans('Manage Item')}}</h2>
<div class="row">
    <div class="col-md-6">
       <a href="{{route('creategameupdate',['gametype'=>$gametype])}}"><div class="btn btn-primary">{{trans('Add Game_update')}}</div></a>
        <br/><br/>
       <form method="GET" action="" id="getgametypeforgroup">
        <div class="form-group">
        {!! Form::select('gameupdate',$gameservice,$gametype,['class'=>'form-control','id'=>'gameupdate']) !!}
      </div>
      </form>
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
                  <th>Service_ID</th>
        					<th>Date</th>
      					</tr>
    				</thead>
    				 <tbody>
   				     @foreach($gameupdates as $gameupdate)
      				<tr>
      					<td>
      				<form method="post" action="{{route('destroygameupdate',['id'=>$gameupdate->id])}}" >
               {!! csrf_field() !!}
              <input type="hidden" name="_method" value="DELETE" >
             <button type="submmit" class="btn btn-xs btn btn-danger"  onclick="return confirm('Are you sure?')">
  						<span class="glyphicon glyphicon-remove"></span>
  						</button>
              <a href="{{route('editgameupdate',['id'=>$gameupdate->id,'gametype'=>$gameupdate->service_id])}}"><div class="btn btn-xs btn btn-info">
                <span class="glyphicon glyphicon-pencil"></span>
              </div></a>
              </form>
  						</td>
               <td>{{$gameupdate->service_id}}</td>
                <td>{{Carbon::parse($gameupdate->date)->format('Y/M/d')}}</td>
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