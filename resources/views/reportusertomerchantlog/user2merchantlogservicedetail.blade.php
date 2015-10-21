
@extends('layouts.app')

@section('content')

<div class="container-fluid">

<h2>{{trans('Report:User_To_Merchant_Detail')}}</h2>

<div class="row">
    <div class="col-md-6">
    </div>
</div>
<div class="row">
    <div class="col-md-12">
      <ul class="list-group">
        <li class="list-group-item"><span class="glyphicon glyphicon-list-alt"></span>
            <span>List / <a href="{{ route('usertomerchantlog')}}">{{ $service->user->name }}</a>
                       / <a href="{{ route('detailusertomerchant', [$service->user_id, Request::segment(4), Request::segment(5), Request::segment(6)])}}">{{ $service->service_code }}</a>
            </span> 
        </li>
      </ul>
    <div class="table-responsive list-group-item">          
          <table class="table table-bordered table-hover table-condensed">
            <thead>  
              <tr>
                <th>transfer_user2merchant_log_id</th>
                <th>transaction_merchant_id</th>
                <th>transaction_key</th>
                <th>merchant_reference</th>
                <th>items</th>
                <th>merchant_ip</th>
                <th>wallet_ip</th>
              </tr>
            </thead>
            <tbody>
            @if(!is_null($service_detail))
              <tr>
                <td>{{ $service_detail->transfer_user2merchant_log_id }}</td>
                <td>{{ $service_detail->transaction_merchant_id }}</td>
                <td>{{ $service_detail->transaction_key }}</td>
                <td>{{ $service_detail->merchant_reference }}</td>
                <td>{{ $service_detail->items }}</td>
                <td>{{ $service_detail->merchant_ip }}</td>
                <td>{{ $service_detail->wallet_ip }}</td>
              </tr>
            @endif
            </tbody>
          </table> 
        </div>
    </div>
</div>
</div>


@endsection
