@extends('layouts.app')

@section('content')
<div class="container-fluid">
<h2>{{trans('Manage Item')}}</h2>
<div class="row">
    <div class="col-md-6">
       <a href="{{route('createitemtype',['gametype'=>$gametype])}}"><div class="btn btn-primary">{{trans('New Item_Type')}}</div></a>
        <br/><br/>
       <form method="GET" action="#" id="getgametypefortype">
        <div class="form-group">
        {!! Form::select('gametypefortype',$gameservice, $gametype,['class'=>'form-control','id'=>'gametypefortype']) !!}
      </div>
      </form>
    </div>
</div><br/>
<div class="row">

    <div class="col-md-12">
    @if(strtolower($gametype) == 'ak')

     {!! $itemtypes->render()  !!}
    @endif
    
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
      					</tr>
    				</thead>
    				 <tbody>
   				   @foreach($itemtypes as $itemtype)
      				<tr>
      					<td>
      				<form method="post" action="{{route('destroyitemtype',['id'=>$itemtype->id,'gametype'=>$gametype])}}" >
               {!! csrf_field() !!}
              <input type="hidden" name="_method" value="DELETE" >
             <button type="submmit" class="btn btn-xs btn btn-danger"  onclick="return confirm('Are you sure?')">
  						<span class="glyphicon glyphicon-remove"></span>
  						</button>
              <a href="{{route('edititemtype',['id'=>$itemtype->id,'gametype'=>$gametype])}}"><div class="btn btn-xs btn btn-info">
                <span class="glyphicon glyphicon-pencil"></span>
              </div></a>
              </form>
  						</td>
               <td>{{$itemtype->id}}</td>
                <td>{{$itemtype->name}}</td>
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