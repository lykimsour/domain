
@extends('layouts.app')

@section('content')

<div class="container-fluid">

<h2>{{trans('Report:Commission_To_Cashier_Detail')}}</h2>

<div class="row">
    <div class="col-md-6">
    </div>
</div>
<div class="row">
    <div class="col-md-12">
      <ul class="list-group">
        <li class="list-group-item"><span class="glyphicon glyphicon-list-alt"></span>
            <span>List / <a href="{{ route('commissiontocashier')}}">{{ $cashier->name }}</a>
                       / <a href="{{ route('detailcommissiontocashier', $cashier->id)}}">{{ $service_code }}</a>
            </span> 
        </li>
      </ul>
    <div class="table-responsive list-group-item">          
          <table class="table table-bordered table-hover table-condensed" >
            <thead>  
              <tr>
                <th>transfer_user2service_log_id</th>
                <th>transfer_cash2user_log_id</th>
                <th>cashier_id</th>
                <th>account_id</th>
                <th>vip_point</th>
                <th>gift_credit</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>{{ $service_detail->transfer_user2service_log_id }}</td>
                <td>{{ $service_detail->transfer_cash2user_log_id }}</td>
                <td>{{ $service_detail->cashier_id }}</td>
                <td>{{ $service_detail->account_id }}</td>
                <td>{{ $service_detail->vip_point }}</td>
                <td>{{ $service_detail->gift_credit }}</td>
              </tr>
            </tbody>
          </table> 
        </div>
    </div>
</div>
</div>


@endsection
