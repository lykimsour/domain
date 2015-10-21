
@extends('layouts.app')

@section('content')

<div class="container-fluid">

<h2>{{trans('Report:User_To_Service_Detail')}}</h2>

<div class="row">
    <div class="col-md-6">
    </div>
</div>
<div class="row">
    <div class="col-md-12">
      <ul class="list-group">
        <li class="list-group-item"><span class="glyphicon glyphicon-list-alt"></span>
            <span>List / <a href="{{ route('usertoservicelog')}}">{{ $user->user->name }}</a>
                       / <a href="{{ route('detailusertoservicelog', [$user->user->id, Request::segment(4), Request::segment(5), Request::segment(6)])}}">{{ $service_code }}</a>
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
              @if($service_code == 'tournament')
                <thead>  
                  <tr>
                    <th>Transfer_UserToService_LogID</th>
                    <th>From_ResellerID</th>
                    <th>TournamentID</th>
                    <th>TeamID</th>
                    <th>IP</th>
                  </tr>
                </thead>
                <tbody>
                @if(!is_null($service_detail))
                  <tr>
                    <td>{{ $service_detail->transfer_user2service_log_id }}</td>
                    <td>{{ $service_detail->from_reseller_id }}</td>
                    <td>{{ $service_detail->title }}</td>
                    <td>{{ $service_detail->name }}</td>
                    <td>{{ $service_detail->ip }}</td>
                  </tr>
                @endif
                </tbody>
              @else
                <thead>  
                  <tr>
                    <th>Transfer_UserToService_LogID</th>
                    <th>Transfer_CashToUser_LogID</th>
                    <th>Cashier</th>
                    <th>Account</th>
                    <th>Vip_Point</th>
                    <th>Gift_Credit</th>
                  </tr>
                </thead>
                <tbody>
                @if(!is_null($service_detail))
                  <tr>
                    <td>{{ $service_detail->transfer_user2service_log_id }}</td>
                    <td>{{ $service_detail->transfer_cash2user_log_id }}</td>
                    <td>{{ $service_detail->name != null ? $service_detail->name: 0 }}</td>
                    <td>{{ $service_detail->login_name }}</td>
                    <td>{{ $service_detail->vip_point }}</td>
                    <td>{{ $service_detail->gift_credit }}</td>
                  </tr>
                @endif
                </tbody>
              @endif
              <!--
                #
                # Merchant 
                #
              -->
              @elseif($service_type == 'merchant')
              <thead>  
                <tr>
                  <th>Transfer_UserToMerchant_LogID</th>
                  <th>Transaction_MerchantID</th>
                  <th>Transaction_Key</th>
                  <th>Merchant_Reference</th>
                  <th>Item</th>
                  <th>Merchant_IP</th>
                  <th>Wallet_IP</th>
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
              <!--
                #
                # Shop 
                #
              -->
              @elseif($service_type == 'shop')
              <thead>  
                <tr>
                  <th>Transfer_UserToShop_LogID</th>
                  <th>Shop_Code</th>
                  <th>ReferenceID</th>
                  <th>ItemID</th>
                  <th>Name</th>
                  <th>Qty</th>
                  <th>Detail</th>
                  <th>Expiry_date</th>
                  <th>IP</th>
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
