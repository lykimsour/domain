@extends('layouts.app')
@section('title', 'Users')
@section('content')

<section class="content-header">
    <h1>
      {{trans('New Game_Update')}}
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
    <form method="post" action="{{route('storegameupdate')}}">
    	   {!! csrf_field() !!}
     <div class="form-group">
        <label for="username">{{trans('Game_Type')}}</label>
        {!! Form::select('gametypes',$gameservice, $gametype,['class'=>'form-control','id'=>'gametypes']) !!}
      </div>
    	 <div class="form-group">
              <label for="name" >{{trans('Update_Date')}}</label><br/>
                <div class="input-group date" data-date-format="yyyy-M-dd" id="dateadded"  >
                    <input type='text' class="form-control" name="updatedate" id="dateadded" />
                    <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
          </div>
		  <button type="submit" class="btn btn-primary">{{trans('Save')}}</button>
      </form>
    </div>
</div><br/>
</section>

@endsection
