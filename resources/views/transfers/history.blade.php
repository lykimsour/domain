@extends('layouts.app')

@section('title', trans('menu.transfers history'))

@section('content')
	<section class="content-header">
		<h1>
			{{trans('menu.transfers history')}}
		</h1>
	</section>

	<section class="content">
		<div class="row" style="margin-bottom:20px;">
			<div class="col-sm-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-sitemap text-primary"></i> {{trans('transfers.reseller history')}}</h3>

            <div class="box-tools pull-right hidden-xs">
              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div><!-- /.box-header -->
	         <div class="box-body no-padding table-responsive">
			      <table class="table table-striped table-hover" id="table_reseller_history">
				      <thead>
				        <tr>
				          <th>Time (UTF)</th>
				          <th>ID</th>
				          <th>Reseller ID</th>
				          <th>Reseller Name</th>
				          <th>Amount</th>
				          <th>Status</th>
				          <th>Invoive</th>
				        </tr>
				      </thead>
				      <tbody>
				      @foreach($reseller_logs as $log)
				      	<tr>
	          			<td>{{Helper::humanDate($log->date)}}</td>
	          			<td>{{$log->id}}</td>
	          			<td>{{$log->reseller__id}}</td>
	          			<td>{{$log->reseller->name}}</td>
	          			<td>{{$log->amount}}</td>
	          			<td>{{$log->status}}</td>
	          			<td>
	          				<a class="btn btn-default btn-xs" href="{{route('transfers.invoice', $log->id)}}">
	          					<i class="fa fa-file-text-o"></i>
	          				</a>
	          				{{-- <a class="btn btn-default btn-xs" href="#">
	          					<i class="fa fa-print"></i>
	          				</a> --}}
	          			</td>
	          		</tr>
				      @endforeach
				      </tbody>
				    </table>
				  </div>
        </div><!-- /.box -->
        @if($reseller_next_list)
				  <nav id="nav_reseller_history">
					  <ul class="pager">
					    <li><a href="#" id="load_resller_history">{{trans('app.load more')}}</a></li>
					  </ul>
					</nav>
				@endif
			</div>
		</div>

	</section>
	
@endsection

@section('script')
	{!! Html::script('js/pages/history.js') !!}
@endsection
