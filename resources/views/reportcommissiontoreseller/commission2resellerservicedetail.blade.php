
@extends('layouts.app')

@section('content')

<div class="container-fluid">

<h2>{{trans('Report:Commission_To_Reseller_Detail')}}</h2>

<div class="row">
    <div class="col-md-6">
    </div>
</div>
<div class="row">
    <div class="col-md-12">
      <ul class="list-group">
        <li class="list-group-item"><span class="glyphicon glyphicon-list-alt"></span>
            <span>List / <a href="{{ route('commissiontoreseller')}}">{{ $reseller->name }}</a>
                       / <a href="{{ route('detailcommissiontoreseller', $reseller->id)}}">{{ $service_code }}</a>
            </span> 
        </li>
      </ul>
    <div class="table-responsive list-group-item">          
          <table class="table table-bordered table-hover table-condensed" >
            <!--
              #
              # Service 
              #
            -->
            @if($service_type == 'service')
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
              @if(!is_null($service_detail))
                <tr>
                  <td>{{ $service_detail->transfer_user2service_log_id }}</td>
                  <td>{{ $service_detail->transfer_cash2user_log_id }}</td>
                  <td>{{ $service_detail->cashier_id }}</td>
                  <td>{{ $service_detail->account_id }}</td>
                  <td>{{ $service_detail->vip_point }}</td>
                  <td>{{ $service_detail->gift_credit }}</td>
                </tr>
              @endif
              </tbody>
              <!--
                #
                # Merchant 
                #
              -->
              @elseif($service_type == 'merchant')
              <thead>  
                <tr>
                  <th>transfer_user2merchant_log_id</th>
                  <th>transaction_merchant_id</th>
                  <th>transaction_key</th>
                  <th>order_id</th>
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
                  <td>{{ $service_detail->order_id }}</td>
                  <td>{{ $service_detail->merchant_reference }}</td>
                  <td>{{ $service_detail->items }}</td>
                  <td>{{ $service_detail->merchant_ip }}</td>
                  <td>{{ $service_detail->wallet_ip }}</td>
                </tr>
              @endif
              </tbody>
              <!--
                #
                # Shop 
                #
              -->
              @elseif($service_type == 'shop')
              <thead>  
                <tr>
                  <th>transfer_user2shop_log_id</th>
                  <th>shop_code</th>
                  <th>reference_id</th>
                  <th>item_id</th>
                  <th>name</th>
                  <th>qty</th>
                  <th>detail</th>
                  <th>expiry_date</th>
                  <th>ip</th>
                </tr>
              </thead>
              <tbody>
                @if(!is_null($service_detail))
                  <tr>
                    <td>{{ $service_detail->transfer_user2shop_log_id }}</td>
                    <td>{{ $service_detail->shop_code }}</td>
                    <td>{{ $service_detail->reference_id }}</td>
                    <td>{{ $service_detail->item_id }}</td>
                    <td>{{ $service_detail->name }}</td>
                    <td>{{ $service_detail->qty }}</td>
                    <td>{{ $service_detail->detail }}</td>
                    <td>{{ $service_detail->expiry_date }}</td>
                    <td>{{ $service_detail->ip }}</td>
                  </tr>
                @endif
              </tbody>
            @endif
          </table> 
        </div>
    </div>
</div>
</div>


@endsection
