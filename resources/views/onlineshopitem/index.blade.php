
@extends('layouts.app')

@section('content')

<div class="container-fluid">
<h2>{{trans('Manage OnlineShopItem')}}</h2>
<div class="row">
    <div class="col-md-6">
       <a href="{{route('createonlineshopitem')}}"><div class="btn btn-primary">{{trans('New OnlineShopItem')}}</div></a>
    </div>
</div><br/>
<div class="row">

    <div class="col-md-12">
      {!! $onlineshopitems->render() !!}
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
        					<th>Online_Shop_Code</th>
        					<th>Item</th>
        					<th>Order</th>
        					<th>Status</th>
      					</tr>
    				</thead>
    				   <tbody>
               @foreach($onlineshopitems as $onlineshopitem)
              <tr>
                <td>
              <form method="post" action="{{route('deleteonlineshopitem',['id'=>$onlineshopitem->id])}}" >
               {!! csrf_field() !!}
              <input type="hidden" name="_method" value="DELETE" >
              <button type="summit" class="btn btn-xs btn btn-danger" onclick="return confirm('Are you sure?')" >
              <span class="glyphicon glyphicon-remove"></span>
              </button>
              <a href="{{route('editonlineshopitem',['id'=>$onlineshopitem->id])}}"><div class="btn btn-xs btn btn-info">
                <span class="glyphicon glyphicon-pencil"></span>
              </div></a>
                </form>
                </td>
                <td>{{$onlineshopitem->id}}</td>
                <td>{{$onlineshopitem->online_shop_code}}</td>
                <td>{{$onlineshopitem->item}}</td>
                <td>{{$onlineshopitem->ordering}}</td>
                <td>{{$onlineshopitem->status}}</td>
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
