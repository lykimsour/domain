@extends('layouts.app')
@section('title', 'Users')
@section('content')

<section class="content-header">
    <h1>
      {{trans('Edit Item')}}
    </h1>
  </section>
<section class="content">
 @if($errors->any())
    <ul class="alert alert-danger">
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
    @endif
<div class="row">
    <div class="col-md-6">
    <form method="post" action="{{route('updateitem',['id'=>$item->id,'gametype'=>$gametype])}}" id="edititem">
    	   {!! csrf_field() !!}
    <input type="hidden" name="_method" value="PUT">
     <div class="form-group">
          <label for="name">{{trans('ID')}}</label>
          <input type="text" name="id" class="form-control" id="id" value="{{$item->id}}">
      </div>
    	<div class="form-group">
    		<label for="name">{{trans('Name')}}</label>
    		<input type="text" name="name" class="form-control" id="name" value="{{$item->name}}">
  		</div>
       <div class="form-group">
        <label for="username">{{trans('Item_Type')}}</label>
        {!! Form::select('itemtype',$itemtype, $item->type_id,['class'=>'form-control','id'=>'itemtype']) !!}
      </div>
        <div class="form-group" id="duration">
        <label>Duration</label>
        <input type="text" name="duration" class="form-control" value="{{$item->duration}}">
      </div>
  		<div class="form-group">
    		<label>Price</label>
    		<input type="text" name="price" class="form-control" id="price" value="{{$item->price}}" >
  		</div>
      <div class="form-group">
      <?php    if($item->date_added){
               $date = strtotime($item->date_added);
               $date = date('Y-M-d',$date); 
              }
             else $date = '';
       ?>
              <input type="hidden" value="{{$date}}" id="datevalue">
              <label for="name" >{{trans('Date_Add')}}</label><br/>
    
                <div class="input-group date" data-date-format="yyyy-M-dd"  id="startdate" value="{{$item->date_added}}">
                    <input type='text' class="form-control" name="dateadded" id="dateadded" value="{{$item->date_added}}"/>
                    <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>

          </div>
  	
  	 <div class="form-group">
        <label for="username">{{trans('Group_ID')}}</label>
        {!! Form::select('itemgroup',$itemgroup,$item->group_id,['class'=>'form-control',]) !!}
      </div>
		  <button type="submit" class="btn btn-primary">{{trans('Save')}}</button>
      </form>
    </div>
</div><br/>
</section>
@endsection
@section('script')
  <script type="text/javascript">
    $(document).ready(function(){
       $('form#edititem').validate({
        rules: {
          name: {
             required : true
          },
          price: {
            number: true,required : true
          }
        }
      });
    });
  </script>
@endsection

