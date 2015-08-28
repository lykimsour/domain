@extends('layouts.app')

@section('title', trans('menu.transfers'))

@section('content')
	<section class="content-header">
		<h1>
			{{trans('menu.transfers')}}
		</h1>
	</section>

	<section class="content">

	<div class="row">
		<div class="col-md-6">

			{{ Flash::getMessage() }}

			<div class="box box-primary">
        <!-- form start -->
        <form action="{{route('transfers.send')}}" role="form" method="POST" id='transfers'>
        {!! csrf_field() !!}
          <div class="box-body">
            <div class="form-group">
              <label for="transfers_id">{{trans('transfers.to id')}}</label>
              <input class="form-control" name="id" id="transfers_id" placeholder="{{trans('transfers.to id')}}" type="text" required="" >
            </div>

            <div class="form-group">
              <label for="transfers_amount">{{trans('transfers.amount')}}</label>
              <input class="form-control" name="amount" id="transfers_amount" placeholder="{{trans('transfers.amount')}}" type="text" required="" >
            </div>

          </div><!-- /.box-body -->

          <div class="box-footer">
            <button type="submit" class="btn btn-primary">{{trans('transfers.btn transfer')}}</button>
          </div>
        </form>
      </div>
    </div>
   </div>

	</section>
	
@endsection

@section('script')
	<script type="text/javascript">
		$(document).ready(function(){
			 $('form#transfers').validate({
				rules: {
					id: {
						digits: true
					},
					amount: {
						number: true
					}
				}
			});
		});
	</script>
@endsection
